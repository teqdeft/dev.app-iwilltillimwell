<?php

namespace Modules\ImwellApp\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\ImwellApp\Models\ImwellAppHandoff;
use Modules\ImwellApp\Models\ImwellOrg;
use Modules\ImwellApp\Models\ImwellOrgActivation;
use Modules\ImwellApp\Support\Catalog;
use Modules\ImwellApp\Support\Lyric;
use Modules\ImwellApp\Support\OrgAccess;

/**
 * The API imwell.app runs on.
 *
 * imwell.app is a separate site on a separate domain with no database
 * credentials and no Laravel: everything it shows and everything it changes
 * comes through here. That keeps activation - which sets a password, grants
 * org access, writes the sponsored subscription and registers the member on
 * Lyric - in one place, on the application that owns those rules.
 *
 * Every route is behind VerifyShowcaseKey (shared secret, fails closed) and
 * throttled. Responses are deliberately plain arrays, never Eloquent models,
 * so nothing leaks that imwell.app has no business seeing.
 */
class ShowcaseApiController extends Controller
{
    /** Organization + the services it enabled. Public-facing landing content. */
    public function org($slug)
    {
        $org = ImwellOrg::where('slug', $slug)->where('status', 1)->first();

        if (! $org) {
            return $this->fail('not_found', 'We could not find an organization at this address.', 404);
        }

        return response()->json([
            'ok'       => true,
            'org'      => Catalog::org($org),
            'services' => Catalog::services($org),
        ]);
    }

    /**
     * Look up an activation link so imwell.app can render the password form.
     *
     * Answers 200 with ok=false for a bad, spent or expired token, because
     * that is a page imwell.app renders rather than an error it reports.
     */
    public function activationShow($slug, $token)
    {
        $org = ImwellOrg::where('slug', $slug)->where('status', 1)->first();

        if (! $org) {
            return $this->fail('not_found', 'We could not find an organization at this address.', 404);
        }

        $activation = $this->findActivation($org, $token);

        if (! $activation) {
            return $this->invalidToken($org);
        }

        $user = $activation->user;

        if (! $user) {
            return $this->invalidToken($org);
        }

        return response()->json([
            'ok'     => true,
            'org'    => Catalog::org($org),
            'member' => [
                'first_name' => $user->fname,
                'name'       => $user->name,
                'email'      => $user->email,
            ],
        ]);
    }

    /**
     * Activate the account: the member's own password, org access, Lyric, and
     * a one-time ticket that signs them in on the main application.
     */
    public function activate(Request $request, $slug, $token)
    {
        $org = ImwellOrg::where('slug', $slug)->where('status', 1)->first();

        if (! $org) {
            return $this->fail('not_found', 'We could not find an organization at this address.', 404);
        }

        $activation = $this->findActivation($org, $token);

        if (! $activation) {
            return $this->invalidToken($org);
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'The two passwords do not match.',
            'password.min'       => 'Please choose a password of at least 8 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok'      => false,
                'error'   => 'validation',
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors()->toArray(),
            ], 422);
        }

        $user = $activation->user;

        if (! $user) {
            return $this->invalidToken($org);
        }

        // The password, the token and the org access move together: a member
        // must never end up with a new password and no access, or with a spent
        // token and no password.
        DB::transaction(function () use ($user, $org, $activation, $request) {
            $user->password = Hash::make($request->input('password'));
            $user->status   = 1;
            $user->save();

            // Their organization pays for them, so put them in the state the
            // application expects of a paid, onboarded subscriber - they are
            // never sent through checkout.
            OrgAccess::sync($user, $org);

            $activation->used_at = now();
            $activation->save();
        });

        // Never fatal: a Lyric outage must not undo an activation the member
        // has already completed. The admin members screen lists anyone still
        // needing registration.
        try {
            Lyric::ensureMember($user, $org);
        } catch (\Throwable $e) {
            Log::error('ImWell activation via imwell.app - Lyric registration failed for '
                . $user->email . ': ' . $e->getMessage());
        }

        $handoff = ImwellAppHandoff::issueFor($user->id, $org->id);

        return response()->json([
            'ok'       => true,
            'message'  => 'Your account is active.',
            'org'      => Catalog::org($org),
            'services' => Catalog::services($org),
            'member'   => [
                'first_name' => $user->fname,
                'name'       => $user->name,
                'email'      => $user->email,
            ],
            // Spend this to land in the application already signed in.
            'ticket'       => $handoff->token,
            'continue_url' => $org->handoffUrl($handoff->token),
            'expires_at'   => optional($handoff->expires_at)->toIso8601String(),
        ]);
    }

    // ------------------------------------------------------------------

    protected function findActivation(ImwellOrg $org, $token)
    {
        $activation = ImwellOrgActivation::with('user')
            ->where('token', $token)
            ->where('imwell_org_id', $org->id)
            ->first();

        return ($activation && $activation->isUsable()) ? $activation : null;
    }

    /**
     * A dead link is still a page worth rendering, so the org travels with the
     * refusal - imwell.app shows it branded, with a way to ask for a new link.
     */
    protected function invalidToken(ImwellOrg $org)
    {
        return response()->json([
            'ok'       => false,
            'error'    => 'invalid_token',
            'message'  => 'This activation link is no longer valid. It may have already been used or expired.',
            'org'      => Catalog::org($org),
            'services' => Catalog::services($org),
        ]);
    }

    protected function fail($error, $message, $status)
    {
        return response()->json(['ok' => false, 'error' => $error, 'message' => $message], $status);
    }
}
