<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Config;
use Session;
class MessageSpecialistController extends Controller
{
    function index(Request $request){
        $imageAsset = asset('msgspec');
        $data = [
            [ 'img' => "{$imageAsset}/General-Practitioner-v1.svg",
              'title' => "General Practitioner",
              'idNo'  => 0 ],
            [ 'img' => "{$imageAsset}/pediatrician-v1.svg",
              'title' => "Psychologist",
              'idNo'  => 1 ],
            [ 'img' => "{$imageAsset}/pharmacist-v1.svg",
              'title' => "Pharmacist",
              'idNo'  => 3 ],
            [ 'img' => "{$imageAsset}/dentist-v1.svg",
              'title' => "Dentist",
              'idNo'  => 4 ],
            [ 'img' => "{$imageAsset}/dentist-v1.svg",
              'title' => "Dietitian",
              'idNo'  => 5 ],
            [ 'img' => "{$imageAsset}/SportsMedicine-v1.svg",
              'title' => "Sports Medicine",
              'idNo'  => 6 ],
            [ 'img' => "{$imageAsset}/AlternativeMedicine-v1.svg",
              'title' => "Alternative Medicine",
              'idNo'  => 8 ],
            [ 'img' => "{$imageAsset}/pediatrician-v1.svg",
              'title' => "Pediatrician",
              'idNo'  => 15 ],
            [ 'img' => "{$imageAsset}/WomensHealth-v1.svg",
              'title' => "Women's Health",
              'idNo'  => 23 ],
            [ 'img' => "{$imageAsset}/Ophthalmologist-v1.svg",
              'title' => "Ophthalmologist",
              'idNo'  => 16 ],
        ];

        $get_url = Config::get('constants.tel_api_url') . 'askASpecialist/getInboxInfo';
        $getInboxInfo = (new ConsultationController)->postToteleMedicine([],$get_url,false);
        if(isMobile()) {
          //$imageAsset = asset('assets/dashboard/assets/images/');
          $data = [ 
                      [ 'img' => "{$imageAsset}/General-Practitioner-v1.svg",'title' => "General Practitioner", 'idNo'  => 0 ],
                      [ 'img' => "{$imageAsset}/pediatrician-v1.svg",'title' => "Psychologist",'idNo'  => 1 ],
                      [ 'img' => "{$imageAsset}/pharmacist-v1.svg",'title' => "Pharmacist",'idNo'  => 3 ],
                      [ 'img' => "{$imageAsset}/dentist-v1.svg",'title' => "Dentist",'idNo'  => 4 ],
                      [ 'img' => "{$imageAsset}/dentist-v1.svg",'title' => "Dietitian",'idNo'  => 5 ],
                      [ 'img' => "{$imageAsset}/SportsMedicine-v1.svg",'title' => "Sports Medicine",'idNo'  => 6 ],
                      [ 'img' => "{$imageAsset}/AlternativeMedicine-v1.svg",'title' => "Alternative Medicine",'idNo'  => 8 ],
                      [ 'img' => "{$imageAsset}/pediatrician-v1.svg",'title' => "Pediatrician",'idNo'  => 15 ],
                      [ 'img' => "{$imageAsset}/WomensHealth-v1.svg",'title' => "Women's Health",'idNo'  => 23 ],
                      [ 'img' => "{$imageAsset}/Ophthalmologist-v1.svg",'title' => "Ophthalmologist",'idNo'  => 16 ],
                 ];

          return view('messageSpecialist.mobile.index',compact('data','getInboxInfo'));
        }
        return view('messageSpecialist.index',compact('data','getInboxInfo'));
    }

    function getMessageHeaders(Request $request){
        $passData = $request->all();
        $inbox = true;
        $post_url = Config::get('constants.tel_api_url') . 'askASpecialist/getMessageHeaders';
        $getMessageHeaders = (new ConsultationController)->postToteleMedicine($passData,$post_url);
        if(isMobile()) {
          
          //$getMessageHeaders['viewData']['eDocMobileServicesMessageHeader'][] =  array("ID"=>"1","ReadDate"=>"23/01/2025","FromName"=>"Test","Subject"=>"Hl","Rcvd"=>"2025");

           return view('messageSpecialist.mobile.getMessageHeaders',compact('getMessageHeaders','inbox'));
        }
        return view('messageSpecialist.getMessageHeaders',compact('getMessageHeaders','inbox'));
    }

