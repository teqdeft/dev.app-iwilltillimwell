<?php

namespace Modules\ImwellApp\Support;

use App\Http\Controllers\ConsultationController;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\ImwellApp\Models\ImwellOrg;

/**
 * Registers organisation members on Lyric (the telemedicine backend) and opens
 * their Lyric session, so consultations, health records and lab reports work
 * for them exactly as they do for a normal subscriber.
 *
 * Why this exists rather than calling ConsultationController::storeGeneralInfo():
 *
 *  - storeGeneralInfo() reads Auth::user() and expects the full registration
 *    wizard payload, which an imported member has never been through.
 *  - it emails a UserRegister mail containing a plaintext password. Org members
 *    have already had their own activation link, so a second mail with a
 *    password they never chose would be wrong and confusing.
 *
 * PASSWORDS. Lyric needs a password it can authenticate with, and the app
 * stores that as base64 in users.user_password. We deliberately do NOT put the
 * member's own password there. Instead each member gets a long random
 * Lyric-only password, generated here and never shown to anyone. The member's
 * real password stays bcrypt-only, and setMemberSession() still works because
 * it reads user_password.
 */
class Lyric
{
    /** users.userid holds the Lyric member id once registered. */
    public static function isRegistered(User $user)
    {
        return ! empty($user->userid);
    }

    /**
     * Make sure this member exists on Lyric. Safe to call repeatedly.
     *
     * @return array ['ok' => bool, 'message' => string, 'skipped' => bool]
     */
    public static function ensureMember(User $user, ImwellOrg $org = null)
    {
        if (static::isRegistered($user)) {
            return ['ok' => true, 'message' => 'Already registered.', 'skipped' => true];
        }

        try {
            $consult = new ConsultationController();

            if (empty(Session::get('authorization'))) {
                $consult->apiAuthentication();
            }

            // Already on Lyric under this address (e.g. registered before, or
            // created by another route) - adopt the existing member.
            $check = $consult->validateEmail($user->email);

            if (isset($check['success'], $check['availableForUse']) && ! $check['availableForUse']) {
                if (! empty($check['userid'])) {
                    $user->userid = (string) $check['userid'];
                    $user->save();

                    return ['ok' => true, 'message' => 'Linked to the existing Lyric member.', 'skipped' => false];
                }

                return [
                    'ok'      => false,
                    'skipped' => false,
                    'message' => 'This email already exists on Lyric under a different account.',
                ];
            }

            $missing = static::missingFields($user);

            if ($missing) {
                return [
                    'ok'      => false,
                    'skipped' => false,
                    'message' => 'Missing required detail(s) for Lyric: ' . implode(', ', $missing) . '.',
                ];
            }

            // Lyric-only credential. Never emailed, never shown.
            $lyricPassword = static::generatePassword();

            $payload  = static::payload($user, $lyricPassword);
            $postUrl  = config('constants.tel_api_url') . 'census/createMember';
            $response = $consult->postToteleMedicine($payload, $postUrl, true, true);

            if (! empty($response['success']) && ! empty($response['userid'])) {
                $user->userid        = (string) $response['userid'];
                $user->user_password = base64_encode($lyricPassword);
                $user->groupCode     = $payload['groupCode'];
                $user->planid        = $payload['planid'];
                $user->planDetailsId = $payload['planDetailsId'];
                $user->save();

                return ['ok' => true, 'message' => 'Registered on Lyric.', 'skipped' => false];
            }

            $message = is_array($response) && ! empty($response['message'])
                ? (is_array($response['message']) ? implode(' ', $response['message']) : $response['message'])
                : 'Lyric rejected the registration.';

            Log::warning('ImWell Lyric createMember failed for ' . $user->email . ': ' . $message);

            return ['ok' => false, 'message' => $message, 'skipped' => false];
        } catch (\Throwable $e) {
            Log::error('ImWell Lyric createMember error for ' . $user->email . ': ' . $e->getMessage());

            return ['ok' => false, 'message' => $e->getMessage(), 'skipped' => false];
        }
    }

    /**
     * Open the member's Lyric session (the Bearer token the medical screens
     * need). Never throws - a Lyric outage must not block sign in.
     */
    public static function openSession(User $user)
    {
        if (! static::isRegistered($user) || empty($user->user_password)) {
            return false;
        }

        if (Session::get('member_auth')) {
            return true;
        }

        try {
            $response = (new ConsultationController())->setMemberSession($user);

            return is_array($response) && isset($response['success']);
        } catch (\Throwable $e) {
            Log::error('ImWell Lyric session error for ' . $user->email . ': ' . $e->getMessage());

            return false;
        }
    }

    /** Fields Lyric requires that an imported member may be missing. */
    public static function missingFields(User $user)
    {
        $missing = [];

        if (empty($user->fname))        { $missing[] = 'first name'; }
        if (empty($user->lname))        { $missing[] = 'last name'; }
        if (empty($user->dob))          { $missing[] = 'date of birth'; }
        if (empty($user->gender))       { $missing[] = 'gender'; }
        if (empty($user->stateid))      { $missing[] = 'state'; }
        if (empty($user->zipCode))      { $missing[] = 'zip code'; }
        if (empty($user->city))         { $missing[] = 'city'; }
        if (empty($user->address))      { $missing[] = 'address'; }
        if (empty($user->primaryPhone)) { $missing[] = 'phone'; }

        return $missing;
    }

    // ------------------------------------------------------------------

    protected static function payload(User $user, $password)
    {
        return [
            'primaryExternalId'            => $user->id,
            'groupCode'                    => config('constants.groupCode'),
            'planid'                       => config('constants.planid'),
            'planDetailsId'                => 3,
            'firstname'                    => $user->fname,
            'lastname'                     => $user->lname,
            'dob'                          => static::dob($user->dob),
            'email'                        => trim($user->email),
            'password'                     => $password,
            'primaryPhone'                 => preg_replace('/\D/', '', (string) $user->primaryPhone),
            'heightFeet'                   => $user->heightFeet ?: 0,
            'heightInches'                 => $user->heightInches ?: 0,
            'weight'                       => $user->weight ?: 0,
            'address'                      => $user->address,
            'address2'                     => $user->address2 ?: '',
            'zipCode'                      => $user->zipCode,
            'city'                         => $user->city,
            'stateid'                      => $user->stateid,
            'timezoneid'                   => $user->timezoneId ?: 1,
            'disableNotifications'         => 0,
            'sendRegistrationNotification' => 0,   // the member already has our activation mail
            'numAllowedDependents'         => 8,
            'language'                     => 'en',
            'customAttributeId'            => '',   // sent empty by the normal
            'customAttributeValue'         => '',   // flow too - kept for parity
            'effectiveDate'                => date('m/d/Y'),
            'gender'                       => static::gender($user->gender),
        ];
    }

    /** Lyric expects m/d/Y. */
    protected static function dob($dob)
    {
        if (! $dob) {
            return '';
        }

        $ts = strtotime((string) $dob);

        return $ts ? date('m/d/Y', $ts) : (string) $dob;
    }

    /** Lyric expects m / f / u. */
    protected static function gender($gender)
    {
        $g = strtolower(trim((string) $gender));

        if ($g === '' ) {
            return 'u';
        }

        if (in_array($g, ['m', 'male'], true)) {
            return 'm';
        }

        if (in_array($g, ['f', 'female'], true)) {
            return 'f';
        }

        return 'u';
    }

    protected static function generatePassword()
    {
        // Mixed case, digits and a symbol - Lyric rejects weak passwords.
        return Str::random(14) . rand(10, 99) . '!aA';
    }
}
