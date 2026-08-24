<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Validators\User\RegisterValidator;
use App\Validators\User\LoginValidator;

use App\Mail\ApiUserVerify;
use App\Mail\ApiForgotPassword;

use App\Transformers\UserTransformer;
use App\Http\Controllers\ConsultationController;

use DB;
use Auth;
use Config;

use App\Models\User;
use App\Traits\ApiResponse;

/**
 * Class Authenticate
 *
 * @package Authenticate\controllers
 *
 * @author  Teqdeft [https://www.teqdeft.com/]
 */
class AuthenticateController extends Controller
{
	use ApiResponse;

    public function register(Request $request, RegisterValidator $registerValidator) {
    	try {
            
    		DB::beginTransaction();
    		$input = $request->all();
            $input['user_role'] = $input['user_role'] ?? Config::get('constants.APP_USER');

    		if (!$registerValidator->with($input)->passes()) {
    			return $this->failResponse([
    				"message" => $registerValidator->getErrors()[0],
    				"messages" => $registerValidator->getErrors()
    			], 200);
    		}

            // validate email on tele medicine //
            $result = (new ConsultationController)->validateEmail($input['email']);
            $data = User::where('email', '=', $input['email'])->first();
	        $valid_email = isset($result['availableForUse']) ? $result['availableForUse'] : false;
	    
            if ($data || (!$valid_email) || !$result['success']) {
                return $this->failResponse([
    				"message" => "The email has already been taken",
    			], 200);
            }

    		$password = $input['password'];
            $input['step_position'] = 2;
            $input['name'] = $input['fname'] .' '. $input['lname'];
            $input['password'] = Hash::make($input['password']);
            $input['user_password'] = base64_encode($password);

    		$user = User::create($input);
    		$user->user_role = $input['user_role'];
    		$user->email_token = substr(number_format(time() * rand(), 0, '', ''), 0, 4);
    		$user->save();

    		DB::commit();

    		Mail::to($user->email)->send(new ApiUserVerify($user));

    		return $this->successResponse([
    			"message" => "An email has been sent to your email address with verification process!",
    			"data" => (new UserTransformer())->singleTransform($user)
    		]);

    	} catch (\Exception $e) {
    		return $this->failResponse([
    			"message" => $e->getMessage(),
    		], 200);
    	}
    }

}