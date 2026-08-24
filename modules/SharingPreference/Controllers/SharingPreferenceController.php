<?php

namespace Modules\SharingPreference\Controllers;

use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Traits\ShareToFriend;
use App\Mail\SendToFriendFeel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{
    Auth,Mail,Crypt
};
use Modules\{
    Mood\Models\UserMood,
    SafetyPlan\Models\SaftyPlanUser,
    Journal\Models\Journal,
    SharingPreference\Models\SendToFriendList,
};
use App\Models\visitor;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Support\Arr;
use Session;
use View;
use App\Models\States;
use Modules\SharingPreference\Validators\AddSupporterValidator;

class SharingPreferenceController extends Controller
{
    public $userId;

    function __construct(){
        $this->middleware(function ($request, $next) {
            $this->userId = Auth::user()->id;
            return $next($request);
       });
    }

    use ShareToFriend;

    function add($type = ""){

        if( empty($type) || !in_array($type,['supporters-phone-number','setting']) )
            abort(404);

        $type = ['type' => $type ];
        $shareModule = "";
        $friendContact = SendToFriendList::getWhereData(['user_id' => $this->userId]);
        $moduleName = [ ['name' => 'screen_history','label' => 'My Screening History' ,'sort' => 4 ],
                        ['name' => 'mood_history','label' => 'My Mood History','sort' => 3 ],
                        ['name' => 'my_mood','label' => 'My Daily Mood','sort' => 1 ],
                        ['name' => 'my_journal','label' => 'My Daily Journal','sort' => 2 ],
                        ['name' => 'my_safety','label' => 'My Safety Plan','sort' => 5 ],
                      ];
        $moduleName = array_values(Arr::sort($moduleName,function($value,$key){
            return $value['sort'];
        }));
        $timeSetting = ['daily','weekly','monthly'];
        $module = User::where('id',$this->userId)->get()->toArray();
        $module = $module[0]??'';
        $shareTime = $module['share_by_time'];
        if( !empty($module['share_module']) ){
            $shareModule = json_decode($module['share_module']);
        }
        $affStatus[0] = $module['affirmation_status'];
        $user = $module;
        $userMeta = UserMeta::getMedicalFields();
        $diffDate = strtotime(date('Y-m-d')) - strtotime(date('Y-m-d',strtotime($user['dob'])));
        $age = date('Y',$diffDate) - 1970;
        

        if(ismobile()){

            return view('SharingPreference::mobile.add',compact('friendContact','moduleName','shareModule',
                        'timeSetting','shareTime','affStatus','user','age','userMeta','type'));

        }

        return view('SharingPreference::add',compact('friendContact','moduleName','shareModule',
                        'timeSetting','shareTime','affStatus','user','age','userMeta','type'));
    }

    public function SupporterAdd(Request $request) {

        $moduleName = [ ['name' => 'screen_history','label' => 'My Screening History' ,'sort' => 4 ],
                        ['name' => 'mood_history','label' => 'My Mood History','sort' => 3 ],
                        ['name' => 'my_mood','label' => 'My Daily Mood','sort' => 1 ],
                        ['name' => 'my_journal','label' => 'My Daily Journal','sort' => 2 ],
                        ['name' => 'my_safety','label' => 'My Safety Plan','sort' => 5 ],
                      ];
        $data=""; 
        if($request->id){
            $data = SendToFriendList::getWhereData(['id' => $request->id ]);
        }             
    
        return view('SharingPreference::mobile.supporter-add',compact('moduleName','data'));
    }

