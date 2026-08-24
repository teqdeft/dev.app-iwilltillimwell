<?php

namespace Modules\HealthRecord\Controllers;

use App\Http\Controllers\ConsultationController;
use File;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Document;
use App\Models\UserMeta;
use App\Models\Medication;
use App\Models\UserDetails;
use App\Models\SurgicalHistory;
use Illuminate\Http\Request;
use App\Models\MedicalCondition;
use App\Models\MedicationAllergy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

use Session;
use Modules\HealthRecord\Validators\MedicalValidator;
use Modules\HealthRecord\Validators\MedicationValidator;
use Modules\HealthRecord\Validators\MedicationAllergyValidator;


class HealthRecordController extends Controller
{

    public function personalRecord(Request $request, User $user)
	{
		try {
			
			$user = (!$user->id) ? Auth::user() : $user;

			$user_details = $user->user_details;
			$dependents = Auth::user()->dependents;
			$dependents = $dependents->merge(Auth::user()->parent_dependents);

            if(ismobile()){

                $inComplete = [];
                $existOrNot = UserMeta::checkMedication();
                if( !$existOrNot ){
                    $inComplete = Medication::inComplete();
                }

                $inCompleteMAll = [];
                $existOrNotAAll = UserMeta::MedicationAllergy();
                if( !$existOrNotAAll ){
                    $inCompleteMAll = MedicationAllergy::inComplete();
                }
                $allergies = $user->user_allergies;
                $dependents = Auth::user()->dependents; 
                $dependents = $dependents->merge(Auth::user()->parent_dependents);
                $medicalConditions = $user->user_medical_condition;
                $documents = Document::where('userid', $user->userid)->orderBy('id', 'DESC')->get();
                $medications = $user->user_medications;
                $surgical_history = $user->surgical_history;
				
				
                return view('HealthRecord::mobile.personal-record', compact(['user_details', 'user', 'dependents','inComplete','existOrNot','inCompleteMAll','existOrNotAAll','allergies','medicalConditions','documents','medications','surgical_history']));
            }

			return view('HealthRecord::personal-record', compact(['user_details', 'user', 'dependents']));
		} catch (\Exception $e) {
			return redirect('dashboard')->with('error', $e->getMessage());
		}
	}

    public function personalPopup(User $user)
	{
		$user_details = $user->user_details;
		$html = View::make('HealthRecord::personal-record-popup', compact(['user_details', 'user']))->render();
		return response()->json(['data' => $html]);
		// $this->load->view('health-records/personal-record', compact(['user_details']));
	}

