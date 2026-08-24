<?php

namespace App\Http\Controllers\LyricApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class LoginController extends Controller
{
    

    public function loginForm(Request $request) {

            return view('lyric-api.login');

    }

   public function loginPost(Request $request)
    {

        
    try {

        $config = config('constants.modes');
        $mode = $request->mode;
        if(!isset($config[$mode])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid mode'
                ], 400);
        }

        $api = $config[$mode];
        $tel_login_url = $api['login_url'];
        $credentials = [
                'email' => $api['email'],
                'password' => $api['password']
            ];

        $response = curlRequest($tel_login_url, $credentials, true, [], true);
        preg_match('/Authorization:\s*Bearer\s*(.*)/i', $response, $matches);
        $token = $matches[1] ?? "0";
        
        if(!$response) {
                return response()->json([
                    'status' => false,
                    'message' => 'API not responding'
                ], 500);
        }
        return response()->json([
                'status' => true,
                'message' => 'Login API Called Successfully',
                'data' => 'Response received',
                'response'=>$response,
                'token' => $token
            ]);

        } catch (\Throwable $e) {

    
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage() // remove in production
            ], 500);
            
        }

    }

}
