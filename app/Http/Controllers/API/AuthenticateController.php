<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{

	 use SendsPasswordResetEmails;
   

	public function login(Request $request)
	{
		
		$agent = $request->header('User-Agent');
		$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
		
		/*
		->select('id', 'fname','lname','email')
		*/
        $user = User::where('email', $request->email)
				->select('id', 'fname','lname','email','password')
				->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials','agent'=>$agent], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
		$user_info = (object)array("id"=>$user->id,"fname"=>$user->fname,"lname"=>$user->lname,"email"=>$user->email);
        return response()->json([
			'message' => 'Login successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user_info
        ]);
	}
	public function forgotPassword(Request $request)
	{
		
		$request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return response()->json(['message' => "We can't find a user with that email address."], 401);
        }
		
		if($user->status == 0) {
			return response()->json(['message' => "Your account is deactivated, please contact support to activate it again."], 401);
		}
		
		try {
			$response = $this->broker()->sendResetLink(
				$request->only('email')
			);

			return response()->json([
				'message' => "We've sent a password reset link to your email. Please check your inbox and follow the instructions to reset your password."
			
			]);
		} catch (\Exception $e) {
			return response()->json(['message' => "Something went wrong. Please try again."], 401);
		}	
	}
	
	
	public function logout(Request $request)
    {
        // Get the user from the Sanctum guard:
        $user = $request->user();  // same as auth()->user()

        if (! $user) {
            return response()->json([
                'message'    => 'Unauthenticated.',
                'statusCode' => 401
            ], 401);
        }

        // Revoke (delete) the token that was used in this request
        $user->currentAccessToken()->delete();

        return response()->json([
            'message'    => 'Logged out successfully.',
            'statusCode' => 200
        ]);
    }
	
	public function sendOtp(Request $request)
	{
		
		$request->validate([
			'mobile' => 'required|digits:10',
		]);
		$user = User::where('primaryPhone', $request->mobile)->first();
		if(!$user) {
			return response()->json(['message' => 'User does not exist'], 401);
		}
		$otp = rand(9999, 1111);
		
		$msg = "$otp is your OTP to register with iwilltilimwell. For any help please contact us."; 
        $phoneWithCode = "+1".$request->mobile;
        $response = sendSmsViaTextBelt($phoneWithCode, $msg);
		$responseData = json_decode($response, true);
		if(isset($responseData['success']) && $responseData['success']) {
			
			$user->otp = $otp;
			$user->otp_expires_at = Carbon::now()->addSeconds(30);
			$user->save();
			
			
			if(env('TEXT_BELT_MODE')=="active") {
				$otp=""; 
			}
			
			
			return response()->json(['message' => 'OTP sent successfully','otp'=>$otp]);
		}
		return response()->json(['message' => 'Failed to send OTP.'], 401);
			
	}
	
	public function verifyOtp(Request $request) 
	{
		 $request->validate([
			'mobile' => 'required|digits:10',
			'otp' => 'required|digits:4',
		]);
		
		/*
		->select('id', 'fname','lname','email')
		*/
		
		$user = User::where('primaryPhone', $request->mobile)
				->select('id', 'fname','lname','email','otp','otp_expires_at')
				->first();
		if(empty($user->otp)) {
			return response()->json(['message' => 'Invalid or expired OTP'], 401);
		}
		if(!$user || $user->otp !== $request->otp || Carbon::now()->gt($user->otp_expires_at)) {
			return response()->json(['message' => 'Invalid or expired OTP'], 401);
		}
		
		$user->otp = null;
		$user->otp_expires_at = null;
		$user->save();
		
		$user_info = (object)array("id"=>$user->id,"fname"=>$user->fname,"lname"=>$user->lname,"email"=>$user->email);
		
		$token = $user->createToken('auth_token')->plainTextToken;
		return response()->json([
			'message' => 'OTP verified successfully',
			'access_token' => $token,
			'token_type' => 'Bearer',
			'user' => $user_info
		]);
	}
	
	public function autoLogin(Request $request){
		
		
	}
	
	
}
