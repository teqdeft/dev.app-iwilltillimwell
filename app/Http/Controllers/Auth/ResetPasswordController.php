<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use App\Http\Controllers\ConsultationController;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::LOGIN;

    public function showResetForm(Request $request, $token = null )
    {
        if (isMobile()) {
            return view('mobile.auth.passwords.reset')->with(['token' => $token, 'email' => $request->email]);    
        }
        return view('auth.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {   

        $data['password'] = $password;
        $data['user'] = $user;
        // dd($user);


        // Update Password on Telemedicine
        if ($user->parentId) {
            $result = (new ConsultationController)->updateGeneralInfoRP($data, true);  
        } else {
            $result = (new ConsultationController)->updateGeneralInfoRP($data, true);  
        }

        if($result['success'] || (isset($result['message']) && $result['message'] == "Cannot update member. Member doesn't exist")) { 
            // update password on local database
            $this->setUserPassword($user, $password);
            $user->setRememberToken(Str::random(60));
            $user->user_password = base64_encode($password);
            $user->save();
            event(new PasswordReset($user));
           // $request->session()->flash('success', 'Your password is changed successfully.');
            return redirect($this->redirectTo())->with('success', 'Your password is changed successfully.');
        } else {
            $response = [
                'error' => $result['message']
            ];
            return back()->with($response)->withInput();
        }
    }

    /**
     * Get the path the user should be redirected to.
     *
     * @return string
     */
    public function redirectTo()
    {
        return $this->redirectTo;
    }
}
