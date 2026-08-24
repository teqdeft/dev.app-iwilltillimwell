<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use App\Models\User;
use App\Models\Affirmation;
use App\Interfaces\CommonConstants;
use App\Models\States;
use App\Models\Timezones;
use App\Models\UserMeta;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller implements CommonConstants
{
    public function index(Request $request) {
		
		if(ismobile()){
			return redirect()->to(url('/mobile-dashboard'));
		}
		$user = Auth::user();
		$today = Carbon::today();
	
		$GetHealthRecordProcessBarPercentage = GetHealthRecordProcessBarPercentage('web-dashboard');
		$mypackageservicelist = GetMyPackageServiceList();
		$dependents = Auth::user()->dependents;
		$user_details = Auth::user()->user_details;
		$user_medications = Auth::user()->user_medications; 
		$user_pharmcay = Auth::user()->user_pharmcay; 
        $dependents = $dependents->merge(Auth::user()->parent_dependents);
		
		$plan = Plan::where('plan_type','!=',self::ORGANIZATIONID)->get();
		// Landing-promo campaign (e.g. ?promo=NABV000): show only the allowed plans.
		$plan = filterPlansForLandingPromo($plan);
		$user = User::find(Auth::user()->id);
		$timezones = Timezones::all();
		$states = States::all();
		
			   
		$medicalconsent_exists = UserMeta::where('user_id', Auth::user()->id)
                  ->where('meta_key', 'type')
                  ->where('meta_value', 'medical-consent')
                  ->exists();		   
		
		$nextId = "0";
		if($user->last_affirmation_date!=$today) {
			$nextId = getAffirmationID($user);
			$user->affirmation_id = $nextId;
			$user->last_affirmation_date = $today;
			$user->save();
		}	
	
		$affirmation = Affirmation::find($user->affirmation_id);
	
		return view("user.dashboard",compact('GetHealthRecordProcessBarPercentage','mypackageservicelist','dependents','user_details','user_medications','user_pharmcay','plan','user','timezones','states','medicalconsent_exists','affirmation'));
		
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
	
    public function prescriptions(Request $request) {
		
		try {
			$clientToken = $this->gateway()->clientToken()->generate();
		} catch (\Exception $e) {
			\Log::error('Braintree Client Token Error: ' . $e->getMessage());
			$clientToken = '';
		}
	
		if(ismobile()){
			return view("user.mobile.prescriptions.index", compact('clientToken'));
		}
			   	   
		return view("user.prescriptions.index", compact('clientToken'));
		
	}
    public function semaglutide(Request $request) {
		
		try {
			$clientToken = $this->gateway()->clientToken()->generate();
		} catch (\Exception $e) {
			\Log::error('Braintree Client Token Error: ' . $e->getMessage());
			$clientToken = '';
		}
	
		if(ismobile()){
			return view("user.mobile.semaglutide", compact('clientToken'));
		}
			   	   
		return view("user.semaglutide", compact('clientToken'));
		
	}
	
	public function prescriptionsPayment(Request $request) {
		
	
		$amount = $request->pay_amount;
		
		 $gateway = new \Braintree\Gateway([
			'environment' => env('BTREE_ENVIRONMENT'),
			'merchantId' => env('BTREE_MERCHANT_ID'),
			'publicKey' =>env('BTREE_PUBLIC_KEY'),
			'privateKey' =>env('BTREE_PRIVATE_KEY'),
		]);

		$result = $gateway->transaction()->sale([
			'amount' => $amount,
			'paymentMethodNonce' => $request->input('payment_method_nonce'),
			'options' => [
				'submitForSettlement' => true
			]
		]);

		if ($result->success) {
			return redirect()->back()->with('success', 'Payment successful!');
		} else {
			return redirect()->back()->with('error', $result->message);
		} 
		
		
		
	}
	
	public function profileImgDeleted(Request $request){
		
		$user = User::find($request->id);
		if($user) {
			if(!empty($user->profile_image)) {
					$imagePath = public_path('profiles/' . $user->profile_image);
					if (file_exists($imagePath)) {
						unlink($imagePath); 
					}
				$user->profile_image = null;
				$user->save();
				
				return response()->json([
					'success' => true,
					'message' => 'Profile image deleted successfully.'
				]);
			}
		}
		return response()->json([
					'success' => false,
					'message' => 'User not found'
				], 404);
				
	}
	
	public function searchMedicationDashboard(Request $request) {
		
		$keyword = $request->get('keyword', '');
		$data = DB::table('prescription_medical')
			->where('medical_name', 'LIKE', "%{$keyword}%")
			->select('id', 'medical_name', 'prescription_section')
			->orderBy('medical_name', 'ASC')
			->limit(20)
			->get();

		return response()->json([
			'data' => $data
		]);
		
	}
	
	public function updateAcknowledge(Request $request) {
		
		UserMeta::CustomeUpdateInsert('dashboard-acknowledge','yes');
	}
	public function getNextAffirmation(Request $request)
	{
		$user = auth()->user();

		$nextId = getAffirmationID($user);

		if($nextId){
			$user->affirmation_id = $nextId;
			$user->save();
		}

		$affirmation = Affirmation::find($user->affirmation_id);

		return response()->json([
			'message' => $affirmation->message ?? ''
		]);
	}
}
