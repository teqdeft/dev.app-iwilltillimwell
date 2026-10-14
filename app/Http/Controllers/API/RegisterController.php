<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Promocode;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Registration for the external partner landing pages (e.g. the NNVA page).
 *
 * Those pages live on another origin, so they cannot use the CSRF/session based
 * `/user-register` route. They POST to `/api/register` instead and, on success,
 * send the member to the `redirect_url` returned here: this app's login screen,
 * where they sign in with the email and password they just chose.
 */
class RegisterController extends Controller
{
    // Attribution forwarded by the landing page, stored as UserMeta (prefix "landing").
    private const ATTRIBUTION_KEYS = [
        'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content',
        'gclid', 'fbclid', 'landing_page',
    ];

    public function register(Request $request)
    {
        if ($request->filled('email') && User::where('email', trim($request->input('email')))->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'An account with this email already exists. Please log in instead.',
                'errors' => ['email' => ['An account with this email already exists. Please log in instead.']],
                'login_url' => route('login'),
            ], 409);
        }

        $minimumAge = (int) config('constants.age_limit', 18);
        $latestDob = now()->subYears($minimumAge)->format('m/d/Y');
        $name = ['required', 'string', 'min:2', 'max:50', "regex:/^[\pL\s'\-]+$/u"];

        $rules = [
            'fname' => $name,
            'lname' => $name,
            'email' => 'required|string|email|max:255|unique:users,email',
            'primaryPhone' => 'required|digits:10|unique:users,primaryPhone',
            'dob' => 'required|date_format:m/d/Y|before_or_equal:' . $latestDob,
            'gender' => 'required|in:m,f,o',
            // Same policy the web sign-up form enforces: 8-20 chars, a letter and a number.
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed', 'regex:/[A-Za-z]/', 'regex:/\d/'],
            'terms' => 'accepted',
            'promo_code' => 'nullable|string|max:30',
            'landing_page' => 'nullable|string|max:2048',
        ];
        foreach (array_diff(self::ATTRIBUTION_KEYS, ['landing_page']) as $key) {
            $rules[$key] = 'nullable|string|max:255';
        }

        $validator = Validator::make($request->all(), $rules, [
            'fname.regex' => 'First name may only contain letters, spaces, hyphens and apostrophes.',
            'lname.regex' => 'Last name may only contain letters, spaces, hyphens and apostrophes.',
            'primaryPhone.digits' => 'Enter a 10-digit US phone number.',
            'primaryPhone.unique' => 'This phone number is already registered.',
            'dob.date_format' => 'Enter your date of birth as MM/DD/YYYY.',
            'dob.before_or_equal' => "You must be at least {$minimumAge} years old to register.",
            'password.regex' => 'Password must contain at least one letter and one number.',
            'terms.accepted' => 'Please agree to the Terms & Conditions and Privacy Policy.',
        ], [
            'fname' => 'first name',
            'lname' => 'last name',
            'primaryPhone' => 'phone number',
            'dob' => 'date of birth',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        try {
            $user = DB::transaction(function () use ($data) {
                $fname = trim($data['fname']);
                $lname = trim($data['lname']);

                // Mirrors UserController::store() so the member continues through
                // the normal plan/payment flow from the dashboard.
                $user = User::create([
                    'fname' => $fname,
                    'lname' => $lname,
                    'name' => $fname . ' ' . $lname,
                    'email' => trim($data['email']),
                    'primaryPhone' => $data['primaryPhone'],
                    'dob' => $data['dob'],
                    'gender' => $data['gender'],
                    'password' => Hash::make($data['password']),
                    // Telemedicine (Lyric) registration reads this back later.
                    'user_password' => base64_encode($data['password']),
                    'step_position' => 2,
                    'access_site' => json_encode(['iwilltilimwell']),
                ]);

                $code = trim($data['promo_code'] ?? '');
                if ($code !== '') {
                    $promo = Promocode::where('code', $code)->first();
                    if ($promo) {
                        $user->promo_code_id = $promo->id;
                        $user->save();
                    }
                    // Kept even when the code is not set up as a Promocode yet,
                    // so the partner attribution is never lost.
                    UserMeta::create(['user_id' => $user->id, 'prefix' => 'landing', 'meta_key' => 'affiliate_code', 'meta_value' => $code]);
                }

                foreach (self::ATTRIBUTION_KEYS as $key) {
                    if (!empty($data[$key])) {
                        UserMeta::create(['user_id' => $user->id, 'prefix' => 'landing', 'meta_key' => $key, 'meta_value' => $data[$key]]);
                    }
                }

                return $user;
            });
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'status' => false,
                'message' => 'We could not create your account right now. Please try again in a moment.',
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Registration successful',
            'redirect_url' => route('login'),
            'user' => [
                'id' => $user->id,
                'fname' => $user->fname,
                'lname' => $user->lname,
                'email' => $user->email,
            ],
        ], 201);
    }
}