    public function updatePersonalInfo(Request $request, User $user)
    {
        
        try {
            $input = $request->all();
            $input = request()->except(['_token']);
            
            // tele medicine data
            $tele_data = array(
                "heightFeet" => isset($input['heightFeet']) ? trim($input['heightFeet']) : "",
                "heightInches" => isset($input['heightInches']) ? trim($input['heightInches']) : "",
                "smokingHabits" => isset($input['smokingHabits']) ? trim($input['smokingHabits']) : "",
                "bloodType" => isset($input['bloodType']) ? trim($input['bloodType']) : "",
                "bloodPressureSystolic" => isset($input['bloodPressureSystolic']) ? trim($input['bloodPressureSystolic']) : "",
                "bloodPressureDiastolic" => isset($input['bloodPressureDiastolic']) ? trim($input['bloodPressureDiastolic']) : "",
                "maritalStatus" => isset($input['maritalStatus']) ? trim($input['maritalStatus']) : "",
                "drinkingHabits" => isset($input['drinkingHabits']) ? trim($input['drinkingHabits']) : "",
                "exerciseHabits" => isset($input['exerciseHabits']) ? trim($input['exerciseHabits']) : "",
                "exerciseLength" => isset($input['exerciseLength']) ? trim($input['exerciseLength']) : "",
                "weight" => isset($input['weight']) ? trim($input['weight']) : "",
            );
             //dd($request->user());
            $param =  array('email' => "test322@yopmail.com", 'password' =>"Password@123");
            //$exe = $this->setMemberSession($request->user());
            $post_url = Config::get('constants.tel_api_url') . 'personal/update/' . $user->userid;
           
			
		   $response = $this->postToteleMedicine($tele_data, $post_url);
            if ($response['success']) {
                $input['user_id'] = $user->id;
                $model = UserDetails::updateOrCreate(['user_id' => $input['user_id']], $input);
                if($model->save()){
                    if( Auth::user()->doctor_step == 0 ){
                        User::where('id', $input['user_id'])->update(['doctor_step' => 1]);
                    }
                }
                if(ismobile()){
                    return ['success' => true,'message' =>'Personal health information has been updated successfully.'];
               } 
                $request->session()->flash('success', 'Personal health information has been updated successfully.');
            } else {
                if(ismobile()){
                     return ['success' => false,'message' =>$response['message']];
                } 
                return redirect()->back()->with('error', $response['message']);
            }
        } catch (\Exception $e) {
            if(ismobile()){
                return ['success' => false,'message' =>$e->getMessage()];
             }
            $request->session()->flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function medications(Request $request, User $user)
	{
		
		if(ismobile()){
			return redirect('personal-record?active-tab=tab2');	
		}
		//$user = (!$user->id) ? Auth::user() : $user;
		
		$user = $request->query('user_id') 
            ? User::find($request->query('user_id')) 
            : Auth::user();
			

        $inComplete = [];
        $existOrNot = UserMeta::checkMedication();
        if( !$existOrNot ){
            $inComplete = Medication::inComplete();
        }
		$medications = $user->user_medications;
		$dependents = Auth::user()->dependents;
		$dependents = $dependents->merge(Auth::user()->parent_dependents);
		return view('HealthRecord::medications', compact(['medications', 'dependents', 'user','inComplete','existOrNot']));
	}

    public function searchMedication(Request $request)
    {
        $input = $request->all();

        $post_url = Config::get('constants.tel_api_url') . 'medication/search?query=' . $input['keyword'];
        $this->setMemberSession($request->user());
        $response = $this->postToteleMedicine($input, $post_url, false);
        if ($response['success']) {
            $data = [];
            if( count($response['suggestions']) ){
                foreach($response['suggestions'] as $value){
                    $data[] = $value + ['id' => $value['data'], 'text' => $value['value'] ];
                }
            }else{
                $data[] = [
                    'data' => 0,
                    'ndc' => 0,
                    'value' => $input['keyword'],
                    'id'    => rand(100,9999999),
                    'text' => $input['keyword'],
                ];
            }
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['data' => $response]);
        }
    }

    public function medicationAllergies(Request $request, User $user)
	{
 
		if(ismobile()){
			return redirect('personal-record?active-tab=tab3');	
		}
		
        //$user = (!$user->id) ? Auth::user() : $user;
		
		$user = $request->query('user_id') 
            ? User::find($request->query('user_id')) 
            : Auth::user();
			
			
        $inComplete = [];
        $existOrNot = UserMeta::MedicationAllergy();
        if( !$existOrNot ){
            $inComplete = MedicationAllergy::inComplete();
        }
		$allergies = $user->user_allergies;
		$dependents = Auth::user()->dependents;
		$dependents = $dependents->merge(Auth::user()->parent_dependents);
		return view('HealthRecord::medication-allergies', compact(['allergies', 'dependents', 'user','existOrNot','inComplete']));
	}

    public function storeMedication(Request $request, User $user)
    {
        try {
            $input = $request->all();
            $medicationValidator = new MedicationValidator();
            if (!$medicationValidator->with($input)->passes()) {
                if(ismobile()){
                    return ['success' => false,'message' =>$medicationValidator->getErrors()[0]];
                 }
                return redirect()->back()->with('error', $medicationValidator->getErrors()[0]);
            }
            //Medication::deleteInComplete();
            $data = ['userId' => $user->id,'name' => $input['medicationName'],'frequency' => $input['medicationFrequency'],
            'comment' => $input['medicationComment'],'currentlyUse' => $input['medicationCurrentUse'],
            'foreignId' => $input['medicationForeignId'],'ndc' => $input['medicationNDC'] ];
            $model = Medication::insert($data);
            UserMeta::deleteMedication();
            if($model){
                if( Auth::user()->doctor_step == 1 ){
                    User::where('id', $user->id)->update(['doctor_step' => 2]);
                }
            }

            /* $this->setMemberSession($user);
            $post_url = Config::get('constants.tel_api_url') . 'medication/add/' . $user->userid;
            $response = $this->postToteleMedicine($input, $post_url); */

            /* if (isset($response['success'])) { */

            //'medicationId => $response['medicationId'];

            //activityLog("Find {$model->name}",$model,'medications');

           

            if(ismobile()){
                return ['success' => true,'message' =>'Medication saved successfully'];
             }
             $request->session()->flash('success', 'Medication saved successfully');
            if( isset($input['redirect']) && !empty($input['redirect']) ){
                return redirect($input['redirect']);
            }
            return redirect()->back();
            /* } else {
                return redirect()->back()->with('error', $response['message']);
            } */
        } catch (\Exception $e) {

            if(ismobile()){
                return ['success' => false,'message' =>$e->getMessage()];
             }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function NottakeMedication(Request $request,User $user)
    {
        try {
			
			
            $redirect = "";
            $input = $request->all();
            if( $input['take_medication'] == 'no'  ){
                if( $input['segment'] == 'medications' ){
                    Medication::deleteInComplete();
                }elseif( $input['segment'] == 'medication-allergies' ){
                    MedicationAllergy::deleteInComplete();
                }elseif( $input['segment'] == 'medical-history' ){
                    $this->addDataInApi();
                }
            }
            if( Auth::user()->doctor_step == 1  && $input['segment'] == 'medications' ){
                User::where('id', $user->id)->update(['doctor_step' => 2]);
                $redirect = 'medication-allergies';
            }elseif( Auth::user()->doctor_step == 2 && $input['segment'] == 'medication-allergies' ){
                User::where('id', $user->id)->update(['doctor_step' => 3]);
                $redirect = 'medical-history';
            }elseif( Auth::user()->doctor_step == 3 && $input['segment'] == 'medical-history' ){
                User::where('id', $user->id)->update(['doctor_step' => 4]);
                $redirect = 'document-manager';

            }else if( Auth::user()->doctor_step == 4 && $input['segment'] == 'document-manager' ){
                User::where('id', $user->id)->update(['doctor_step' => 5]);
                $redirect = 'document-manager';

            }

            if($input['segment'] == 'document-manager' ){
                User::where('id', $user->id)->update(['doctor_step' => 5]);
                $redirect = 'document-manager';

            }
            UserMeta::create(['user_id' => Auth::user()->id,'meta_key' => $input['segment'],'meta_value' => 0,'prefix' => 'iwilltilimwell' ]);
            if( isset($input['segment']) && !empty($input['segment']) ){
                switch($input['segment']){
                    case 'medications':
                        if(ismobile()){
                            return ['success' => true,'message' =>"Medication saved successfully","redirect"=>'medication-allergies'];
                         }
                        return redirect('medication-allergies');
                    break;
                    case 'medication-allergies':
                        if(ismobile()){
                            return ['success' => true,'message' =>"Medication allergies saved successfully","redirect"=>'medication-history'];
                         }
                        return redirect('medical-history');
                    break;
                    case 'medical-history':
                        if(ismobile()){
                            return ['success' => true,'message' =>"Medication saved successfully","redirect"=>'document-manager'];
                         }
                        return redirect('document-manager');
                    break;
                    case 'document-manager':
					
						$request->session()->flash('success', 'Health records updated successfully.');
                        
                        if(ismobile()){
                           
                            return redirect()->route('mobile-dashboard');
                         }
            
                        return redirect('dashboard');
                    break;
                }

                if(ismobile()){
                    return ['success' => true,'message' =>"success","redirect"=>$redirect];
                 }
                 
                return redirect($redirect);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            if(ismobile()){
                return ['success' => false,'message' =>$e->getMessage()];
             }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function medicationInactive(Request $request)
    {
        try {
            $input = $request->all();
            $idType = str_contains($input['medicationId'],'___');
            if( !$idType ){
                $medication = $input['medicationId'];
                $userid = User::where('id',$input['uId'])->pluck('userid');
                $userid = $userid[0]??'';
                // set to medication inactive
                $post_url = Config::get('constants.tel_api_url') . 'medication/currentuse/' . $medication . '/' . $userid . '/0';
                $response = $this->postToteleMedicine($input, $post_url, false);
                if ($response['success']) {
                    $models = Medication::where('medicationId', $medication);
                }
            }else{
                $models = Medication::where('id', str_replace("___","",$input['medicationId']));
            }
            $models->update(['currentlyUse' => 'false']);
            $request->session()->flash('success', 'Medication updated successfully');
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
        }
    }

    public function storeMedicationAllergy(Request $request, User $user, MedicationAllergyValidator $medicationAllergyValidator)
    {
        try {
            $input = $request->all();
			
            /* if (!$medicationAllergyValidator->with($input)->passes()) {

                if(ismobile()){
                    return ['success' => false,'message' =>$medicationAllergyValidator->getErrors()[0]];
                 }

                return redirect()->back()->with('error', $medicationAllergyValidator->getErrors()[0]);
            } */

            //MedicationAllergy::deleteInComplete();
            $data = [ 'userId'  => $user->id,'addedAllergyId' => 0,'name' => $input['medicationAllergyName'],
                      'foreignId'  => $input['medicationAllergyForeignId'],'damConceptId' => $input['medicationAllergyDamConceptId'],
                     'damConceptIdType' => $input['medicationAllergyDamConceptIdType']];
            $model = MedicationAllergy::insert($data);
            UserMeta::MedicationAllergy();
            if($model){
                if( Auth::user()->doctor_step == 2 ){
                        User::where('id', $user->id)->update(['doctor_step' => 3]);
                }
            }

           /*  $post_url = Config::get('constants.tel_api_url') . 'medicationAllergies/add/' . $user->userid;
            $this->setMemberSession($user);
            $response = $this->postToteleMedicine($input, $post_url); */

            //activityLog("Find {$model->name}",$model,'medicationAllergy');
            if(ismobile()){
                return ['success' => true,'message' =>'Medication allergy saved successfully'];
             }

            $request->session()->flash('success', 'Medication allergy saved successfully');
            if( isset($input['redirect']) && !empty($input['redirect']) ){
                return redirect($input['redirect']);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function searchMedicationAllergy(Request $request)
    {
        $input = $request->all();

        $post_url = Config::get('constants.tel_api_url') . 'medicationAllergies/search?query=' . $input['keyword'];
        $this->setMemberSession($request->user());
        $response = $this->postToteleMedicine($input, $post_url, false);

        if ($response['success']) {
            $data = [];
            if( count($response['suggestions']) ){
                foreach($response['suggestions'] as $value){
                    $data[] = $value + ['id' => $value['medicationAllergyForeignId'], 'text' => $value['value'] ];
                }
            }else{
                $data[] = [
                    "damConceptId" => 0,
                    "damConceptIdType" => 0,
                    "medicationAllergyForeignId" => 0,
                    "medicationAllergyName"=> $input['keyword'],
                    "text" => $input['keyword'],
                    "id" => rand(100,99999999),
                ];
            }
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['data' => $response]);
        }
    }

    public function medicationAllergyInactive(Request $request)
    {
        try {
            $input = $request->all();
            $idType = str_contains($input['allergyId'],'___');
            if( !$idType ){
                $allergyData = MedicationAllergy::where('addedAllergyId',$input['allergyId']);
                $allergyFirst = $allergyData->first();
                $user = User::find(Auth::user()->id);
                // set to medication inactive
                $this->setMemberSession($user);
                $post_url = Config::get('constants.tel_api_url') . 'medicationAllergies/markInactive/' . $allergyFirst->addedAllergyId . '/' . $allergyFirst->foreignId . '/' . $user->userid;
                $response = $this->postToteleMedicine($input, $post_url, false);
                $allergyData->update(['deleted_at' => Carbon::now()]);
            }else{
                $allergyData = MedicationAllergy::where('id',str_replace("___","",$input['allergyId']))
                ->update(['deleted_at' => Carbon::now()]);
            }
            $request->session()->flash('success', 'Medication allergy updated successfully');
        } catch (\Exception $e) {
            //dd($e->getMessage());
            $request->session()->flash('error', $e->getMessage());
        }
    }

    public function medicationAllergiesDelete(Request $request){
        MedicationAllergy::where('id',$request->input('id'))->delete();
        $request->session()->flash('success', 'Medication Allergy successfully Deleted');
    }
	
    public function medicationDetailsDelete(Request $request){
        Medication::where('id',$request->input('id'))->delete();
        $request->session()->flash('success', 'Medication Allergy successfully Deleted');
    }

    public function storeMedicalCondition(Request $request, User $user )
    {
        try {
			$success="";
			$error_msg="";
            $inputData = $request->all();
            $medicalValidator = new MedicalValidator();
            if( !empty($inputData) ){
                foreach($inputData['medical'] as $key => $input ){
                        if( empty($input['medicalConditionName']) || empty($input['medicalConditionDescription']) || empty($input['medicalConditionStatus']) ){
                            
                            if(ismobile()){
                                return ['success' => false,'message' =>'Required all fields'];
                             }

                            return redirect()->back()->with('error','Required all fields');
                        }
                        $model = new MedicalCondition;
                        $post_url = Config::get('constants.tel_api_url') . 'medicalCondition/add/' . $user->userid;
                        $response = $this->postToteleMedicine($input, $post_url);
                        if ($response['success']) {
                            $model->name = $input['medicalConditionName'];
                            $model->description = $input['medicalConditionDescription'];
                            $model->status = $input['medicalConditionStatus'];
                            $model->userId = $user->id;
                            $model->medicalConditionId = $response['medicalConditionId'];
                            activityLog("Find {$model->name}",$model,'medical-history');


                            if($model->save()){
                                UserMeta::consentUpdate(['meta_key' => 'medical_process','meta_value' => 1]);
                                if( Auth::user()->doctor_step == 3 ){
                                    User::where('id', $user->id)->update(['doctor_step' => 4]);
                                }
                            }
                            $success = 'Medical condition saved successfully';
                            $this->addDataInApi();
                        }else{
							$error_msg = $response['message'];
							
                            $error[] = 'Medical condition saved successfully';
                        }
                }

                if( $success ){

                    if(ismobile()){
                        return ['success' => true,'message' =>'Medical condition saved successfully'];
                     }

                    /* if ( personalSettingComplete() ){
                        return redirect()->back()->with('success','Medical condition saved successfully');
                    }else{
                    } */
                        $request->session()->flash('success','Medical condition saved successfully');
                        return redirect()->back();
                }
				
				return redirect()->back()->with('error', $error_msg);
            }
        } catch (\Exception $e) {
            if(ismobile()){
                return ['success' => false,'message' =>$e->getMessage()];
             }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function addDataInApi(){

        /* Medication */
        //$this->setMemberSession($user);
        $user = User::find(Auth::user()->id);
        try {
            $medicationData = Medication::where('complete',0)->orderBy('id','desc')->first();
            $updateMedicalData = [];
            if( $medicationData ){
                if( $medicationData->foreignId > 0 && $medicationData->ndc > 0 ){
                    $medicationInputs = [
                                'medicationName' => $medicationData->name,
                                'medicationFrequency' => $medicationData->frequency,
                                'medicationComment' => $medicationData->comment,
                                'medicationCurrentUse' => $medicationData->currentlyUse,
                                'medicationForeignId' => $medicationData->foreignId,
                                'medicationNDC'  => $medicationData->ndc,
                    ];
                    $medication_url = Config::get('constants.tel_api_url') . 'medication/add/' . $user->userid;
                    $responseMedication = $this->postToteleMedicine($medicationInputs, $medication_url);
                    if( $responseMedication['success'] ){
                        $updateMedicalData = ['medicationId' => $responseMedication['medicationId'] ];
                    }
                }
                $updateMedicalData = array_merge($updateMedicalData,['complete' => 1]);
                Medication::where('id',$medicationData->id)->update($updateMedicalData);
            }
            /*  medical allergies  */
            $medicationAllergy = MedicationAllergy::where('complete',0)->orderBy('id','desc')->first();
            $updateAllergyData = [];
            if( $medicationAllergy ){
                if( $medicationAllergy->foreignId > 0 && $medicationAllergy->damConceptId > 0 ){
                    $medicationAllergyInputs = [
                                'medicationAllergyName' => $medicationAllergy->name,
                                'medicationAllergyForeignId' => $medicationAllergy->foreignId,
                                'medicationAllergyDamConceptId' => $medicationAllergy->damConceptId,
                                'medicationAllergyDamConceptIdType' => $medicationAllergy->damConceptIdType ];
                    $allergies_url = Config::get('constants.tel_api_url') . 'medicationAllergies/add/' . $user->userid;
                    $responseAllergies = $this->postToteleMedicine($medicationAllergyInputs, $allergies_url);
                    if ($responseAllergies['success']) {
                        $updateAllergyData = ['addedAllergyId' => $responseAllergies['addedAllergyId'] ];
                    }
                }
                $updateAllergyData = array_merge($updateAllergyData,['complete' => 1]);
                MedicationAllergy::where('id',$medicationAllergy->id)->update($updateAllergyData);
            }
        }catch (\Exception $e) {
            return dd($e->getMessage());
        }
    }



    public function medicalHistoryPopup($condition)
	{

		$condition = MedicalCondition::where('medicalConditionId', $condition)->first();

		$html = View::make('HealthRecord::medical-history-popup', compact(['condition']))->render();
		return response()->json(['data' => $html]);
		// $this->load->view('health-records/personal-record', compact(['user_details']));
	}

    public function medicalHistoryUpdate(Request $request, $medicalConditionId )
    {
        try {
            $input = request()->except(['_token']);
            $medicalValidator = new MedicalValidator();
            if (!$medicalValidator->with($input)->passes()) {
                return redirect()->back()->with('error', $medicationValidator->getErrors()[0]);
            }

            $conditionData = MedicalCondition::where('medicalConditionId', $medicalConditionId);
            $conditionFirst = $conditionData->first();

            // set to medication inactive
            $post_url = Config::get('constants.tel_api_url') . 'medicalCondition/update/' . $conditionFirst->medicalConditionId . '/' . $conditionFirst->medical_condition_user->userid;
            $response = $this->postToteleMedicine($input, $post_url, true);
            if ($response['success']) {

                $data['name'] = $input['medicalConditionName'];
                $data['description'] = $input['medicalConditionDescription'];
                $data['status'] = $input['medicalConditionStatus'];
                $conditionData->update($data);
                return redirect()->back()->with('success', 'Medical history updated successfully');
            } else {
                return redirect()->back()->with('error', $response['message']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function medicalHistoryInactive(Request $request, $medicalConditionId, User $user)
    {
        try {
            $input = $request->all();
            $medicalData = MedicalCondition::where('medicalConditionId', $medicalConditionId);
            $medicalFirst = $medicalData->first();

            // set to medication inactive
            $this->setMemberSession($user);
            $post_url = Config::get('constants.tel_api_url') . 'medicalCondition/delete/' . $medicalFirst->medicalConditionId . '/' . $user->userid;
            $response = $this->postToteleMedicine($input, $post_url, false);
            if ($response['success']) {
                $medicalData->update(['deleted_at' => Carbon::now()]);
                return redirect()->back()->with('success', 'Medical history updated successfully');
            } else {
                return redirect()->back()->with('error', $response['message']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function medicalHistory(Request $request, User $user)
	{
		if(ismobile()){
			return redirect('personal-record?active-tab=tab4');	
		}
		
		
		$user = $request->query('user_id') 
            ? User::find($request->query('user_id')) 
            : Auth::user();
			
			
        $inComplete = [];
        $existOrNot = UserMeta::medicalHistory();
        if( !$existOrNot ){
            //$inComplete = MedicationAllergy::inComplete();
        }
		$medicalConditions = $user->user_medical_condition;
		$dependents = Auth::user()->dependents;
		$dependents = $dependents->merge(Auth::user()->parent_dependents);

		return view('HealthRecord::medical-history', compact(['medicalConditions', 'dependents', 'user','existOrNot','inComplete']));
	}

    public function documentManager(Request $request, User $user)
	{
		if(ismobile()){
			return redirect('personal-record?active-tab=tab6');	
		}
		//$user = (!$user->id) ? Auth::user() : $user;
		
		$user = $request->query('user_id') 
            ? User::find($request->query('user_id')) 
            : Auth::user();
			
			
		$documents = Document::where('userid', $user->userid)->orderBy('id', 'DESC')->get();
		$dependents = Auth::user()->dependents;
		$dependents = $dependents->merge(Auth::user()->parent_dependents);

        $inComplete = [];
        $existOrNot = UserMeta::checkDocument();
        if( !$existOrNot ){
            $inComplete = Medication::inComplete();
        }

		return view('HealthRecord::document-manager', compact(['dependents', 'user', 'documents','existOrNot','inComplete']))->with('no', 1);
	}

    public function uploadDocument(Request $request, User $user)
	{
       
		try {

			$user = (!$user->id) ? Auth::user() : $user;
			if ($files = $request->file('file')) {
				$post_url = Config::get('constants.tel_api_url') . 'attachment/add/' . $user->userid;
				$dir = public_path("uploads/documents/");
				
				$extension = $files->getClientOriginalExtension();
				
				//$name = $files->getClientOriginalName();
				$name = pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME);
				$name = $name . '_' . time() . '_' . uniqid() . '.' . $extension;
				  
				$file = $files->move($dir, $name);
				$filePath = $dir . $name;
				if (function_exists('curl_file_create')) {
					//Use the recommended way, creating a CURLFile object.
					$filePath = curl_file_create($filePath);
				}
				$tele_data = array(
					"AttachmentFile" => $filePath
				);
				$response = $this->postToteleMedicine($tele_data, $post_url);
				if ($response['success']) {
					$model = new Document;
					$model->name = $name;
					$model->userid = $user->userid;
					$model->save();
					 User::where('id', $user->id)->update(['doctor_step' => 5]);
                    /* if( Auth::user()->doctor_step == 4 ){
                       
                    } */
                     $request->session()->flash('health-document-save', '');
					 
					if($request->input('save_attachement') == 'save') {
						
						/* return response()->json([
								'status' => 'success',
								'message' => 'Document uploaded successfully.'
							]); */
	
						return redirect()->back()->with('success', 'Document uploaded successfully.'); 
						
					} 
					
                     return redirect()->route('mobile-dashboard')->with('success', 'Document uploaded successfully.');


				} else {
					return redirect()->back()->with('error', $response['message']);
				}
			} else {
                return redirect()->back()->with('error', "File Required");
            }
		} catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

    public function deleteDocument(Request $request, Document $document)
	{
		try {
			$document->delete();
			$destinationPath = public_path("uploads/documents/");
			File::delete($destinationPath . $document->name);
			
			return response()->json([
								'status' => 'true',
								'message' => 'Document uploaded successfully.'
							]);
							
			//return redirect()->back()->with('success', 'Document deleted successfully');
		} catch (\Exception $e) {
			
			return response()->json([
								'status' => 'false',
								'message' => $e->getMessage()
							]);
							
			//return redirect()->back()->with('error', $e->getMessage());
		}
	}

    public function setMemberSession($params)
    {
        if ($params->email && $params->password) {
            $credentials = array('email' => $params->email, 'password' => base64_decode($params->user_password));
            $response = curlRequest(Config::get('constants.tel_login_url'), $credentials, true, [], true);
            $data = explode("\n", $response);
            if( isset($data[12]) ){
                if (strpos($data[12], 'Bearer') !== false) {
                    Session::put('member_auth', $data[12]);
                    return ['success' => 'true', 'data' => $data[12]];
                }
            }
            return end($data);
        }
    }

    public function postToteleMedicine($data, $post_url, $postMethod = true, $isadmin = false)
    {
        if ($isadmin) {
            $token = str_replace(array("\r\n", "\n", "\r"), '', Session::get('authorization'));
            $headers = array($token);
        } else {
            $token = str_replace(array("\r\n", "\n", "\r"), '', Session::get('member_auth'));
            $headers = array($token);
        }
        //print_r($headers)
        //die();
        if ($postMethod) {
            $response = curlRequest($post_url, $data, true, $headers);
        } else {
            $response = curlRequest($post_url, [], false, $headers);
        }
        $result = json_decode($response, 1);
        return $result;
    
    }

    public function memberAuthTokenUpdate() {

     echo "///////////////////";
        if(Auth::user()->payment_status==1) {
           
            if(empty(Session::get('member_auth'))) {
                $result = (new ConsultationController)->validateEmail(Auth::user()->email);
                if(empty($result['success'])) {
                    return $result;
                }
                $reg_res = (new ConsultationController)->storeGeneralInfo(Auth::user());
                if((isset($reg_res['detail']['userid'])) || (isset($reg_res['success']) && $reg_res['success']==1)) {
                    $response = (new ConsultationController())->setMemberSession(Auth::user());
                }   else {
                    return ["success"=>"","message"=>"Invalid Request.Please contact To Admin "];
                } 
            }
            return ["success"=>true,"message"=>"Valid","Token"=>""];
        }
        return ["success"=>false,"message"=>"Please paid memer First","Token"=>""];
    }
	
	public function saveSurgicalData(Request $request) {
		
		
		try {
			
			$SurgicalHistory  = new SurgicalHistory;
			$SurgicalHistory->user_id  = $request->surgical_uid;
			$SurgicalHistory->name  = $request->procedure_name;
			$SurgicalHistory->procedure_date  = $request->procedure_date;
			$SurgicalHistory->description  = $request->description;
			$SurgicalHistory->save();
			
			
			if(ismobile()){
				return response()->json(['success' => true, 'message' =>"Successfully added"], 200);
			} else {
				$request->session()->flash('success','Surgical Condition saved successfully');
                return redirect()->back();
			}
			
			
		} catch (\Exception $e) {
			
			if(ismobile()){
				return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
			} else {
				$request->session()->flash('error',$e->getMessage());
                return redirect()->back();
			}
		} 
	}
	public function surgicalhistorydeleted(Request $request) {
		if($request->id) {
			$deleted = SurgicalHistory::destroy($request->id);
			return response()->json(['success' => $deleted ? true : false]);
		}
		return response()->json(['success' => false, 'message' => 'No ID provided.'], 400);
	}
	
	
	
	public function SurgicalConditions(Request $request, User $user){
		
		if(ismobile()){
			return redirect('personal-record?active-tab=tab5');	
		}
		
		$user = $request->query('user_id') 
            ? User::find($request->query('user_id')) 
            : Auth::user();
			
		
		 
		$surgical_history = $user->surgical_history;
		
		
		
		$dependents = Auth::user()->dependents;
		$dependents = $dependents->merge(Auth::user()->parent_dependents);
		return view('HealthRecord::surgical-condition', compact(['surgical_history','dependents','user']));
		
	}

}