    function getMessageHeadersByView(Request $request){
        $passData = $request->all();
        $inbox = false;
        $post_url = Config::get('constants.tel_api_url') . 'askASpecialist/getMessageHeadersByView';
        $getMessageHeaders = (new ConsultationController)->postToteleMedicine($passData,$post_url);
        if(isMobile()) {
          return view('messageSpecialist.mobile.getMessageHeaders',compact('getMessageHeaders','inbox'));
       }
        return view('messageSpecialist.getMessageHeaders',compact('getMessageHeaders','inbox'));
    }

    function getSingleMessage(Request $request){
        $passData = $request->all();
        $docType = [ 'eDoc' => 0,'ePsych' => 1,'ePharm' => 3,'eDent' => 4,
                     'eDietitian' => 5,'eFitness' => 6,'eCAM' => 8,'eKids' => 15,
                     'eVision' => 16,"Women's Health" => 23,'Allergist' => 24];
        $post_url = Config::get('constants.tel_api_url') . 'askASpecialist/getMessage';
        $getMessage = (new ConsultationController)->postToteleMedicine($passData,$post_url);
        
        if(isMobile()) {
          return view('messageSpecialist.mobile.getMessageSingle',compact('getMessage','docType'));
        }
        return view('messageSpecialist.getMessageSingle',compact('getMessage','docType'));

    }

    function postMessage(Request $request){
		
      try {
            $passData = $request->all();			
			unset($passData['_token']);			
			$Route  = $passData['Route'];			
			$PatientId  = $passData['PatientId'];			
			$Subject  = urlencode($passData['Subject']);			
			$Body  = urlencode($passData['Body']);            
			$post_url = Config::get('constants.tel_api_url') ."askASpecialist/postMessage?PatientId=$PatientId&Route=$Route&Subject=$Subject&Body=$Body";
			$getMessage = (new ConsultationController)->postToteleMedicine($passData,$post_url,true,false);	
			
            						
            if(isset($getMessage['viewData']) && $getMessage['viewData']['PostMessageResult'] != 'false' ){
				
				
				return response()->json([
					'success' => true,
					'message' => 'Your message has been sent successfully. You will receive an email confirmation shortly. Our team will get back to you within 24 hours.'
				]);
					
					
				/* if(isMobile()) {
					return response()->json([
						'success' => true,
						'message' => 'Sent successfully You will receive an email confirmation shortly.'
					]);
				} */
                //$request->session()->flash('success', 'Sent successfully You will receive an email confirmation shortly');
				
            }else{
				
				return response()->json([
						'success' => false,
						'message' => 'Something wrong please try again'
					]);
					
				/* if(isMobile()) {
					return response()->json([
						'success' => false,
						'message' => 'Something wrong please try again'
					]);
				} */
				
                //$request->session()->flash('error', 'Something wrong please try again');
            }
			
         } catch (\Exception $e) {
			 
			//if(isMobile()) {}
			 
			 return response()->json([
					'success' => false,
					'message' =>$e->getMessage()
				]);
			 
           // $request->session()->flash('error', $e->getMessage());
        }
		
        //return redirect()->back();
    }

    function archiveMsg(Request $request){
      try{
            $passData = $request->all();

            $post_url = Config::get('constants.tel_api_url') . 'askASpecialist/archiveMsg';
            foreach($passData['msg_id'] as $value){
              $data = ['msg_id' => $value ];
              $getMessage = (new ConsultationController)->postToteleMedicine($data,$post_url);
            }
            $request->session()->flash('success', 'Archive successful!');
         } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
        }
    }

    function postMessageReply(Request $request){

        $data = $request->all();
        $post_url = Config::get('constants.tel_api_url') . 'askASpecialist/postMessageReply';
        $getMessage = (new ConsultationController)->postToteleMedicine($data,$post_url);
        if(isMobile()) {
           if($getMessage['viewData']['PostMessageResult']){
              return ['success' => true,'message' =>"Your message has been send. Please wait some time."];
           } else {
             return ['success' => false,'message' =>"Please Try Again."];
           }
        }
        if($getMessage['viewData']['PostMessageResult']){
           $request->session()->flash('success', 'Your message has been send. Please wait some time.');
        }
        return redirect()->back();
    }





    

}
