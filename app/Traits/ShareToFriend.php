<?php

namespace App\Traits;
use App\Models\User;
use Twilio\Rest\Client;
use Twilio\Rest\Lookups_Services_Twilio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\SendToFriendFeel;
use App\Models\SendToFriendList;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

trait ShareToFriend
{


    function sendByMail($email,$message){
        try{
            $username = Auth::user()->name;
            $message['title'] = "{$username}'s {$message['title']}";
            if(Mail::to($email)->send(new SendToFriendFeel($email,$message,$username))){
                return true;
            }
            return false;
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }

    function sendByMsg($no,$message){
        try {
            $account_sid = getenv("TWILIO_MSG_ACCOUNT_SID");
            $auth_token = getenv("TWILIO_MSG_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");


            $sid = "{{account_sid}}";
            $token = "{{ auth_token }}";
            $client = new Client($account_sid, $auth_token);

            /* $number = $client->lookups->v1->phoneNumbers('+555888555')->fetch(["type" => ["carrier"]]);
            pre($number->carrier);die; 

            $client->messages->create($no, [
                "messagingServiceSid" => "MG643daced9515d9b4687c4089bdb77dd5",
                'body' => $message]);
            */
                $msg = $message; 
                $phoneWithCode = $no;
                sendSmsViaTextBelt($phoneWithCode, $msg);   



        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }

    function checkSendType($user_id,$typeModule,$data){

        try{

            $supporters = SendToFriendList::where(['user_id' => $user_id,'frequency' => 'Daily' ])->get();

            if( $supporters ){
                foreach($supporters as $key => $value){
                    if( !empty($value->information) ){
                        $share_module = array_keys(json_decode($value->information,true));
                        if( in_array($typeModule,$share_module) ){
                             $this->sendByMsg($value->phone,$data['phone']);
                             $this->sendByMail($value->email,$data['email']);
                        }

                    }


                }

            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

}