    function userAccess(Request $request,$type = ""){
        $user = Auth::user();
        $companyServices = $user->companyData->services_status??'';
        $viewPath = ['general-information','medical-consent','counseling-consent'];
        $userMeta = UserMeta::getMedicalFields();
        /* $services = !empty($companyServices)?
                        json_decode($companyServices,true):''; */

        $services = [ 'medical-care' => 'medical_care',
                            'emotional-wellness' => 'counseling','tele-pet-now' => 'pet_care'];

        $generalOption = [ 'medical-care' => 'medical_care',
                            'emotional-wellness' => 'counseling','tele-pet-now' => 'pet_care'];
        $optionData = array_map(function($array,$key,$value) use ($services) {
            if((in_array($key,array_keys($services)))){
                $array[$value] = ($services[$key])?'yes' :'no';
            }
            return $array;
        },$array = [],array_keys($generalOption),$generalOption);
        $optionData = singleArray($optionData);
        $userDetails = single_user_details($user->id);
		$states = States::all();
		
        $data     =  [ 'userMeta' => $userMeta,'states'=>$states  ] + ['type' => $type ] + ['services' => $optionData ] + ['user' => $userDetails];
        if( !empty($type) && in_array($type,$viewPath)  ){
            if( $type == 'general-information' ){
                $data = $this->generalInformation($data);
            }
            if(ismobile()){
                return view("SharingPreference::user.mobile.{$type}",$data);
            }
            return view("SharingPreference::user.{$type}",$data);
        }
        abort(404);
    }

