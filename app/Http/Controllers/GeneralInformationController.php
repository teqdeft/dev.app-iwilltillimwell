<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class GeneralInformationController extends Controller
{
    
    public function index(Request $Request) {

        if($Request->type=="window-information") {
            if(isMobile()) {
                 $this->GetWindowScreenInformation($Request);
            } else {
                return redirect('/');
            }
        } else if($Request->type=="save-window-information") {
            $this->SaveWindowScreenInformation($Request);
        } else if($Request->type=="get-access-token") {
            $this->getAccessTokenSignelSignIn($Request);
        } else {
                $this->OnlyForLyricApiCalled($Request);
        }

    }
    public function OnlyForLyricApiCalled($Request){
         $user = Auth::user();
         if($user) {
            
            if($Request->type=="lyric-add-member") {
                $reg_res = (new ConsultationController)->storeGeneralInfo($user);
            } else if($Request->type=="lyric-update-member") {
                $reg_res = (new ConsultationController)->updateGeneralInfoApp($user);
            } else if($Request->type=="lyric-get-doctors-list") {
                
                echo  "Test with primaryExternalId <br/> <br/>";
                $reg_res = (new ConsultationController)->getDoctorsList($Request,Auth::user()->id);
                echo "<pre>";
                print_r($reg_res);
                echo "</pre>";
                
                /* echo  "Test with Lyric userID <br/> <br/>";
                $reg_res = (new ConsultationController)->getDoctorsList(Auth::user()->userid);
                echo "<pre>";
                print_r($reg_res);
                echo "</pre>"; */
                
                
                
                exit();
            
            } else if($Request->type=="lyric-create-token-number") {
                try {
                    
                     (new ConsultationController)->storeGeneralInfo($user);
                    $reg_res = (new ConsultationController)->setMemberSession($user);
                } catch (Exception $e) { // Fix: Correct spelling and class name
                    $reg_res = $e->getMessage(); // Fix: Use getMessage() instead of message()
                }
                
            }
            echo "<pre>";
            print_r($reg_res);
            echo "</pre>";    
         }
    }
    public function GetWindowScreenInformation($request) {
        ?>
            <script>
                let width = window.innerWidth;
                let height = window.innerHeight;
                let data = { width:width,height:height};
                let url = "<?php echo url('/general-information/save-window-information') ?>";
                let csrfToken = "<?php echo csrf_token(); ?>"; 
                console.log(url);
                fetch(url, {method: "POST",headers: { "Content-Type": "application/json","X-CSRF-TOKEN": csrfToken },body: JSON.stringify(data)})
                .then(data => console.log("Server Response:", data));
                
            </script>
            <?php
    }
    public function SaveWindowScreenInformation($request) {
        $data = json_decode($request->getContent(), true);
        if($data) {
            session(['window_width' => $data['width']]);
            return true;
        }
    }
	
    public function getAccessTokenSignelSignIn($request) {
		
		try {
			
			$user['memberExternalId'] = '55327';
			$user['groupId'] = 'MTMIWTIW01';
			$post_url = 'https://staging.getlyric.com/go/api/sso/createAccessTokenWithGroupId';
            $reg_res = (new ConsultationController)->postToteleMedicine($user,$post_url,true,false);
			
         } catch (Exception $e) { 
            $reg_res = $e->getMessage();
        }
		
		
		echo "<pre>";
		print_r($reg_res);
		echo "</pre>";
echo "============";		
				
		/* 
		
		 $response = $this->postToteleMedicine($tele_data, $post_url, true, true);
		
       $curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://staging.getlyric.com/go/api/sso/createAccessTokenWithGroupId',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('memberExternalId' => '55327','groupId' => 'MTMIWTIW01'),
		 
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo "<pre>";
		print_r(json_decode($response));
		echo "</pre>";
		echo "/////"; */
	   
	   
    }


}
