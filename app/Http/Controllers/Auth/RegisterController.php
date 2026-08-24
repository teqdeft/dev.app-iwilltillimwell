<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Stripe\StripeClient;
use Session;
use App\Models\States;
use App\Models\Timezones;

use Stripe;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:20', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * override registration form.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function showRegistrationForm(Request $request) {
        $plans = $this->stripe->plans->all();
		$app_agent = $request->header('app-agent')??'web-app';
		Session::put('app_agent', $app_agent);

		// Capture a landing promo code (e.g. /register?promo=NABV000) into the
		// session so it survives registration and drives the plan screen
		// (plan filter + auto-apply). Harmless when no `promo` param is present.
		if ($request->filled('promo')) {
			session(['landing_promo' => trim($request->query('promo'))]);
		}

        if(Session::has('fromAWMI'))
        {
            //$siteFolder = '/teqdeft_iwilltilimwell'; // Specify the folder path here

            $currentScript = $_SERVER['PHP_SELF'];
            $basePath = dirname($currentScript);
            
            $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            
            if ($basePath === '/iwilltilimwell') {
                $siteUrl = $scheme . '://' . $_SERVER['HTTP_HOST'] . $basePath;
            } else {
                $siteUrl = $scheme . '://' . $_SERVER['HTTP_HOST'];
            }
            header('Location:'.$siteUrl.'/awmi-register');
            exit;
        }

        // $intent = $user->createSetupIntent();
        $states = States::all();
        $timezones = TimeZones::all();

        // override the actual register page
        // if (isMobile()) {
        //     return view('mobile.auth.register');    
        // }

        if (isMobile()) {
            return view("mobile.auth.register", compact(["plans", "states", "timezones"]));    
        }
     
        return view("auth.register", compact(["plans", "states", "timezones"]));
    }
}
