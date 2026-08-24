<?php



namespace App\Http\Controllers;



use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;



use App\Traits\ApiResponse;



use App\Validators\MedicationAllergyValidator;

use App\Validators\MedicationValidator;

use App\Validators\MedicalValidator;



use App\Models\Consultations;

use App\Models\MedicationAllergy;

use App\Models\MedicalCondition;

use App\Models\UserDetails;

use App\Models\Medication;

use App\Models\Timezones;

use App\Models\States;

use App\Models\User;

use App\Models\UserPharmacy;

use App\Mail\UserRegister;

use App\Models\UserMeta;

use Carbon\Carbon;





use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;



use NunoMaduro\Collision\Adapters\Phpunit\State;

use View;

use \stdClass;

use Braintree\Gateway;



class ConsultationController extends Controller

{

    use ApiResponse;



    public function __construct()

    {

        // code...

    }



    /**

     * Show the consult form.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function consultationType(Request $request)

    {

        if(isMobile()){

            return view('mobile.consultation.consultation-type');

        }

        return view('consultation/consultation-type');

    }

	

    public function labsReportList(Request $request)

    {

		$tele_data = [];

		$post_url=Config::get('constants.tel_api_url')."lab/getRequested";

        $data = $this->postToteleMedicine($tele_data, $post_url, false, false);

			

        if(isMobile()){

            return view('mobile.consultation.labs-report-list',compact('data'));

        }

        return view('consultation/labsReportList',compact('data'));

    }



    /**

     * Show the consult form.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function consultForm($modality, $step = "", $id = "")

    {

        

       // session(['schedule-consultation-current-url' => url()->current()]);



        $dependents = Auth::user()->dependents;

        $dependents = $dependents->merge(Auth::user()->parent_dependents);

        $states = States::all();

        $timezones = Timezones::all();

        $consultation = $user = $user_state = $pharmacy_state = $last_updated = "";

        if (!empty($id)) {

            $consultation = Consultations::where('id', $id)->first();

            $user = User::where('userid', $consultation->userId)->first();

            $user_state = States::where('id', $user->stateid)->first()->name??'';



            // Get Last update health records //

            $last_updated_personal_info = UserDetails::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->first();

            $last_updated_medication = Medication::where('userId', $user->id)->orderBy('updated_at', 'DESC')->first();

            $last_updated_medication_condition = MedicalCondition::where('userId', $user->id)->orderBy('updated_at', 'DESC')->first();

            $last_updated_medication_allergy = MedicationAllergy::where('userId', $user->id)->orderBy('updated_at', 'DESC')->first();



            $personal_info_date = $last_updated_personal_info ? $last_updated_personal_info->updated_at : "";

            $medication_date = $last_updated_medication ? $last_updated_medication->update_at : "";

            $medication_condition_date = $last_updated_medication_condition ? $last_updated_medication_condition->updated_at : "";

            $medication_allergy_date = $last_updated_medication_allergy ? $last_updated_medication_allergy->updated_at : "";



            $last_update_dates = array($personal_info_date, $medication_date, $medication_condition_date, $medication_allergy_date);



            $max = max(array_map('strtotime', $last_update_dates));



            $last_updated = $max ? date('m/d/Y', $max) : "";

        }

        if (Auth::user()->user_pharmcay) {

            $pharmacy_state_id = Auth::user()->user_pharmcay->stateid;

            $pharmacy_state = States::where('state_id', $pharmacy_state_id)->first();

        }

		

		$eligible_members = "";

		$data = Consultations::where('id',$id)->first();

		if($data && $data->eligible_members) {

			$eligible_members = json_decode($data->eligible_members);

		}

			

		$medications = $user->user_medications??'';

		

		try {

			$clientToken = $this->gateway()->clientToken()->generate();

		} catch (\Exception $e) {

			\Log::error('Braintree Client Token Error: ' . $e->getMessage());

			$clientToken = '';

		}

		

		

        if(isMobile()){

			

			

            return view('mobile.consultation.schedule-consultation', compact(['dependents', 'states', 'modality', 'consultation', 'user', 'user_state', 'timezones', 'pharmacy_state', 'last_updated','eligible_members','medications','clientToken']));

        }

        return view('consultation/schedule-consultation', compact(['dependents', 'states', 'modality', 'consultation', 'user', 'user_state', 'timezones', 'pharmacy_state', 'last_updated','eligible_members','medications','clientToken']));

    }



	protected function gateway()

	{

	

		return new Gateway(

					[

						'environment' => env('BTREE_ENVIRONMENT'),

						'merchantId' => env('BTREE_MERCHANT_ID'),            

						'publicKey' => env('BTREE_PUBLIC_KEY'),            

						'privateKey' => env('BTREE_PRIVATE_KEY'),       

					]);    

	}

    /**

     * Show the information intake.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function informationIntake()

    {

        if (empty(Session::get('authorization'))) {

            $this->apiAuthentication();

        }



        $states = States::all();

        $timezones = Timezones::all();

        $user = Auth::user();



        //  get all consultations

        $input['start'] = Config::get('constants.start');

        $input['length'] = Config::get('constants.length');

        $input['status'] = Config::get('constants.status');

        $post_url = Config::get('constants.tel_api_url') . 'consultationHistory/getAllConsultations';

        $response = $this->postToteleMedicine($input, $post_url);

        $consultations = @$response['data'];



        // get all health records

        $post_url = Config::get('constants.tel_api_url') . 'healthRecords/' . $user->userid;

        $healthData = $this->postToteleMedicine($input, $post_url, false);

        $healthRecords = @$healthData;



        return view('information-intake', compact(['user', 'states', 'timezones', 'consultations', 'healthRecords']));

    }



    /**

     * Post step first primary member create

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function storeGeneralInfo($input,$import = false)

    {

        // dd($input['planDetailsId']);

        try {

            if (empty(Session::get('authorization'))) {

                $this->apiAuthentication();

            }

            

             



            $user = Auth::user();

            $input['primaryExternalId'] = $user->id;

            $user->planid = $input['planid'] = Config::get('constants.planid');

            $user->groupCode = $input['groupCode'] = Config::get('constants.groupCode');

            $user->address2 = $input['address2'];

            $user->planDetailsId = $input['planDetailsId'];

            $user->stateid = $input['stateid'];

            $user->city = $input['city'];

            $user->zipCode = $input['zipCode'];

            $user->primaryPhone = $input['primaryPhone'];



            $user->disableNotifications = isset($input['disableNotifications']) ? $input['disableNotifications'] : '0';

            $user->timezoneId = $input['timezoneId'];

            $user->effectiveDate = $input['effectiveDate'];

            $user->numAllowedDependents = $input['numAllowedDependents'];

            $user->language = 'en';

            $user->gender = $input['gender'];

            $user->dob = $input['dob'];



            $user_envdata = getUserPlanIDAccordingEnv();

            // tele medicine data

            $tele_data = array(

                "primaryExternalId" => $input['id'],

                "groupCode" => Config::get('constants.groupCode'),

                "planid" => $user_envdata['plan_id'],

                "planDetailsId" => isset($input['planDetailsId']) ? ($input['planDetailsId'] >= 3 ? 3 : $input['planDetailsId']) : 1,

                "firstname" => $input['fname'],

                "lastname" => $input['lname'],

                "dob" => $input['dob'],

                "email" =>trim($input['email']),

                "password" =>trim(base64_decode($input['user_password'])),

                "primaryPhone" => $input['primaryPhone'],

                "heightFeet" => isset($input['heightFeet']) ? $input['heightFeet'] : 0,

                "heightInches" => isset($input['heightInches']) ? $input['heightInches'] : 0,

                "weight" => isset($input['weight']) ? $input['weight'] : 0,

                "address" => $input['address'],

                "address2" => isset($input['address2']) ? $input['address2'] : "",

                "zipCode" => $input['zipCode'],

                "city" => $input['city'],

                "stateid" => $input['stateid']?$input['stateid']:12,

                "timezoneid" => isset($input['timezoneId']) ? $input['timezoneId'] : "",

                "disableNotifications" => isset($input['disableNotifications']) ? $input['disableNotifications'] : 0,

                "sendRegistrationNotification" => isset($input['sendRegistrationNotification']) ? $input['sendRegistrationNotification'] : 1,

                "numAllowedDependents" => isset($input['numAllowedDependents']) ? $input['numAllowedDependents'] : 8,

                "language" => isset($input['language']) ? $input['language'] : "",

                "customAttributeId" => isset($input['customAttributeId']) ? $input['customAttributeId'] : "",

                "customAttributeValue" => isset($input['customAttributeValue']) ? $input['customAttributeValue'] : "",

                "effectiveDate" => isset($input['effectiveDate']) ? $input['effectiveDate'] : "",

                "gender" => isset($input['gender']) ? $input['gender'] == 'other'? 'u' : $input['gender'] : "",

            );

             

             $post_url = Config::get('constants.tel_api_url') . 'census/createMember';

           

            $response = $this->postToteleMedicine($tele_data, $post_url, true, true);



            



            if ($response['success']) {

                //$user->step_position = 4;

                $user->userid = (string) $response['userid'];

                //$user->userid = "12365478";

                $user->save();



                // Send Email //

                $data = Mail::to($user->email)->send(new UserRegister($user->email, base64_decode($user->user_password), $user->name));

            }

            return $response;

        } catch (\Exception $e) {

            return $e->getMessage();

        }

    }



    // public function addpet()

    // {

    //     try {

    //         // if (empty(Session::get('authorization'))) {

    //         //     $this->apiAuthentication();

    //         // }



    //         $user = Auth::user();



    //         // tele medicine data

    //         $tele_data = array(

    //             "name"=>'Tony',

    //             "species"=>'Dog',

    //             "breed"=>'German Shepherd',

    //             "years"=>13,

    //             "months"=>2,

    //             "gender"=>'m',

    //             "sterilization"=>1

    //         );

    //         $post_url = 'https://portal.mytelemedicine.com/go/api/pet';

    //         $response = $this->postToteleMedicine($tele_data, $post_url, true, false);

    //         if ($response['success']) {

    //         echo 'success';

    //        }

    //         return $response;

    //     } catch (\Exception $e) {

    //         return $e->getMessage();

    //     }

    // }



    /**

     * Post step first of store dependent member

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function storeDependentInfo($input)

    {

        try {

            if (empty(Session::get('authorization'))) {

                $this->apiAuthentication();

            }

            $user = Auth::user();

            $id = DB::select("SHOW TABLE STATUS LIKE 'users'");

            $next_id = $id[0]->Auto_increment;

            $dob = isset($input['dob']) ? date('m/d/Y', strtotime($input['dob'])) : "";

            $effective_date = isset($input['effective_date']) ? date('m/d/Y', strtotime($input['effective_date'])) : date('m/d/Y');

            $tele_data = array(

                "primaryExternalId" => $user->id,

                "dependentExternalId" => $next_id,

                // "planDetailsId" => $user->planDetailsId,

                "planDetailsId" => isset( $user->planDetailsId) ? ( $user->planDetailsId >= 3 ? 3 : $user->planDetailsId) : 1,

                "firstname" => $input['fname'],

                "lastname" => $input['lname'],

                "gender" => $input['gender'],

                "primaryPhone" => $input['primaryPhone'],

                "address" => $input['address'],

                "address2" => $input['address2'],

                "city" => $input['city'],

                "stateid" => $input['stateid'],

                "zipCode" => $input['zipCode'],

                "timezoneId" => $input['timezoneId'],

                "effectiveDate" => isset($input['effectiveDate']) ? $input['effectiveDate'] : "",

                "dob" => $dob,

                "email" => isset($input['email']) ? $input['email'] : "",

                "password" => isset($input['password']) ? $input['password'] : "",

                "relationshipId" => $input['relationship'],

                "groupCode" => Config::get('constants.groupCode'),

                "planid" => Config::get('constants.planid'),

            );

            

            $post_url = Config::get('constants.tel_api_url') . 'census/createMemberDependent';

            $response = $this->postToteleMedicine($tele_data, $post_url, true, true);

            return $response;

        } catch (\Exception $e) {

            return $e->getMessage();

        }

    }



    /**

     * Post step medication

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function storeMedication(Request $request, User $user)

    {

        try {

            $input = $request->all();

            $medicationValidator = new MedicationValidator();

            if (!$medicationValidator->with($input)->passes()) {

                return redirect()->back()->with('error', $medicationValidator->getErrors()[0]);

            }

            Medication::deleteInComplete();

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



            $request->session()->flash('success', 'Medication saved successfully');

            if( isset($input['redirect']) && !empty($input['redirect']) ){

                return redirect($input['redirect']);

            }

            return redirect()->back();

            /* } else {

                return redirect()->back()->with('error', $response['message']);

            } */

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }





    /*

    *   Search medication data for selecting

    *   @return String

    */

    public function searchMedication(Request $request)

    {

        $input = $request->all();



        $post_url = Config::get('constants.tel_api_url') . 'medication/search?query=' . $input['keyword'];

        $this->setMemberSession($request->user());

        $response = $this->postToteleMedicine($input, $post_url, false);

        if ($response['success']) {

            $response = $response['suggestions'];

            $html = View::make('health-records.medication-selectbox', compact('response'))->render();

            return response()->json(['data' => $html]);

        } else {

            return response()->json(['data' => $response]);

        }

    }



    /**

     * Post step medical condition

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function storeMedicationAllergy(Request $request, User $user, MedicationAllergyValidator $medicationAllergyValidator)

    {

        try {

            $input = $request->all();

            if (!$medicationAllergyValidator->with($input)->passes()) {

                return redirect()->back()->with('error', $medicationAllergyValidator->getErrors()[0]);

            }



            $post_url = Config::get('constants.tel_api_url') . 'medicationAllergies/add/' . $user->userid;

            //$this->setMemberSession($user);

            $response = $this->postToteleMedicine($input, $post_url);

            if ($response['success']) {

                $model = new MedicationAllergy;

                $model->userId = $user->id;

                $model->addedAllergyId = isset($response['addedAllergyId']) ? $response['addedAllergyId'] : 0;

                $model->name = $input['medicationAllergyName'];

                $model->foreignId = $input['medicationAllergyForeignId'];

                $model->damConceptId = $input['medicationAllergyDamConceptId'];

                $model->damConceptIdType = $input['medicationAllergyDamConceptIdType'];



                activityLog("Find {$model->name}",$model,'medicationAllergy');



                $model->save();

                return redirect()->back()->with('success', 'Medication allergy saved successfully');

            } else {

                return redirect()->back()->with('error', $response['message']);

            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }



    /**

     * Post consultation

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function storeConsultation($id)

    {

        try {

            $consultation = Consultations::where('id', $id)->first();

            $state = States::firstWhere(['id' => $consultation->stateid]);

            /* $obj = new stdClass();

            $problems->chiefComplaint = $consultation->chiefComplaint;

            $problems->otherProblems = $consultation->otherProblems ? explode(",",$consultation->otherProblems) : [];

            $problems->acceptInformedConsent = true;

            $problems->acceptInformedConsentDateTime = date('Y-m-d h:i:s'); */

            $this->setMemberSession(Auth::user());

            // tele medicine data

            $tele_data = array(

                "consultationUserId" => $consultation->userId,

                "state" => $state ? $state->abbreviation : "AL",

                "modalities" => $consultation->modalities,

                "phoneNumber" => $consultation->phoneNumber,

                "videoConsultReadyTextNumber" => $consultation->phoneNumber,

                "sureScriptPharmacy_id" => $consultation->sureScriptPharmacy_id ? $consultation->sureScriptPharmacy_id : "",

                "patientDescription" => $consultation->patientDescription,

                "translate" => $consultation->translate ? $consultation->translate : "",

                "whenScheduled" => $consultation->whenScheduled,

                "timezoneOffset" => "-4",

                "roi" => $consultation->roi,

            );

            $tele_data['problems']['chiefComplaint'] = $consultation->cheifComplaint;

            $tele_data['problems']['otherProblems'] = $consultation->otherProblems ? explode(",", $consultation->otherProblems) : [];

            $tele_data['problems']['acceptInformedConsent'] = true;

            $tele_data['problems']['acceptInformedConsentDateTime'] = date('Y-m-d h:i:s');



            $post_url = Config::get('constants.tel_api_url') . 'consultation/new';

            $consultData['payload'] = json_encode($tele_data);

            $response = $this->postToteleMedicine($consultData, $post_url);

            if ($response['success']) {

                $consultation->consultationId = $response['consultationId'];

                $consultation->consultationTypeName = $response['consultationTypeName'];

                $consultation->save();

            }

            return $response;

        } catch (\Exception $e) {

            $request->session()->flash('error', $e->getMessage());

        }

        return redirect()->back();

    }



    /**

     * update Personal Info

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function updatePersonalInfo(Request $request, User $user)

    {

        try {

            $input = $request->all();

            $input = request()->except(['_token']);



            // tele medicine data

            $tele_data = array(

                "heightFeet" => isset($input['heightFeet']) ? $input['heightFeet'] : "",

                "heightInches" => isset($input['heightInches']) ? $input['heightInches'] : "",

                "smokingHabits" => isset($input['smokingHabits']) ? $input['smokingHabits'] : "",

                "bloodType" => isset($input['bloodType']) ? $input['bloodType'] : "",

                "bloodPressureSystolic" => isset($input['bloodPressureSystolic']) ? $input['bloodPressureSystolic'] : "",

                "bloodPressureDiastolic" => isset($input['bloodPressureDiastolic']) ? $input['bloodPressureDiastolic'] : "",

                "maritalStatus" => isset($input['maritalStatus']) ? $input['maritalStatus'] : "",

                "drinkingHabits" => isset($input['drinkingHabits']) ? $input['drinkingHabits'] : "",

                "exerciseHabits" => isset($input['exerciseHabits']) ? $input['exerciseHabits'] : "",

                "exerciseLength" => isset($input['exerciseLength']) ? $input['exerciseLength'] : "",

                "weight" => isset($input['weight']) ? $input['weight'] : "",

            );



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

                $request->session()->flash('success', 'Personal health information has been updated successfully.');

            } else {

                return redirect()->back()->with('error', $response['message']);

            }

        } catch (\Exception $e) {

            $request->session()->flash('error', $e->getMessage());

        }

        return redirect()->back();

    }



    /**

     * fetch all states

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function importStates()

    {

        try {

            $state_url = Config::get('constants.tel_api_url') . 'states/all';

            if (Session::get('authorization')) {

                $authorization = Session::get('authorization');

            } else {

                $this->apiAuthentication();

                $authorization = Session::get('authorization');

            }

            $header[] = $authorization;

            $response = curlRequest($state_url, [], true, $header);

            $states = json_decode($response, 1);

            $count = 0;

            foreach ($states['states'] as $state) {

                $model = new States;

                $get_state = States::find($state['state_id']);

                if (empty($get_state)) {

                    $model->state_id = $state['state_id'];

                    $model->name = $state['name'];

                    $model->abbreviation = $state['abbreviation'];

                    $model->save();

                    $count++;

                }

            }

            echo "Inserted states : " . $count;

            die;

        } catch (\Exception $e) {

            echo $e->getMessage();

        }

    }





    /**

     * fetch all timezones

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function importTimezones()

    {

        try {

            $timezone_api_url = Config::get('constants.tel_api_url') . 'timezones/all';

            if (Session::get('authorization')) {

                $authorization = Session::get('authorization');

            } else {

                $this->apiAuthentication();

                $authorization = Session::get('authorization');

            }

            $header[] = $authorization;

            $response = curlRequest($timezone_api_url, [], true, $header);

            $timezones = json_decode($response, 1);

            $count = 0;

            foreach ($timezones['timezones'] as $time) {

                $model = new Timezones;

                $get_state = Timezones::find($time['timezone_id']);

                if (empty($get_state)) {

                    $model->timezone_id = $time['timezone_id'];

                    $model->name = $time['name'];

                    $model->offset = $time['offset'];

                    $model->save();

                    $count++;

                }

            }

            echo "Inserted timezones : " . $count;

            die;

        } catch (\Exception $e) {

            echo $e->getMessage();

        }

    }



    /**

     * Tele medicine member authentication

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function apiMemberAuthentication($email, $password)

    {

        $credentials = array('email' => $email, 'password' => $password);

        $response = curlRequest(Config::get('constants.tel_login_url'), $credentials, true, [], true);

        $data = explode("\n", $response);

        if (strpos($data[12], 'Bearer') !== false) {

            Session::put('authorization', $data[12]);

            return ['success' => 'true', 'data' => $data[12]];

        }

        return end($data);

    }



    /**

     * Tele medicine authentication

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function apiAuthentication()

    {

        $credentials = array('email' => Config::get('constants.tel_email'), 'password' => Config::get('constants.tel_password'));

        $response = curlRequest(Config::get('constants.tel_login_url'), $credentials, true, [], true);

        

        $data = explode("\n", $response);

        if (strpos(@$data[12], 'Bearer') !== false) {

            Session::put('authorization', $data[12]);

            return ['success' => 'true', 'data' => $data[12]];

        }

        return end($data);

    }



    /**

     * post to tele medicine

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function postToteleMedicine($data, $post_url, $postMethod = true, $isadmin = false)

    {

        if ($isadmin) {

            $token = str_replace(array("\r\n", "\n", "\r"), '', Session::get('authorization'));

            $headers = array($token);

        } else {

            $token = str_replace(array("\r\n", "\n", "\r"), '', Session::get('member_auth'));

            $headers = array($token);

        }

        

        

        if ($postMethod) {

			

            $response = curlRequest($post_url, $data, true, $headers);

        } else {

		

            $response = curlRequest($post_url, [], false, $headers);

        }

        $result = json_decode($response, 1);

        return $result;

    }



    public function setMemberSession($params)

    {

        if ($params->email && $params->password) {

            $credentials = array('email' => $params->email, 'password' => base64_decode($params->user_password));

			/* echo "<pre>";

			print_r($credentials);

			echo "</pre>";

			echo Config::get('constants.tel_login_url'); */

			

            $response = curlRequest(Config::get('constants.tel_login_url'), $credentials, true, [], true);

            $data = explode("\n", $response);

            if( isset($data[12]) ){

                if (strpos($data[12], 'Bearer') !== false) {

                    Session::put('member_auth', $data[12]);

                    Session::save();

                    return ['success' => 'true', 'data' => $data[12]];

                }

            }

            return end($data);

        }

    }

    

    public function updateGeneralInfoRP($input, $password = false)

    {

        if (empty(Session::get('authorization'))) {

            $this->apiAuthentication();

        }

        $user = Auth::user() ? Auth::user() : $input['user'];

        

        $tele_data = array(

            "primaryExternalId" => $user->id,

            "groupCode" => Config::get('constants.groupCode'),

            "planid" => isset(Auth::user()->bundle_id) ? Auth::user()->bundle_id : Config::get('constants.planid'),

            // "planDetailsId" => $user->planDetailsId ? $user->planDetailsId : 1,

            "planDetailsId" => isset( $user->planDetailsId) ? ( $user->planDetailsId >= 3 ? 3 : $user->planDetailsId) : 1,

            "email" => $user->email,

            "firstname" => $user->fname,

            "lastname" => $user->lname,

            "dob" => $user->dob,

            "primaryPhone" => isset($input['primaryPhone']) ? $input['primaryPhone'] : $user->primaryPhone,

            "heightFeet" => $user->user_details ? $user->user_details->heightFeet ? $user->user_details->heightFeet : 0 : 0,

            "heightInches" => $user->user_details ? $user->user_details->heightInches ? $user->user_details->heightInches : 0 : 0,

            "weight" => $user->user_details ? $user->user_details->weight ? $user->user_details->weight : 0 : 0,

            "address" => isset($input['address']) ? $input['address'] : $user->address,

            "address2" => isset($input['address2']) ? $input['address2'] : $user->address2,

            "zipCode" => isset($input['zipCode']) ? $input['zipCode'] : $user->zipCode,

            "city" => isset($input['city']) ? $input['city'] : $user->city,

            "stateid" => isset($input['stateid']) ? $input['stateid'] : ($user->stateid?$user->stateid:1),

            "timezoneid" => isset($input['timezoneid']) ? $input['timezoneid'] : $user->timezoneid,

            "gender" => isset($input['gender']) ? $input['gender'] : $user->gender,

        );



        if ($password) {

            $tele_data['password'] = $input['password'];/*

            pre($password);die;

            $tele_data['password'] = $password['password']; */

            //pre($tele_data);die;

        }



        $post_url = Config::get('constants.tel_api_url') . 'census/updateMember';

        $response = $this->postToteleMedicine($tele_data, $post_url, true, true);

        return $response;

    }



    /**

     * Member update

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

     

    public function updateGeneralInfo($input, $password = false)

    {

        if (empty(Session::get('authorization'))) {

            $this->apiAuthentication();

        }

        $user = Auth::user() ? Auth::user() : $input;

        $tele_data = array(

            "primaryExternalId" => $user->id,

            "groupCode" => Config::get('constants.groupCode'),

            "planid" => Config::get('constants.planid'),

            // "planDetailsId" => $user->planDetailsId,

            "planDetailsId" => isset( $user->planDetailsId) ? ( $user->planDetailsId >= 3 ? 3 : $user->planDetailsId) : 1,

            "email" => $user->email,

            "firstname" => $user->fname ?? $input['fname'],

            "lastname" => $user->lname ?? $input['lname'],

            "dob" => $user->dob,

            "primaryPhone" => isset($input['primaryPhone']) ? $input['primaryPhone'] : $user->primaryPhone,

            "heightFeet" => $user->user_details ? $user->user_details->heightFeet ? $user->user_details->heightFeet : 0 : 0,

            "heightInches" => $user->user_details ? $user->user_details->heightInches ? $user->user_details->heightInches : 0 : 0,

            "weight" => $user->user_details ? $user->user_details->weight ? $user->user_details->weight : 0 : 0,

            "address" => isset($input['address']) ? $input['address'] : $user->address,

            "address2" => isset($input['address2']) ? $input['address2'] : $user->address2,

            "zipCode" => isset($input['zipCode']) ? $input['zipCode'] : $user->zipCode,

            "city" => isset($input['city']) ? $input['city'] : $user->city,

            "stateid" => isset($input['stateid']) ? $input['stateid'] : $user->stateid,

            "timezoneid" => isset($input['timezoneid']) ? $input['timezoneid'] : $user->timezoneid,

            "gender" => isset($input['gender']) ? $input['gender'] : $user->gender,

        );

        // dd($tele_data);



        if ($password) {

            $tele_data['password'] = $input['password'];/*

            pre($password);die;

            $tele_data['password'] = $password['password']; */

            //pre($tele_data);die;

        }



        $post_url = Config::get('constants.tel_api_url') . 'census/updateMember';

        $response = $this->postToteleMedicine($tele_data, $post_url, true, true);

        return $response;

    }



    public function getDoctorsList(Request $request, $userId = null) {



        if (empty(Session::get('authorization'))) {

            $this->apiAuthentication();

        }

		$userId = $userId ??Auth::user()->id;

		$stateid = "44";

		$gender = "";

		if($request->input('doctorgender')) {

			$gender = "&gender=".$request->input('doctorgender')."";

		}

		$date = $request->input('appointmentdate')??date('Y-m-d');

		

		$consultation_type = $request->scheduleConsultation['action'];

		$state_option  = $this->getStateByID($request);

		 

        $post_url = Config::get('constants.tel_api_url')."v2/consultation/availability?consultation_type=$consultation_type&userId=$userId&state=$state_option&date=$date$gender";

        $tele_data = [];

        $doctore_list = $this->postToteleMedicine($tele_data, $post_url, false, false);

		

		/* echo "<pre>";

		print_r($doctore_list);

		echo "</pre>"; */

		

		if($request->input('action')) {

			if(isMobile()){

				$html = view('mobile.consultation.schedule-consultation-step.get-doctors-list', compact('doctore_list'))->render();

			} else {

				$html = view('consultation.schedule-consultation-step.get-doctors-list', compact('doctore_list'))->render();

			}

			

			

			return response()->json([

				'status' => 'success',

				'html' => $html

			]);



		}

        return $doctore_list;

        

        

        /**/ 

    }

    public function updateGeneralInfoApp($input, $password = false)

    {

        if (empty(Session::get('authorization'))) {

            $this->apiAuthentication();

        }

        $user = Auth::user() ? Auth::user() : $input;



        $user_envdata = getUserPlanIDAccordingEnv();





        $tele_data = array(

            "primaryExternalId" => $user->id,

            "groupCode" => Config::get('constants.groupCode'),

             "planid" => $user_envdata['plan_id'],

            // "planDetailsId" => $user->planDetailsId,

            "planDetailsId" => isset( $user->planDetailsId) ? ( $user->planDetailsId >= 3 ? 3 : $user->planDetailsId) : 1,

            "email" => $user->email,

            "firstname" => $user->fname,

            "lastname" => $user->lname,

            "dob" => $user->dob,

            "primaryPhone" => isset($input['primaryPhone']) ? $input['primaryPhone'] : $user->primaryPhone,

            "heightFeet" => $user->user_details ? $user->user_details->heightFeet ? $user->user_details->heightFeet : 0 : 0,

            "heightInches" => $user->user_details ? $user->user_details->heightInches ? $user->user_details->heightInches : 0 : 0,

            "weight" => $user->user_details ? $user->user_details->weight ? $user->user_details->weight : 0 : 0,

            "address" => isset($input['address']) ? $input['address'] : $user->address,

            "address2" => isset($input['address2']) ? $input['address2'] : $user->address2,

            "zipCode" => isset($input['zipCode']) ? $input['zipCode'] : $user->zipCode,

            "city" => isset($input['city']) ? $input['city'] : $user->city,

            "stateid" => isset($input['stateid']) ? $input['stateid'] : $user->stateid,

            "timezoneid" => isset($input['timezoneid']) ? $input['timezoneid'] : $user->timezoneid,

            "gender" => isset($input['gender']) ? $input['gender'] : $user->gender,

        );

        // dd($tele_data);



        if ($password) {

            $tele_data['password'] = $password['password'];/*

            pre($password);die;

            $tele_data['password'] = $password['password']; */

            //pre($tele_data);die;

        }



        //$post_url = "https://staging.getlyric.com/go/api/census/updateMember";

        $post_url = Config::get('constants.tel_api_url') . 'census/updateMember';

        $response = $this->postToteleMedicine($tele_data, $post_url, true, true);

        return $response;

    }



    public function medicationInactive(Request $request, $medication, User $user)

    {

        try {

            $input = $request->all();



            // set to medication inactive

            $post_url = Config::get('constants.tel_api_url') . 'medication/currentuse/' . $medication . '/' . $user->userid . '/0';

            $response = $this->postToteleMedicine($input, $post_url, false);

            if ($response['success']) {

                $models = Medication::where('medicationId', $medication);

                $models->update(['currentlyUse' => 'false']);

                $request->session()->flash('success', 'Medication updated successfully');

                return redirect('/medications');

            } else {

                return redirect()->back()->with('error', $response['message']);

            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }





    /*

    *   Search medication Allergy for selecting

    *   @return String

    */

    public function searchMedicationAllergy(Request $request)

    {

        $input = $request->all();



        $post_url = Config::get('constants.tel_api_url') . 'medicationAllergies/search?query=' . $input['keyword'];

        $this->setMemberSession($request->user());

        $response = $this->postToteleMedicine($input, $post_url, false);



        if ($response['success']) {

            $response = $response['suggestions'];

            $html = View::make('health-records.medication-allergy-filter', compact('response'))->render();

            return response()->json(['data' => $html]);

        } else {

            return response()->json(['data' => $response]);

        }

    }



    /*

    *   Medication allergy for inactive

    *   @return String

    */

    public function medicationAllergyInactive(Request $request, $allergyId, User $user)

    {

        try {

            $input = $request->all();

            $allergyData = MedicationAllergy::where('addedAllergyId', $allergyId);

            $allergyFirst = $allergyData->first();

            // set to medication inactive

            $this->setMemberSession($user);

            $post_url = Config::get('constants.tel_api_url') . 'medicationAllergies/markInactive/' . $allergyFirst->addedAllergyId . '/' . $allergyFirst->foreignId . '/' . $user->userid;

            $response = $this->postToteleMedicine($input, $post_url, false);

            if ($response['success']) {

                $allergyData->update(['deleted_at' => Carbon::now()]);

                return redirect()->back()->with('success', 'Medication allergy updated successfully');

            } else {

                return redirect()->back()->with('error', $response['message']);

            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }



    /*

    *   Medical History for inactive

    *   @return String

    */

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



    /**

     * Post step medical condition

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function storeMedicalCondition(Request $request, User $user, MedicalValidator $medicalValidator)

    {

        try {

            $input = $request->all();

            if (!$medicalValidator->with($input)->passes()) {

                return redirect()->back()->with('error', $medicationValidator->getErrors()[0]);

            }



            $post_url = Config::get('constants.tel_api_url') . 'medicalCondition/add/' . $user->userid;

            $response = $this->postToteleMedicine($input, $post_url);



            if ($response['success']) {

                $model = new MedicalCondition;

                $model->name = $input['medicalConditionName'];

                $model->description = $input['medicalConditionDescription'];

                $model->status = $input['medicalConditionStatus'];

                $model->userId = $user->id;

                $model->medicalConditionId = $response['medicalConditionId'];



                activityLog("Find {$model->name}",$model,'medical-history');



                $model->save();

                return redirect()->back()->with('success', 'Medical condition saved successfully');

            } else {

                return redirect()->back()->with('error', $response['message']);

            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }



    /*

    *   Medical History update

    *   @return String

    */

    public function medicalHistoryUpdate(Request $request, $medicalConditionId, MedicalValidator $medicalValidator)

    {

        try {

            $input = request()->except(['_token']);

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



    /**

     * Member Dependent update

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function updateDenedentInfo($input, $user, $password = false)

    {

        if (empty(Session::get('authorization'))) {

            $this->apiAuthentication();

        }



        // tele medicine data

        $tele_data = array(

            "primaryExternalId" => $user->parentId,

            "dependentExternalId" => $user->id,

            "groupCode" => Config::get('constants.groupCode'),

            "planid" => Config::get('constants.planid'),

            "email" => isset($input['email']) ? $input['email'] : $user->email,

            "firstname" => $user->fname,

            "lastname" => $user->lname,

            "dob" => $user->dob,

            "primaryPhone" => isset($input['primaryPhone']) ? $input['primaryPhone'] : $user->primaryPhone,

            "address" => isset($input['address']) ? $input['address'] : $user->address,

            "address2" => isset($input['address2']) ? $input['address2'] : $user->address2,

            "zipCode" => isset($input['zipCode']) ? $input['zipCode'] : $user->zipCode,

            "city" => isset($input['city']) ? $input['city'] : $user->city,

            "stateid" => isset($input['stateid']) ? $input['stateid'] : $user->stateid,

            "timezoneid" => isset($input['timezoneId']) ? $input['timezoneId'] : $user->timezoneId,

            "gender" => isset($input['gender']) ? $input['gender'] : $user->gender,

            "relationshipId" => isset($input['relationship']) ? $input['relationship'] : $user->relationship,

        );



        if ($password) {

            $tele_data['password'] = $input['password'];

        }

			

        $post_url = Config::get('constants.tel_api_url') . 'census/updateMemberDependent';

        $response = $this->postToteleMedicine($tele_data, $post_url, true, true);

	

        return $response;

    }





    /**

     * Post consultation

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function createConsultation(Request $request)

    {

		

		$userId = Auth::user()->userid;

		$action = $request->action;

		$tele_data = [];

		$post_url=Config::get('constants.tel_api_url')."v2/consultation/$action?user_id=$userId&modality=phone";

        $eligible_members = $this->postToteleMedicine($tele_data, $post_url, false, false);

		/* echo "<pre>";;

		print_r($eligible_members);

		echo "</pre>"; */

        if(isset($eligible_members) && $eligible_members['success']==1) {

	

			$input = $request->all();

			$model = new Consultations;

			$model->userId = $input['userid'];

			$model->modalities = $input['modality'];

			$model->eligible_members = json_encode($eligible_members);

			$consultation = $model->save();

			if ($consultation) {

				echo json_encode(['original' => ['status' => true, 'consultation_id' => $model->id]]);

				die;

			} else {

				echo json_encode(['original' => ['status' => false]]);

				die;

			}	

			

		}

		echo json_encode(['original' => ['status' => false,'message'=>$eligible_members['message']]]);

    }



    public function updateConsultation(Request $request, $consultation_id)

    {

        try {

            $input = $request->all();

            $nextStep = $input['next-step'];

            $consultation = Consultations::where('id', $consultation_id)->first();

           

            $action_type = $input['action_type'] ?? '';

            $redirct_url = '/schedule-consultation/' . $consultation->modalities . '/' . $input['next-step'] . '/' . $consultation->id . '/?action='.$action_type.'';



            unset($input['next-step']);



            if(isset($_POST['state_option']) && !empty($_POST['state_option']) && $_POST['state_option']==2){

                $input['stateid'] = $_POST['stateid_option'];

            }

          



            if (isset($input['otherProblems']) && !empty($input['otherProblems'])) {

                $otherProblems = implode(',', $input['otherProblems']);

                $input['otherProblems'] = $otherProblems;

            }



            if (isset($input['whenScheduled']) && !empty($input['whenScheduled'])) {

                if ($input['whenScheduled'] == "future") {

                    $selected_date = $input['cal-selected-date'];

                    $selected_time = $input['selected-time'] ? date("H:i", strtotime($input['selected-time'])) : "";

                    $input['whenScheduled'] = $selected_date . ' ' . $selected_time . ':00';

                } else {

                    $input['whenScheduled'] = "now";

                }

            }



            $msg = false;

            switch($nextStep){

                case 'step-4':

                    $msg = "Verify our no. and choise {$input['roi']} for consultations";

                break;

                case 'step-5':

                    $state = States::where('state_id',$input['stateid'])->pluck('name');

                    $msg = "Choice {$state} city for consultations";

                break;

                case 'step-7':

                    $dateChoice = date("Y f d h:i",strtotime("{$input['cal-selected-date']} {$input['selected-time']}"));

                    if( $input['whenScheduled'] == 'now' ){

                        $dateChoice = $input['whenScheduled'];

                    }

                    $msg = "Choice  a convenient time for this Diagnostic Phone Medical Consultation {$dateChoice}";

                break;

            }

            if( $msg ){

                activityLog($msg,$input,'schedule-a-consultation',false);

            }



            $consultation->update($input);



            if ($request['step'] == 7) {

                $result = $this->storeConsultation($consultation_id);

                if ($result['success']) {

                    $request->session()->flash('success', 'consultation request submitted successfully.');

                    return redirect($redirct_url);

                } else {

                    return redirect()->back()->with('error', $result['message']);

                }

            }

            return redirect($redirct_url);

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }



    /**

     * check for email already exist or not on telemedicine

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function validateEmail($email)

    {

        if (empty(Session::get('authorization'))) {

            $this->apiAuthentication();

        }



        // tele medicine data

        $tele_data = array(

            "email" => $email,

        );





        $post_url = Config::get('constants.tel_api_url') . 'census/validateEmail';

        $response = $this->postToteleMedicine($tele_data, $post_url, true, true);

        return $response;

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Consultations  $consultations

     * @return \Illuminate\Http\Response

     */

    public function cancelConsultation(Request $request, $id)

    {

        try {

            Consultations::where('id', $id)->delete();

            return redirect('/consultation-type')->with('success', 'Consultation cancelled successfully');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }

	

	public function getStateByID($request){

		$state_option = $request->scheduleConsultation['state_option'];

		if($state_option==2) {

			return $request->scheduleConsultation['stateid_option']; 

		}

		return States::where('id', Auth::user()->stateid)->first()->state_id;

	}

	public function GetEhr($request,$user_details) {

		

		$data = [

					"personal" => [

								"heightFeet" => $user_details->heightFeet,

								"heightInches" => $user_details->heightInches,

								"weight" => $user_details->weight

							],

							"allergies" => [],

							"medications" => [],

							"medical_conditions" => [],

							"surgical_history" => [],

							"attachments" => []

				];

		return $data;		

		

	}

	public function getPatientInfo($request,$action) {

		

		//die($request->scheduleConsultation['sureScriptPharmacy_id']);

		$user_details = Auth::user()->user_details;

		$modality = $request->scheduleConsultation['modality'];

		$price = $request->scheduleConsultation['price']??'';

		$nonce = $request->scheduleConsultation['nonce']??'';

		$startTime = $request->scheduleConsultation['startTime']??'';

		$reason_for_visit = $request->scheduleConsultation['reason_for_visit']??'';

		

		$state_option  = $this->getStateByID($request);

		

		$getEHR = $this->GetEhr($request,$user_details);

		

		$prescription_status = $request->scheduleConsultation['primarycare']['prescription_status'];

		

		if($prescription_status=="yes") {

			$prescription_status = true;

			$prescription_description = $request->scheduleConsultation['primarycare']['prescription_description'];

		} else {

			$prescription_status = false;

			$prescription_description = "";

		}

		



		

		

		$data = [];		

		$data['patient'] = ['user_id' => Auth::user()->userid,'ehr' => $getEHR];

		$data['payment'] = ['fee' =>$price,'nonce' =>$nonce ];

		$data['payment'] = ['fee' =>$price,'nonce' =>'fake-valid-nonce' ];

		//$data['payment'] = ['fee' =>140,'nonce' =>'fake-valid-nonce' ];

		$data['modality'] = $modality;

		

		$data['sureScriptPharmacy_id'] = $request->scheduleConsultation['sureScriptPharmacy_id'];

		$data['state'] = $state_option;

		$data['reason_for_visit'] = $reason_for_visit;

		$data['prescription_refill'] = ['is_needed' => $prescription_status,'prescription_details' => $prescription_description];

		

		if(in_array($action, ['primarycare', 'psychiatry', 'psychology', 'dermatology'])) {

			

			$data['labs'] = [];	

			$provider_id = $request->scheduleConsultation['primarycare']['provider_id'];

		    $time_slot_id = $request->scheduleConsultation['primarycare']['time_slot_id'];

			

			if(!in_array($action, ['dermatology'])) {

				$answers = $request->scheduleConsultation['primarycare']['health_risk'];

				$data['questionnaires'] = [['questionnaire_id' => 3,'answers' => $answers]];

			} else {

				

				

				 $data['questionnaires'] = [];

				$dermatology_state_videos = array(3,4,13,15,16);

				if($modality=="phone") {

					$time_slot_id = "";

					$startTime = "";

					/* if(!in_array($state_option,$dermatology_state_videos)) {

						

						

					} */

				} /**/

			}

			

			$data['appointment_details'] = [

											'provider_id' => $provider_id,

											'time_slot_id' => $time_slot_id,

											'startTime' => $startTime,

											'consult_time_zone' => 'America/Chicago'

											];

			

			

			

		}

		

		

		if($action=="urgentcare") {

			$whenScheduled = $request->scheduleConsultation['whenScheduled'];

			

			

			$other_problems = [];

			if(isset($request->scheduleConsultation['chief_other_problems']) && !empty($request->scheduleConsultation['chief_other_problems'])) {

				$chief_other_problems = $request->scheduleConsultation['chief_other_problems'];

				if(is_array($request->scheduleConsultation['chief_other_problems'])) {

					 $other_problems = $chief_other_problems;

				}

			}

			

			if($whenScheduled=="future"){

				

				$schedule_from = $request->scheduleConsultation['schedule_from']??'';

				$schedule_to = $request->scheduleConsultation['schedule_to']??'';

			

				$whenScheduled = $request->scheduleConsultation['schedule_date'];

				$whenScheduled = $whenScheduled." ".$schedule_from;

			}	

			

			$data['appointment_details'] = ['when_scheduled' =>$whenScheduled,'consult_time_zone' => 'America/New_York','preferred_language' => 'en'];

			

			$data['problems'] = [

				'chief_complaint_id' => $request->scheduleConsultation['cheifComplaint'],

				'other_problems' =>$other_problems

			];

			$data['roi'] = 'PCP';

		}

		

		$data['patientPhone'] = $request->scheduleConsultation['phoneNumber'];

		

		return $data;		

	}

	public function getPostURL($request,$action) {

		return Config::get('constants.tel_api_url')."consultation/createConsultation/$action";

	}

	public function createConsultationSubmit(Request $request){

		

		try {

			$action = $request->scheduleConsultation['action'];

			$post_url = $this->getPostURL($request,$action);

			$data = $this->getPatientInfo($request,$action);

			

			/*

			echo "<pre>";

			print_r($data);

			echo "</pre>";

			die("==============="); 

			

			*/

			 

			$data_json = json_encode($data);

			$response = $this->postToteleMedicine($data_json, $post_url, true, false);

			

			/* echo "<pre>";

			print_r($response);

			echo "</pre>"; 

			

			die(); */

			if(!$response['success']) {

				throw new \Exception($response['message']);

			}		

			return response()->json(['success' => true,'message' => 'Consultancy Successfully Booked'], 200);

			

		} catch (\Exception $e) {

            return response()->json(['success' => false,'message' => $e->getMessage()], 500);

        }

	}

	

	public function createConsultationPayment(Request $request) {

		/* 

		try {

			dd($request->all());

			$action = $request->scheduleConsultation['action'];

			$post_url = $this->getPostURL($request,$action);

			$data = $this->getPatientInfo($request,$action);

			$data_json = json_encode($data);

			$response = $this->postToteleMedicine($data_json, $post_url, true, false);

			if(!$response['success']) {

				throw new \Exception($response['message']);

			}		

			return response()->json(['success' => true,'message' => 'Consultancy Successfully Booked'], 200); 

			

		} catch (\Exception $e) {

            return response()->json(['success' => false,'message' => $e->getMessage()], 500);

        }

		*/

	}

	

	public function DermatologyUploadImg(Request $request) {

		

		

		 try {

				$request->validate([

					'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',

				]);



				$imageName = time() . '.' . $request->image->extension();

				$imagePath = public_path('uploads/' . $imageName);



				$request->image->move(public_path('uploads'), $imageName);



				$userid = Auth::user()->userid;

				$post_url = Config::get('constants.tel_api_url') . 'attachment/add/' . $userid;



				$token = str_replace(["\r\n", "\n", "\r"], '', Session::get('member_auth'));

				$headers = [

					"Authorization: Bearer $token",

					"Accept: application/json"

				];



				$curl = curl_init();

				curl_setopt_array($curl, [

					CURLOPT_URL => $post_url,

					CURLOPT_RETURNTRANSFER => true,

					CURLOPT_ENCODING => '',

					CURLOPT_MAXREDIRS => 10,

					CURLOPT_TIMEOUT => 0,

					CURLOPT_FOLLOWLOCATION => true,

					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

					CURLOPT_CUSTOMREQUEST => 'POST',

					CURLOPT_HTTPHEADER => $headers,

					CURLOPT_POSTFIELDS => [

						'AttachmentFile' => new \CURLFile(public_path('uploads/' . $imageName))

					],

				]);



				$response = curl_exec($curl);

				$data = json_decode($response);

				if (curl_errno($curl)) {

					throw new \Exception('cURL error: ' . curl_error($curl));

				}



				curl_close($curl);

				

				/* if(file_exists($imagePath)) {

					unlink($imagePath);

				} */

				

				return response()->json([

					'message' => 'Upload successful',

					'url' => asset('uploads/' . $imageName),

					'public_path' => public_path('uploads/' . $imageName),

					'api_response' => $response,

					'attachmentId' => $data->attachmentId

				]);



			} catch (\Exception $e) {

				return response()->json([

					'message' => $e->getMessage(),

					'error' => $e->getMessage()

				], 500);

			}

		

	}

}