    function saveConsentData(Request $request){
        $data = $request->all();
        $redirect = "share/user/counseling-consent";
        //$services = isset(Auth::user()->companyData->services_status)?json_decode(Auth::user()->companyData->services_status,true):'';
        try{
            if( $data['type'] == 'general-information' ){
                $name = explode(" ",$data['fullname']);
                $userDetails = [
                    'name' => $data['fullname'],
                    'fname' => $name[0]??'',
                    'lname' => $name[1]??'',
                    'gender' => $data['gender']??'',
                    'address' => $data['home_address']??'',
                    'primaryPhone'   => $data['phone']??'',
                    'dob' => $data['dob']??''
                ];

                $redirect = "share/user/medical-consent";
               /*  if( $services['medical-care'] ){
                    if( $data['medical_care'] != 'yes' ){
                        Session::Flash('error',trans('flash.saveConsentData_medical_care'));
                        return redirect()->back();
                    }
                }

                if( $services['emotional-wellness'] ){
                    if( $data['counseling'] != 'yes' ){
                        Session::Flash('error',trans('flash.saveConsentData_counseling'));
                        return redirect()->back();
                    }
                }

                if( $services['tele-pet-now'] ){
                    if( $data['pet_care'] != 'yes' ){
                        Session::Flash('error',trans('flash.saveConsentData_pet_care'));
                        return redirect()->back();
                    }
                } */

                User::UserUpdate($userDetails);
                unset($data['fullname'],$data['gender'],$data['home_address'],$data['phone'],$data['_token']);
                $message = "Profile successfully updated";

                /* if( !$services['medical-care'] && !$services['emotional-wellness'] && $services['tele-pet-now'] ){
                    $redirect = "pets";
                }

                if( !$services['medical-care'] && $services['emotional-wellness'] && !$services['tele-pet-now'] ){
                    $redirect = "share/user/counseling-consent";
                }

                if( $services['medical-care'] ){
                } */

            }
            unset($data['_token']);
            if( $data ){
                foreach($data as $key => $value){
                    if( is_array($value) ){
                        $key = str_replace("[]","",$key);
                        $value = 1;
                    }
                    UserMeta::consentUpdate(['meta_key' => $key,'meta_value' => $value,'prefix' => 'iwilltilimwell' ]);
                }
            }



            if( $data['type'] == 'medical-consent' ){
                $redirect = "share/user/counseling-consent";
                $message = "Medical consent edit successfully";
            }elseif( $data['type'] == 'counseling-consent' ){
                if ( !checkProfileComplete() && !checkHealthRecordStart() ){
                     $redirect = "dashboard";
                }
                $message = "Medical Consent Form Signed Successfully";
            }

            $request->session()->flash('success',$message);

              if(isset($_POST['request_from'])) {
                
                /*
                $userDetails = [
                    'dob' => $data['dob']
                ];
                User::UserUpdate($userDetails);
                */
                return redirect()->to('dashboard');
                
              }  

            return redirect("{$redirect}");
        }catch(Exception $e ){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    function generalInformation($data){
        $user = User::where('id',$this->userId)->get()->first();
        $diffDate = strtotime(date('Y-m-d')) - strtotime(date('Y-m-d',strtotime($user['dob'])));
        $age = date('Y',$diffDate) - 1970;
        return $data + ['user' => $user,'age' => $age ];
    }

    function save_module(Request $request){
        $data = $request->all();
        $shareModule = "";
        if( !empty($request->input('share_module')) ){
            $shareModule = json_encode($request->input('share_module'));
        }
        User::where('id',$this->userId)->update(['share_module' => $shareModule ]);
    }

    function addMailAndPhone(Request $request){
        $data = $request->all();
        $SupporterValid = new AddSupporterValidator;
        if (!$SupporterValid->with($data)->passes()) {

            $request->session()->flash('error',trans($SupporterValid->getErrors()[0]));
            return redirect()->back();

            //return \json_encode(['message' => $SupporterValid->getErrors()[0],'status' => 0 ]);
        }

        if( SendToFriendList::where('user_id',Auth::user()->id)->where(function($query) use($data){
        $query->where(['email' => $data['email']])
            ->orWhere(['phone' => $data['phone'] ]);
        })->count() > 0 ){
            $request->session()->flash('error',trans('flash.addMailAndPhone_email_exist'));
            return redirect()->back();
        }
        $data['user_id'] = Auth::user()->id;
        $data['name'] = "{$data['first_name']} {$data['last_name']}";
        if( isset($data['moduleName']) && !empty($data['moduleName']) ){
            $data['information'] =  json_encode($data['moduleName']);
            unset($data['moduleName']);
        }
        if( isset($data['affirmation']) && !empty($data['affirmation']) ){
            $data['affirmation'] =  json_encode($data['affirmation']);
        }
        if( isset($data['phone']) && !empty($data['phone']) ){
            $data['phone'] =  str_replace(['(',')','-'],['','',''],$data['phone']);
        }
        unset($data['_token']);
        $data = $data + ['share_date_time' => date('Y-m-d h:i:s')];
		
		SendToFriendList::insert($data);
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		
        
        UserMeta::consentUpdate(['meta_key' => 'checkSettingComplete','meta_value' => 1]);
        UserMeta::consentUpdate(['meta_key' => 'personal_setting','meta_value' => 1 ]);
        $request->session()->flash('success','Supporter’s Succesfully added');
        if(isMobile()) {
            return redirect()->to('share/add/setting');
        }
        return redirect()->back();

    }

    function loadEditContactForm(Request $request){
        $data = SendToFriendList::getWhereData(['id' => $request->input('id') ]);
        $moduleName = [ ['name' => 'screen_history','label' => 'My Screening History' ,'sort' => 4 ],
                        ['name' => 'mood_history','label' => 'My Mood History','sort' => 3 ],
                        ['name' => 'my_mood','label' => 'My Daily Mood','sort' => 1 ],
                        ['name' => 'my_journal','label' => 'My Daily Journal','sort' => 2 ],
                        ['name' => 'my_safety','label' => 'My Safety Plan','sort' => 5 ],
                      ];
        $moduleName = array_values(Arr::sort($moduleName,function($value,$key){
            return $value['sort'];
        }));
         return response()->json(['data' => View::make('SharingPreference::setting.settingUpdate',compact('data','moduleName'))->render()]);
    }



    function saveFriendContactData(Request $request){
        $data = $request->all();
        $id   = $data['id'];
        $affirmationWebMob = $data['affirmation']??'';
        $SupporterValid = new AddSupporterValidator;
        if (!$SupporterValid->with($data)->passes()) {
            $request->session()->flash('error',$SupporterValid->getErrors()[0]);
            return redirect()->back();
            return \json_encode(['message' => $SupporterValid->getErrors()[0],'status' => 0 ]);
        }

        if( isset($data['phone']) && !empty($data['phone']) ){
            $data['phone'] =  str_replace(['(',')','-'],['','',''],$data['phone']);
        }


        if( SendToFriendList::where(['user_id' => Auth::user()->id])->where('id','!=',$id)->where(function($query) use($data){
        $query->where(['email' => $data['email']])
            ->orWhere(['phone' => $data['phone'] ]);
        })->count() > 0 ){
            $request->session()->flash('error',trans('flash.addMailAndPhone_email_exist'));
            return redirect()->back();
        }

        $data['name'] = "{$data['first_name']} {$data['last_name']}";
        $data['affirmation'] = $data['information'] = "";

        if( isset($data['moduleName']) && !empty($data['moduleName']) ){
            $data['information'] =  json_encode($data['moduleName']);
            unset($data['moduleName']);
        }
        if( isset($data['affirmation']) && !empty($data['affirmation']) ){
            $data['affirmation'] =  json_encode($data['affirmation']);
        }
        if( isset($affirmationWebMob) && !empty($affirmationWebMob) ){
            $data['affirmation'] =  json_encode($affirmationWebMob);
        }
        unset($data['_token'],$data['id']);
        SendToFriendList::where('id',$id)->update($data);
        $request->session()->flash('success',trans('flash.saveFriendContactData_success_add'));
        return redirect()->back();
    }

    function sendMsg($no,$message){
        try {
            $account_sid = getenv("TWILIO_MSG_ACCOUNT_SID");
            $auth_token = getenv("TWILIO_MSG_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($no, [
                "messagingServiceSid" => "MG643daced9515d9b4687c4089bdb77dd5",
                'body' => $message]);
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }

    function sendMail($email,$message){
        $username = Auth::user()->name;
        Mail::to($email)->send(new SendToFriendFeel($email,$message,$username));
    }

    function deleteFriendContact(Request $request){
        SendToFriendList::where('id',$request->input('id'))->delete();
        $request->session()->flash('success',trans('Supporter Successfully Deleted'));
    }

    function shareModuleTime(Request $request){
        $shareDateTime = User::where('id',$this->userId)->pluck('share_date_time');
        if( empty($shareDateTime[0]) ){
            User::where('id',$this->userId)->update(['share_date_time' => date('Y-m-d') ]);
        }
        User::where('id',$this->userId)->update(['share_by_time' => $request->input('time') ]);
    }

    function shareDataToFriend(){
        ini_set('max_execution_time', 1800);
        $moduleType = [
            ['type' => 'screen_history','name' => 'screen-history','linkMode' => true,'objectType' => ""],
            ['type' => 'mood_history','name' => 'mood-history','linkMode' => true,'objectType' => ""],
            ['type' => 'my_mood','name' => 'my-mood','linkMode' => false,'objectType' => new UserMood()],
            ['type' => 'my_journal','name' => 'my-journal','linkMode' => false,'objectType' => new Journal()],
            ['type' => 'my_safety','name' => 'my-safty','linkMode' => false,'objectType' => new SaftyPlanUser()],
        ];

        $users = SendToFriendList::get()->toArray();
        $currentStartDate = date('Y-m-d',strtotime("-1 days"));
        $currentEndDate   = date('Y-m-d',strtotime("-1 days"));
        if( $users ){
            $updateShareDtime = false;
            foreach($users as $userKey => $userValue){
                if( !empty($userValue['information']) ){
                    $shareModule = array_keys(json_decode($userValue['information'],true));
                    $userShareDate = date('Y-m-d',strtotime($userValue['share_date_time']));
                    if( $userShareDate == $currentStartDate  ){
                        $data = ['userValue' => $userValue,'currentStartDate' => $currentStartDate,'currentEndDate' => $currentEndDate];
                        foreach($shareModule as $shareKey => $shareValue){
                           $getKey = array_search($shareValue, array_column($moduleType, 'type'));
                           if( isset($moduleType[$getKey]) ){
                                $this->shareAccordingToTime($moduleType[$getKey]['name'],$data,$moduleType[$getKey]['linkMode'],$moduleType[$getKey]['objectType']);
                           }
                        }
                    }
                }
            }
        }

    }


    function shareAccordingToTime($screenType,$data,$linkMode,$obj){
        $bodyHtml = $bodyData = [];
        $moodHtml = $htmlJournal = $saftyHtml =$mood = $journal = $safty = "";
        extract($data);
        $currentStartDate = date('Y-m-d 00:00',strtotime($currentStartDate));
        $currentEndDate = date('Y-m-d 23:59',strtotime($currentEndDate));
        if( $userValue['frequency'] == 'Daily' ){
            $updateDate = date("Y-m-d",strtotime('+1 days',strtotime($userValue['share_date_time'])));
        }elseif( $userValue['frequency'] == 'Weekly' ){
            $currentStartDate = date("Y-m-d 00:00:00",strtotime('-7 days'));
            $updateDate = date("Y-m-d",strtotime('+7 days',strtotime($userValue['share_date_time'])));
        }elseif( $userValue['frequency'] == 'Monthly' ){
            $currentStartDate = date("Y-m-d 00:00:00",strtotime('-1 months'));
            $updateDate = date("Y-m-d",strtotime('+1 months',strtotime($userValue['share_date_time'])));
        }
        if( $linkMode ){
            $link  = "{$screenType}_{$userValue['user_id']}_{$currentStartDate}_{$currentEndDate}";
            $linkEcrypt = url('share/share-to-friend/')."/".base64_encode($link);
            $head = ucfirst(str_replace("-"," ",$screenType));
            $bodyLink   =  "{$userValue['name']}'s {$head} Link \n {$linkEcrypt} ";
            $bodyData[$screenType] = ['body' =>  $bodyLink ];
            $html = "<p><a href='{$linkEcrypt}'>{$linkEcrypt}</a></p>";
            $bodyHtml[$screenType] = ['body' => $html,'title' => "<h4>{$userValue['name']}'s {$head} Link</h4>" ];
        }

        if( $userValue['frequency'] != 'Daily' ){

            if( !empty($obj) ){
                $msgHead = "{$currentStartDate} to {$currentEndDate}";
                $result = $obj::where('user_id',$userValue['user_id'])->
                        whereBetween('created_at',[$currentStartDate,$currentEndDate])->get();
                if( $result ){
                    $mood    = "{$userValue['name']}'s Mood History - {$msgHead} \n";
                    $journal = "{$userValue['name']}'s Journal History - {$msgHead} \n";
                    $safty   = "{$userValue['name']}'s Safty Plan - {$msgHead} \n";
                    foreach($result as $key => $value){
                        if( $screenType == 'my-mood' ){
                            $date  = date('Y-m-d',strtotime($value['created_at']));
                            $mood .= "Mood : {$value['text']} \n";
                            $mood .= "Date : {$date} \n";
                            $mood .= "\n";
                            $bodyData[$screenType] = ["body" => $mood ];
                            $moodHtml .= "<p>Mood : {$value['text']}</p>";
                            $moodHtml .= "<p>Date : {$date}</p>";
                            $bodyHtml[$screenType] = ['body' => $moodHtml,'title' => "
                                        <h4>{$userValue['name']}'s Mood History - {$msgHead}</h4>" ];

                        }
                        if( $screenType == 'my-journal' ){
                            $journal .= "Title : {$value['title']} \n";
                            $journal .= "Description : {$value['description']} \n";
                            $journal .= "\n";
                            $bodyData[$screenType] = ["body" => $journal ];
                            $htmlJournal .= "<p>Title : {$value['title']}</p>";
                            $htmlJournal .= "<p>Description : {$value['description']}</p>";
                            $bodyHtml[$screenType] = ['body' => $htmlJournal,'title' => "
                                        <h4>{$userValue['name']}'s Journal History - {$msgHead}</h4>" ];

                        }
                        if( $screenType == 'my-safty' ){
                            $safty .= "Title : {$value['safty_title']} \n";
                            $safty .= "Plan : {$value['plan_data']} \n";
                            $safty .= "\n";
                            $bodyData[$screenType] = ["body" => $safty ];
                            $htmlSafty .= "<p>Title : {$value['safty_title']}</p>";
                            $htmlSafty .= "<p>Plan : {$value['plan_data']}</p>";
                            $bodyHtml[$screenType] = ['body' => $htmlSafty,'title' => "
                                        <h4>{$userValue['name']}'s Safety History - {$msgHead}</h4>" ];


                        }
                    }
                }

            }

            if( !empty($bodyData) ){
                foreach($bodyData as $key => $value){
                    if( !empty($value['body']) ){
                        if( $value['body'] ){
                            $this->sendMsg($userValue['phone'],$value['body']);
                        }
                        if( isset($bodyHtml[$key]) ){
                            $this->sendMail($userValue['email'],$bodyHtml[$key]);
                        }
                    }
                }
            }
        }
        SendToFriendList::where('id',$userValue['id'])->update(['share_date_time' => $updateDate]);
    }

    function shareToMoodScreen($encrypt){
        try{
            $decryptString = base64_decode($encrypt);
            $data = explode('_',$decryptString);
            if( $data[0] == 'screen-history' ){
                return $this->screen_history_data($data);
            }elseif( $data[0] == 'mood-history' ){
                return $this->mood_history($data);
            }

        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    function screen_history_data($data){
        $name = User::where('id',$data[1])->pluck('name')[0];
        $startDate = date('Y-m-d',strtotime($data['2']));
        $endDate   = date('Y-m-d',strtotime($data['3']));

        if( $startDate == $endDate ){
            $startDate = date('Y-m-d 00:00:00',strtotime($startDate));
            $endDate = date('Y-m-d 24:00:00',strtotime($endDate));
        }

        $screenHead = graphDataBydate($startDate,$endDate);
        $userAnswer  = visitor::where('user_id',$data[1])
                    ->whereBetween('created_at',[$startDate,$endDate])
                    ->whereHas('quizAnswer', function($query) use($startDate,$endDate) {
                        $query->whereBetween('created_at',[$startDate,$endDate]);
                    })->orderBy('id','asc')->get()->toArray();
        $quizChartJs = $quizDataBind = $dataByTitle = $screeningData = $screening = $color =  [];

        if( $userAnswer ){
            $i = 0;
            foreach($userAnswer as $key => $value){
                if($value['quiz_answer']){
                    $sum = 0;
                    foreach( $value['quiz_answer'] as $quizKey => $quizValue ){
                        $sum += $quizValue['value'];
                        $screening[$value['test_type']][$i]['x'] = date('d M',strtotime($quizValue['created_at']));
                        $screening[$value['test_type']][$i]['y'] = $sum;
                        $color[$value['test_type']] = rand_color();

                    }
                $i++;
                }
            }
        }

        if( $screening ){
            foreach($screening as $key => $value){
                foreach($value as $childKey => $childValue){
                    $max = $min = $entry = $title = "";
                    if( $key == 'anxiety' ){
                        $keyName = "GAD - 7 Anxiety Severity";
                        if( $childValue['y'] >= 0 && $childValue['y'] < 5 ){
                            $entry = 'Minimal Anxiety 0 - 4';
                            $newKey = 3;
                            $quizChartJs[$key][$childValue['x']] = 0.5;
                        }elseif( $childValue['y'] > 4 && $childValue['y'] < 10 ){
                            $entry = 'Mild Anxiety 5 - 9';
                            $newKey = 2;
                            $quizChartJs[$key][$childValue['x']] = 1.5;
                        }elseif( $childValue['y'] > 9 && $childValue['y'] < 15 ){
                            $entry = 'Moderate Anxiety 10 - 14';
                            $newKey = 1;
                            $quizChartJs[$key][$childValue['x']] = 2.5;
                        }elseif( $childValue['y'] > 14 ){
                            $entry = 'Severe Anxiety Greater than 14';
                            $newKey = 0;
                            $quizChartJs[$key][$childValue['x']] = 3.5;
                        }

                    }elseif( $key == 'depression' ){
                        $keyName = "PHQ - 9 Depression Severity";

                         if( $childValue['y'] >= 0 && $childValue['y'] < 6 ){
                            $entry = 'Minimal Depression 0 - 5';
                            $newKey = 3;
                            $quizChartJs[$key][$childValue['x']] = 0.5;
                        }elseif( $childValue['y'] > 5 && $childValue['y'] < 11 ){
                            $entry = 'Moderate Depression 6 - 10';
                            $newKey = 2;
                            $quizChartJs[$key][$childValue['x']] = 1.5;
                        }elseif( $childValue['y'] > 10 && $childValue['y'] < 16 ){
                            $entry = 'Moderately Severe Depression 11 - 15';
                            $newKey = 1;
                            $quizChartJs[$key][$childValue['x']] = 2.5;
                        }elseif( $childValue['y'] > 15 ){
                            $entry = 'Severe Depression Greater than 16';
                            $newKey = 0;
                            $quizChartJs[$key][$childValue['x']] = 3.5;
                        }

                    }elseif( $key == 'abuse' ){
                        $keyName = "UNCOPE";
                        if( $childValue['y'] >= 0 && $childValue['y'] < 2 ){
                            $entry = 'No Risk and Possible Dependence indicated';
                            $newKey = 1;
                            $quizChartJs[$key][$childValue['x']] = 0.5;
                        }else{
                            $entry = 'Risk and Possible Dependence indicated';
                            $newKey = 0;
                            $quizChartJs[$key][$childValue['x']] = 1.5;
                        }
                    }
                    $quizDataBind[$keyName]['date'][] = $childValue['x'];
                    $quizDataBind[$keyName]['quizResult'][$newKey][$entry][$childValue['x']] = $childValue;
                }
            }
        }

        $headSetByName = ['GAD - 7 Anxiety Severity','PHQ - 9 Depression Severity','UNCOPE'];

        $dataByTitle = [];
        foreach($quizDataBind as $firstKey => $firstValue){
            $dataByTitle[$firstKey]['date'] = $firstValue['date'];
            for($i = 0;$i < count($firstValue['quizResult']);$i++ ){
                if( isset($firstValue['quizResult'][$i]) ){
                    $dataByTitle[$firstKey]['quizResult'][$i] = $firstValue['quizResult'][$i];
                }
            }
        }
        $screeningData = json_encode($quizChartJs);
        $color = json_encode($color);
		return view("SharingPreference::screen-history",
                compact(["screeningData","color","screening","screenHead","dataByTitle","headSetByName","name"]));
    }

    function mood_history($data){
        $name = User::where('id',$data[1])->pluck('name')[0];
        $userMood = UserMood::where('user_id',$data['1'])->whereBetween('created_at',[$data[2],$data[3]])->orderBy('created_at','asc')->get()->toArray();
        $data = [];
        if( $userMood ){
            foreach($userMood as $key => $value){
                $data['label'][] = date('d M y',strtotime($value['created_at']));
                $data['data'][] = $value['mood_number'];
                $data['backgroundColor'][] = randomColor($value['mood_number']);
                $data['borderColor'][] = randomColor($value['mood_number']);
                $data['labelText'][] = str_replace(':','',$value['mood']);
            }
        }
        $chartData = json_encode($data);
        return view('SharingPreference::mood-history',compact('chartData','name'));
    }


}
