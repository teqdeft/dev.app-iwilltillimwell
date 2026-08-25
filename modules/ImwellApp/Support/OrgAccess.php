<?php

namespace Modules\ImwellApp\Support;

use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Support\Facades\DB;
use Modules\ImwellApp\Models\ImwellOrg;

/**
 * Keeps an organisation member in the state the REAL application expects of a
 * fully paid, fully onboarded subscriber - because their organisation pays for
 * them, so they must never be shown the plan / package screen.
 *
 * Two things have to be true for that:
 *
 *  1. The user flags.
 *     payment_status = 1  - user/dashboard.blade.php shows the package chooser
 *                           whenever this is 0, which is the plan screen the
 *                           member kept landing on.
 *     step_position  = 4  - registration wizard complete.
 *     doctor_step    = 5  - health-record wizard complete. Any value 0-4 makes
 *                           UserDashboardPaymentStatus bounce the member round
 *                           personal-record / medications / ... forever.
 *     expiry_date         - far future; the organisation owns the subscription.
 *     counseling-consent  - UserMeta row, else that same middleware redirects
 *                           to share/user/medical-consent.
 *
 *  2. An active braintree_subscription row.
 *     GetMyPackageServiceList() reads package_service_list from it and
 *     checkServiceEnabled() uses that to decide which dashboard tiles unlock.
 *     With no row every service renders locked.
 *
 * The sponsored row is written with activation_type = 'organization' (never
 * 'activation'), which keeps these members out of the influencer member counts
 * and commission totals - those queries all filter on 'activation'.
 */
class OrgAccess
{
    const ACTIVATION_TYPE = 'organization';

    /**
     * Make the member's access match what their organisation currently allows.
     * Safe to call repeatedly; it only writes when something is actually out of
     * step.
     *
     * @return bool true when anything was changed
     */
    public static function sync(User $user, ImwellOrg $org)
    {
        $changed = static::syncUserFlags($user);
        $changed = static::syncSubscription($user, $org) || $changed;

        return $changed;
    }

    /** A fingerprint of what the member's access should look like right now. */
    public static function fingerprint(User $user, ImwellOrg $org)
    {
        $keys = $org->enabledFeatureKeys();
        sort($keys);

        return md5($org->id . '|' . (int) $org->status . '|' . implode(',', $keys));
    }

    // ------------------------------------------------------------------

    protected static function syncUserFlags(User $user)
    {
        $changed = false;

        if ((int) $user->payment_status !== 1) {
            $user->payment_status = 1;
            $changed = true;
        }

        if ((int) $user->step_position !== 4) {
            $user->step_position = 4;
            $changed = true;
        }

        if ((int) $user->doctor_step !== 5) {
            $user->doctor_step = 5;
            $changed = true;
        }

        if (empty($user->expiry_date) || $user->expiry_date < date('Y-m-d')) {
            $user->expiry_date = date('Y-m-d', strtotime('+50 years'));
            $changed = true;
        }

        if ($changed) {
            $user->save();
        }

        UserMeta::firstOrCreate([
            'prefix'     => 'iwilltilimwell',
            'user_id'    => $user->id,
            'meta_key'   => 'counseling-type',
            'meta_value' => 'counseling-consent',
        ]);

        return $changed;
    }

    /**
     * Create or refresh the organisation-sponsored subscription so the services
     * the admin enabled are the services the member can actually see.
     */
    protected static function syncSubscription(User $user, ImwellOrg $org)
    {
        $serviceList = static::serviceListFor($org);

        $existing = DB::table('braintree_subscription')
            ->where('user_id', $user->id)
            ->where('activation_type', static::ACTIVATION_TYPE)
            ->orderByDesc('id')
            ->first();

        if ($existing) {
            if ($existing->package_service_list === $serviceList
                && $existing->subscription_status === 'active') {
                return false;
            }

            DB::table('braintree_subscription')
                ->where('id', $existing->id)
                ->update([
                    'package_service_list' => $serviceList,
                    'subscription_status'  => 'active',
                    'subscription_end_date' => date('Y-m-d', strtotime('+50 years')),
                    'updated_at'           => date('Y-m-d H:i:s'),
                ]);

            return true;
        }

        // A member who bought their own plan before joining an organisation
        // keeps that subscription; do not add a sponsored one on top.
        $ownSubscription = DB::table('braintree_subscription')
            ->where('user_id', $user->id)
            ->where('subscription_status', 'active')
            ->exists();

        if ($ownSubscription) {
            return false;
        }

        DB::table('braintree_subscription')->insert([
            'user_id'               => $user->id,
            'plan_id'               => $user->plan ?: 0,
            'amount'                => 0,
            'final_amount'          => 0,
            'package_service_list'  => $serviceList,
            'optional_service'      => '',
            'optional_amount'       => 0,
            'activation_type'       => static::ACTIVATION_TYPE,
            'commission_rate'       => 0,
            'commission_amount'     => 0,
            'subscription_start_date' => date('Y-m-d'),
            'subscription_end_date' => date('Y-m-d', strtotime('+50 years')),
            'auto_renewal'          => '0',
            'subscription_type'     => 'monthly',
            'terms_accepted'        => 1,
            'terms_accepted_at'     => date('Y-m-d H:i:s'),
            'subscription_status'   => 'active',
            'created_at'            => date('Y-m-d H:i:s'),
        ]);

        return true;
    }

    /** Comma separated service ids for every feature the org has enabled. */
    public static function serviceListFor(ImwellOrg $org)
    {
        $enabled = $org->enabledFeatureKeys();
        $ids = [];

        foreach (Features::all() as $feature) {
            if (in_array($feature['key'], $enabled, true)) {
                foreach ((array) ($feature['services'] ?? []) as $id) {
                    $ids[] = (int) $id;
                }
            }
        }

        $ids = array_values(array_unique($ids));
        sort($ids);

        return implode(',', $ids);
    }
}
