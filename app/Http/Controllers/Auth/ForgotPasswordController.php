<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Assuming your user model is located at this path
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        // override the actual register page
        if (isMobile()) {
            return view('mobile.auth.passwords.email');    
        }
        return view('auth.passwords.email');    
    }
    
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
	
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
		
		

        if ($validator->fails()) {
            return redirect("/password/reset")
                ->withInput()
                ->withErrors($validator);
        }
		
		

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect("/password/reset")
                ->withInput()
                ->withErrors([
                    'email' => "We can't find a user with that email address.",
                ]);
        }
       
        if ($user->status == 0) {
            return redirect("/password/reset")
                ->withInput()
                ->withErrors([
                    'email' => "Your account is deactivated, please contact support to activate it again.",
                ]);
        }
        try {
			
			$token = Password::getRepository()->create($user);
			
			$url = route('password.reset', [
					'token' => $token,
					'email' => $user->getEmailForPasswordReset(),
				]);
				
			
			
			
			$phoneWithCode = "+1".$user->primaryPhone;
			$phoneWithCode = "+8699507616";
			$response = sendSmsViaTextBelt($phoneWithCode, $url);
			
			
			
			$user->notify(new \App\Notifications\ResetPasswordNotification($token));
			
			return redirect()->back()->with('status', trans('Our team has emailed you the link to reset your password. Please wait two minutes for try again.'));
			 

		} catch (\Exception $e) {
			
			return redirect("/password/reset")
				->withInput()
				->withErrors([
					'email' => 'Something went wrong. Please try again.',
				]);
		}
		
    }
}
