<?php

namespace App\Http\Controllers;

use Auth;
use File;
use View;
use Config;
use Stripe;
use Session;
use Braintree;
use App\Models\Plan;
use App\Models\User;
use app\Models\UserDetails;
use App\Models\UserMeta;

use App\Models\States;
use App\Models\Document;

use App\Models\UserMood;
use Stripe\StripeClient;
use App\Models\Timezones;
use App\Models\PageContents;
use App\Models\MedicationAllergy;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use App\Models\MedicalCondition;
use App\Interfaces\CommonConstants;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\ConsultationController;
use App\Models\Affirmation;
use Carbon\Carbon;
use DateTime;


class HomeController extends Controller implements CommonConstants
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
		// $this->middleware('auth');
	}

	/**
	 * Show the landing page.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		/*
		echo $utm_source = session('utm_source');
		echo "<br/>";
		echo $utm_medium = session('utm_medium');
		echo  "<br/>";
		echo $utm_campaign = session('utm_campaign');
		*/
		$pageContents = PageContents::with('dependents')->where('page_id', "=", '1')->whereNull('parent_id')->get();
		$formatedData = [];
		foreach ($pageContents as $eachRow) {
			$formatedData[$eachRow->section_name] = [];
			$formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
			$formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
			$formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
			$formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
			$formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
		}
		if (isMobile()) {
			return view('mobile.app.home', compact('formatedData'));  
		}
		return view('home', compact('formatedData'));
	}

	/**
	 * Show the my consultations.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function myConsultations($status = "all")
	{
		if (empty(Session::get('authorization'))) {
			(new ConsultationController)->apiAuthentication();
		}
		//  get all consultations
		$input['start'] = Config::get('constants.start');
		$input['length'] = Config::get('constants.length');
		//$input['length'] = 50;
		$input['status'] = $status;
		//$input['status'] = "all";
		if($status=="complete") {
			$input['status'] = "all";
		}
		
		$post_url = Config::get('constants.tel_api_url') . 'consultationHistory/getAllConsultations';
		$response = (new ConsultationController)->postToteleMedicine($input, $post_url);

		$consultations = @$response['data'];
		/* echo "<pre>";
		print_r($consultations);
		echo "</pre>";
		die(); */
		if (isMobile()) {
			return view('mobile.consultation.my-consultations', compact(["consultations"]))->with('no', 1);  
		}
		return view('consultation.my-consultations', compact(["consultations"]))->with('no', 1);
	}
	
	public function myConsultationsDashboard($status = "all")
		{
				$consultations = Session::get('consultations');
				$time = Session::get('consultations_time');
				$now = Carbon::now();

				
				if (!$consultations || !$time || now()->diffInMinutes($time) >= 2) {

					$input = [
						'start' => Config::get('constants.start'),
						'length' => 10,
						'status' => 'all'
					];

					$post_url = Config::get('constants.tel_api_url') . 'consultationHistory/getAllConsultations';

					$response = (new ConsultationController)->postToteleMedicine($input, $post_url);

					$consultations = $response['data'] ?? [];

					Session::put('consultations', $consultations);
					Session::put('consultations_time', now());
				}

				
				if (empty($consultations)) {
					return view('consultation.my-consultations-dashboard', [
						'consultations' => [],
						'upcomingConsultations' => []
					]);
				}

				
				$consultations = array_map(function ($item) {
					$cleanDate = str_replace(',', '', $item['whenScheduled']);
					$item['parsed_date'] = Carbon::parse($cleanDate);
					return $item;
				}, $consultations);

				
				$threeMonthsAgo = Carbon::now()->subMonths(3);

				$consultations = array_filter($consultations, function ($item) use ($threeMonthsAgo, $now) {
					return $item['parsed_date']->between($threeMonthsAgo, $now);
				});

				usort($consultations, function ($a, $b) {
					return $a['parsed_date'] <=> $b['parsed_date'];
				});

				
				$upcomingConsultations = array_filter($consultations, function ($item) use ($now) {
					return $item['parsed_date']->greaterThan($now);
				});

				return view('consultation.my-consultations-dashboard', [
					'consultations' => $consultations,
					'upcomingConsultations' => $upcomingConsultations
				]);
		} 

	/**
	 * Show the medical care consent.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function medicalCareConsent()
	{
		return view('medical-care-consent');
	}


	/**
	 * Show the information intake.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function counseling()
	{
		return view('counseling');
	}

	/**
	 * Show the information intake.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function healthcareAdvocacy()
	{
		return view('healthcare-advocacy');
	}

	/**
	 * Show the information intake.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function messageSpecialist()
	{
		$pageContents = PageContents::with('dependents')->where('page_id', "=", '19')->whereNull('parent_id')->get();
		$formatedData = [];
		foreach ($pageContents as $eachRow) {
			$formatedData[$eachRow->section_name] = [];
			$formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
			$formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
			$formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
			$formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
			$formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
		}
		return view('message-specialist', compact('formatedData'));
	}

	/**
	 * Show the information intake.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function behavioralHealth()
	{
		if(isMobile()){
			return redirect('talk-to-therapist');
		}
		return view('consultation/behavioral-health');
	}
	public function inTheMomentCare()
	{
		if(isMobile()){
			return view('mobile.consultation.in-the-moment-care');
		}
		return view('consultation/in-the-moment-care');
	}
	public function careCoordination()
	{
		if (isMobile()) {
			return view('mobile.consultation.carecoordination');
		}
		return view('consultation/carecoordination');
	}
	/**
	 * Show the dashboard
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function dashboard(Request $request)
	{
		
		if (isMobile()) {
			return redirect('mobile-dashboard');
		}
		
		$states = States::all();
		$timezones = Timezones::all();
		$user = User::find(Auth::user()->id);
		
		  // return redirect('awmi-pricing');
		if(($user->payment_status == 0 && $user->awmi_family == 1)){
		    return redirect('awmi-pricing');
		}

		$plain = Plan::where('plan_type','!=',self::ORGANIZATIONID)->get();

		$monthPlan = [];
		$totalMonth = $arrayKey = "";

		$user_name = Auth::user()->name;

		foreach($plain as $key => $value){
			if( isset($value->planType->status) && $value->planType->status ){
				if( $value->interval == 'monthly' ){
					$arrayKey = 'Monthly';
					$totalMonth = 1;
				}elseif( $value->interval == 'Quarterly' ){
					$arrayKey = 'Three-Month';
					$totalMonth = 3;
				}
				if( isset($value->member_type) ){
					if( $value->member_type == 1 ){
						$members = 'Self';
					}elseif( $value->member_type == 2 ){
						$members = 'Self + Family';
					}
					if( !empty($arrayKey) ){
						$monthPlan[$arrayKey]['uname']   = $user_name;
						$monthPlan[$arrayKey]['month']   = str_replace('-',' ',$arrayKey);
						$monthPlan[$arrayKey]['members'][$value->member_type] = $members;
						$monthPlan[$arrayKey]['plans'][str_replace(' ','-',$value->planType->name)."_".$value->planType->id] = str_replace(' ','-',$value->planType->name);
						$monthPlan[$arrayKey]['price'][str_replace(' ','-',$value->planType->name)."_".$value->planType->id][$value->member_type] = $value->toArray() + ['totalMonth' => $totalMonth];
					}
				}
			}
		}

		//pre($monthPlan,1);

		$environment = env('BTREE_ENVIRONMENT');
		$gateway = new Braintree\Gateway([
			'environment' => $environment,
			'merchantId' => env('BTREE_MERCHANT_ID'),
			'publicKey' => env('BTREE_PUBLIC_KEY'),
			'privateKey' => env('BTREE_PRIVATE_KEY')
		]);
		$clientToken = $gateway->clientToken()->generate();


		        $startDate = date('Y-m-1');
        $endDate = date('Y-m-t');
        $getGraph = $_GET['graph']??false;

        if( $getGraph  ){
            if( $_GET['graph'] == 'Week' ){
                $startDate = date('Y-m-d',strtotime('-6 Days'));
                $endDate = date('Y-m-d');
            }elseif( $_GET['graph'] == 'Year' ){
                $startDate = date('Y-1-1');
                $endDate = date('Y-12-31');
            }
        }

        $userMood = UserMood::where('user_id',Auth::user()->id)->whereBetween('emoji_date',[$startDate,$endDate])->get()->toArray();

        $currentMonthChart = [];

        foreach($userMood as $key => $value){
            /* Curernt Month Data */
            $date = removeZero(date('d',strtotime($value['emoji_date'])));

            if( $getGraph && $getGraph == 'Year' ){
                $date = removeZero(date('m',strtotime($value['emoji_date'])));
            }

            $currentMonthChart[$value['type']][$date][$value['mood']]['mood_name'] = $value['text'];
            $currentMonthChart[$value['type']][$date][$value['mood']]['mood_count'][] = $value['text'];

        }


        $physically  = chartJsData($currentMonthChart,'physically',$_GET['graph']??'');
        $emotionally = chartJsData($currentMonthChart,'emotionally',$_GET['graph']??'');

		$diffDate = strtotime(date('Y-m-d')) - strtotime(date('Y-m-d',strtotime($user['dob'])));
        $age = date('Y',$diffDate) - 1970;

		$plain = Plan::where('plan_type','!=',self::ORGANIZATIONID)->get();

    $memberType = $monthPlanDouble = [];



    foreach($plain as $key => $value){
      if( isset($value->planType->status) && $value->planType->status ){
        if( $value->interval == 'monthly' ){
          if( isset($value->member_type) ){
              if( $value->member_type == 1 ){
                            $members = 'Self';
              }elseif( $value->member_type == 2 ){
                $members = 'Self + Family';
              }
              $memberType[$value->member_type] = $members;
              $monthPlanDouble[$value->member_type][$key]['id'] = $value->id;
              $monthPlanDouble[$value->member_type][$key]['member'] = $members;
              $monthPlanDouble[$value->member_type][$key]['type'] = $value->type;
              $monthPlanDouble[$value->member_type][$key]['name'] = $value->name;
              $monthPlanDouble[$value->member_type][$key]['amount'] = $value->amount;
			  $monthPlanDouble[$value->member_type][$key]['description'] = $value->description;
			  
          }
        }
        }
      } 

	$user_final_amount = GetFinalAmountOfPayment();
	$selectedpackageservicelist = GetSelectedPackageServiceList();
		
	return view("dashboard", compact(['monthPlanDouble','memberType', 'monthPlan',"states", "user","age","timezones", "clientToken","physically","emotionally","user_final_amount","selectedpackageservicelist"]));
		//return view("dashboard", compact(["selfPlans", "states", "user", "timezones", "clientToken", "selfPlusFamilyPlans", "premiumPlans"]));
	}




	/**
	 * Show the personl record.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function personalRecord(Request $request, User $user)
	{
		try {
			$user = (!$user->id) ? Auth::user() : $user;

			$user_details = $user->user_details;
			$dependents = Auth::user()->dependents;
			$dependents = $dependents->merge(Auth::user()->parent_dependents);
			return view('health-records/personal-record', compact(['user_details', 'user', 'dependents']));
		} catch (\Exception $e) {
			return redirect('dashboard')->with('error', $e->getMessage());
		}

		// get all health records
		// $post_url = Config::get('constants.tel_api_url') . 'healthRecords/' . $user->userid;
		// $healthData = (new ConsultationController())->postToteleMedicine('', $post_url, false);
	}

	/**
	 * Show the medications
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function medications(Request $request, User $user)
	{
		$user = (!$user->id) ? Auth::user() : $user;

		$medications = $user->user_medications;
		$dependents = Auth::user()->dependents;
		$dependents = $dependents->merge(Auth::user()->parent_dependents);

		return view('health-records/medications', compact(['medications', 'dependents', 'user']));
	}

	/**
	 * Show the medication Allergies
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function medicationAllergies(Request $request, User $user)
	{

		$user = (!$user->id) ? Auth::user() : $user;

		$allergies = $user->user_allergies;
		$dependents = Auth::user()->dependents;
		$dependents = $dependents->merge(Auth::user()->parent_dependents);

		return view('health-records/medication-allergies', compact(['allergies', 'dependents', 'user']));
	}

	public function medicationAllergiesDelete(Request $request){
		$res=MedicationAllergy::find($request)->each->delete();
		 return response()->json([
        'success' => 'Record deleted successfully!'
    ]);
		//pre($request->all());

	}

	/**
	 * Show the medical history
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function medicalHistory(Request $request, User $user)
	{

		$user = (!$user->id) ? Auth::user() : $user;

		$medicalConditions = $user->user_medical_condition;
		$dependents = Auth::user()->dependents;
		$dependents = $dependents->merge(Auth::user()->parent_dependents);

		return view('health-records/medical-history', compact(['medicalConditions', 'dependents', 'user']));
	}

	/**
	 * Show the document manager.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function documentManager(Request $request, User $user)
	{
		$user = (!$user->id) ? Auth::user() : $user;

		$documents = Document::where('userid', $user->userid)->orderBy('id', 'DESC')->get();
		$dependents = Auth::user()->dependents;
		$dependents = $dependents->merge(Auth::user()->parent_dependents);
		return view('health-records/document-manager', compact(['dependents', 'user', 'documents']))->with('no', 1);
	}

	/**
	 * Show the personl popup data.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function personalPopup(User $user)
	{
		$user_details = $user->user_details;
		$html = View::make('health-records.personal-record-popup', compact(['user_details', 'user']))->render();
		return response()->json(['data' => $html]);
		// $this->load->view('health-records/personal-record', compact(['user_details']));
	}

	/**
	 * Show the medical History Popup.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function medicalHistoryPopup($condition)
	{

		$condition = MedicalCondition::where('medicalConditionId', $condition)->first();

		$html = View::make('health-records.medical-history-popup', compact(['condition']))->render();
		return response()->json(['data' => $html]);
		// $this->load->view('health-records/personal-record', compact(['user_details']));
	}

	/**
	 * Upload the document.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function uploadDocument(Request $request, User $user)
	{
		try {
			$user = (!$user->id) ? Auth::user() : $user;
			if ($files = $request->file('file')) {
				$post_url = Config::get('constants.tel_api_url') . 'attachment/add/' . $user->userid;
				$dir = public_path("uploads/documents/");
				$name = $files->getClientOriginalName();
				$file = $files->move($dir, $name);
				$filePath = $dir . $name;
				if (function_exists('curl_file_create')) {
					//Use the recommended way, creating a CURLFile object.
					$filePath = curl_file_create($filePath);
				}
				$tele_data = array(
					"AttachmentFile" => $filePath
				);
				$response = (new ConsultationController)->postToteleMedicine($tele_data, $post_url);
				if ($response['success']) {
					$model = new Document;
					$model->name = $name;
					$model->userid = $user->userid;
					$model->save();
					return redirect()->back()->with('success', 'Document uploaded successfully');
				} else {
					return redirect()->back()->with('error', $response['message']);
				}
			}
		} catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Document  $document
	 * @return \Illuminate\Http\Response
	 */
	public function deleteDocument(Request $request, Document $document)
	{
		try {
			$document->delete();
			$destinationPath = public_path("uploads/documents/");
			File::delete($destinationPath . $document->name);
			return redirect()->back()->with('success', 'Document deleted successfully');
		} catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	/**
	 * Show the my pet consultations.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */


	 public function MobileUserDashboard(Request $request) {
		$user = Auth::user();
		$today = Carbon::today();
		$GetHealthRecordProcessBarPercentage = GetHealthRecordProcessBarPercentage();
		$mypackageservicelist = GetMyPackageServiceList();
		
		$nextId = "0";
		if($user->last_affirmation_date!=$today) {
			$nextId = getAffirmationID($user);
			$user->affirmation_id = $nextId;
			$user->last_affirmation_date = $today;
			$user->save();
		}	
	
		$affirmation = Affirmation::find($user->affirmation_id);  
		return view("mobile.dashboard",compact('GetHealthRecordProcessBarPercentage','mypackageservicelist','affirmation'));

	 }
	 public function MobileUserSettingProfile(Request $request) {

		return view("mobile.setting-profile");

	 }
	 public function MobileUserSetting(Request $request) {
		return view("mobile.mobile-setting");
	 }
	 public function WhatIsMood(Request $request){
		if (isMobile()) {
			return view("mobile.what-is-mood");
		}
		return view("services.moods.whatAreEmo");
	 }
	 public function MyMoodFeelingHistory(Request $request) {
		return view("mobile.my-mood-feeling-history");
	 }
	// setup pages for mobile views 
	public function MobileUserPlans(Request $request)  {
		$states = States::all();
		$timezones = Timezones::all();
		$user = User::find(Auth::user()->id);

		if (!isMobile()) {
			return redirect('dashboard');
		}
		
		  // return redirect('awmi-pricing');
		if(($user->payment_status == 0 && $user->awmi_family == 1)){
		    return redirect('awmi-pricing');
		}

		$plain = Plan::where('plan_type','!=',self::ORGANIZATIONID)->get();

		$monthPlan = [];
		$totalMonth = $arrayKey = "";

		$user_name = Auth::user()->name;

		foreach($plain as $key => $value){
			if( isset($value->planType->status) && $value->planType->status ){
				if( $value->interval == 'monthly' ){
					$arrayKey = 'Monthly';
					$totalMonth = 1;
				}elseif( $value->interval == 'Quarterly' ){
					$arrayKey = 'Three-Month';
					$totalMonth = 3;
				}
				if( isset($value->member_type) ){
					if( $value->member_type == 1 ){
						$members = 'Self';
					}elseif( $value->member_type == 2 ){
						$members = 'Self + Family';
					}
					if( !empty($arrayKey) ){
						$monthPlan[$arrayKey]['uname']   = $user_name;
						$monthPlan[$arrayKey]['month']   = str_replace('-',' ',$arrayKey);
						$monthPlan[$arrayKey]['members'][$value->member_type] = $members;
						$monthPlan[$arrayKey]['plans'][str_replace(' ','-',$value->planType->name)."_".$value->planType->id] = str_replace(' ','-',$value->planType->name);
						$monthPlan[$arrayKey]['price'][str_replace(' ','-',$value->planType->name)."_".$value->planType->id][$value->member_type] = $value->toArray() + ['totalMonth' => $totalMonth];
					}
				}
			}
		}

		//pre($monthPlan,1);

		$environment = env('BTREE_ENVIRONMENT');
		$gateway = new Braintree\Gateway([
			'environment' => $environment,
			'merchantId' => env('BTREE_MERCHANT_ID'),
			'publicKey' => env('BTREE_PUBLIC_KEY'),
			'privateKey' => env('BTREE_PRIVATE_KEY')
		]);
		
		
		try {
			$clientToken = $gateway->clientToken()->generate();
		} catch (\Exception $e) {
			\Log::error('Braintree Client Token Error: ' . $e->getMessage());
			$clientToken = '';
		}
		


		        $startDate = date('Y-m-1');
        $endDate = date('Y-m-t');
        $getGraph = $_GET['graph']??false;

        if( $getGraph  ){
            if( $_GET['graph'] == 'Week' ){
                $startDate = date('Y-m-d',strtotime('-6 Days'));
                $endDate = date('Y-m-d');
            }elseif( $_GET['graph'] == 'Year' ){
                $startDate = date('Y-1-1');
                $endDate = date('Y-12-31');
            }
        }

        $userMood = UserMood::where('user_id',Auth::user()->id)->whereBetween('emoji_date',[$startDate,$endDate])->get()->toArray();

        $currentMonthChart = [];

        foreach($userMood as $key => $value){
            /* Curernt Month Data */
            $date = removeZero(date('d',strtotime($value['emoji_date'])));

            if( $getGraph && $getGraph == 'Year' ){
                $date = removeZero(date('m',strtotime($value['emoji_date'])));
            }

            $currentMonthChart[$value['type']][$date][$value['mood']]['mood_name'] = $value['text'];
            $currentMonthChart[$value['type']][$date][$value['mood']]['mood_count'][] = $value['text'];

        }


        $physically  = chartJsData($currentMonthChart,'physically',$_GET['graph']??'');
        $emotionally = chartJsData($currentMonthChart,'emotionally',$_GET['graph']??'');

		$diffDate = strtotime(date('Y-m-d')) - strtotime(date('Y-m-d',strtotime($user['dob'])));
        $age = date('Y',$diffDate) - 1970;

		$plain = Plan::where('plan_type','!=',self::ORGANIZATIONID)->get();

    $memberType = $monthPlanDouble = [];



    foreach($plain as $key => $value){
      if( isset($value->planType->status) && $value->planType->status ){
		  
			if( $value->interval == 'monthly' or $value->interval == 'four-month-package' or $value->interval == 'yearly' ){
				
			  if( isset($value->member_type) ){
				  
				  if($value->member_type == 1 ){
					$members = 'Self';
				  } elseif( $value->member_type == 2 ){
					$members = 'Self + Family';
				  } elseif( $value->member_type == 3 ){
					$members = '4 Month';
				  } elseif( $value->member_type == 4 ){
					$members = '12 Month';
				  }
				  
				  $memberType[$value->member_type] = $members;
				  $monthPlanDouble[$value->member_type][$key]['id'] = $value->id;
				  $monthPlanDouble[$value->member_type][$key]['member'] = $members;
				  $monthPlanDouble[$value->member_type][$key]['type'] = $value->type;
				  $monthPlanDouble[$value->member_type][$key]['name'] = $value->name;
				  $monthPlanDouble[$value->member_type][$key]['amount'] = $value->amount;
				  $monthPlanDouble[$value->member_type][$key]['description'] = $value->description;
			  }
			}
		
        }
      } 
	  	$user_final_amount = GetFinalAmountOfPayment();
	  	$selectedpackageservicelist = GetSelectedPackageServiceList();
		
		
		return view("mobile/plan", compact(['monthPlanDouble','memberType', 'monthPlan',"states", "user","age","timezones", "clientToken","physically","emotionally","user_final_amount","selectedpackageservicelist"]));
		//return view("dashboard", compact(["selfPlans", "states", "user", "timezones", "clientToken", "selfPlusFamilyPlans", "premiumPlans"]));
	}

	public function MobileUserOnBoard(Request $request) {
		if (!isMobile()) {
			return redirect('dashboard');
		}
		return view("mobile.onboard");
	}
	public function printOut(Request $request) {
	
		$data = [];
		$consultation_id = $request->consultation_id;
		$input['consultId'] = $consultation_id;
		$post_url = Config::get('constants.tel_api_url') . 'consultationHistory/getAllConsultations';
		$response = (new ConsultationController)->postToteleMedicine($input, $post_url);
		$consultations = @$response['data'];	
		return view("consultation.printOut",compact('consultations'));
	}
	public function saveOnBoard(Request $request){

		try {
			if(!Auth::user()->id){
				throw new Exception("Please login first");
			}
			$id = Auth::user()->id;
			$user = User::find($id);
			$user->onboard = '1';
			$user->save(); /* */
			
			return response()->json(['message' => 'OnBoard updated successfully']);

		} catch (\Exception $e) {
			return response()->json(['message' =>  $e->getMessage()]);
        }

	}

}
