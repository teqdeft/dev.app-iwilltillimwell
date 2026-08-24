<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Stripe\StripeClient;
use Laravel\Cashier\PaymentMethod;
use Illuminate\Support\Facades\Mail;

use App\Traits\ApiResponse;
use App\Models\User;
use App\Mail\UserRegister;
use App\Models\Promocode;
use App\Models\CommissionTransaction;
use App\Models\Plan;
use App\Models\BraintreeTransaction;

use Auth;
use Stripe;
use Config;
use App\Http\Controllers\ConsultationController;
use App\Models\UserMeta;
use Carbon\Carbon;
use Braintree;
use DB;
use Braintree\Gateway;
use Illuminate\Support\Facades\Http;
use App\Mail\OrderPurchasedMail;




class SubscriptionController extends Controller
{
	use ApiResponse;

	public function __construct()
	{
		$this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
		//
	}

	public function index(Request $request)
	{

		$user = Auth::user();

		// if ($user->subscribed(self::MONTHLY_PLAN) || $user->subscribed(self::YEARLY_PLAN)){ return redirect("dashboard"); }
		$plans = $this->stripe->plans->all();
		$intent = $user->createSetupIntent();
		return view("subscription", compact("plans", "intent"));
	}

	/**
	 * handling payment with POST
	 */
	public function handlePost(Request $request)
	{
		try {
			$input = $request->all();
			$input['step4_email'] = (isset($input['step4_email']) && !empty($input['step4_email'])) ? $input['step4_email'] : $request->user()->email;

			$user = User::where('email', $input['step4_email'])->first();

			/* if ((@$user->payment_status == Config::get('constants.payment_complete')) || !empty(Auth::user()->subscriptions->toArray())) {
    			$request->session()->flash('error', 'You have already subscribed to plan.');
    			return redirect("/dashboard");
    		}   */

			$paymentMethodId = $input['payment_method'];
			$user->createOrGetStripeCustomer();
			$paymentMethod = $user->addPaymentMethod($paymentMethodId);
			$plan = (isset($input['plan_id']) && !empty($input['plan_id'])) ? $input['plan_id'] : $user->stripe_planid;
			$planDetails = $this->stripe->plans->retrieve($plan, []);
			$planName = (isset($input['plan_name']) && !empty($input['plan_name'])) ? $input['plan_name'] : $planDetails->nickname;
			try {
				if (!empty($user->promo_code_id)) {
					$promoCode = Promocode::where('id', $user->promo_code_id)->first();
					$subscription = $user->newSubscription($planName, $plan)->withCoupon($promoCode->stripe_id)->create($paymentMethodId, [
						'email' => $user->email
					]);

					// Influencer commission amount
					$influencerDetails = User::where('id', $promoCode->influencer_id)->first();
					$influencerType = (!empty($influencerDetails->organization_id)) ? "organization" : "individual";
					$model = new CommissionTransaction;
					$model->promo_code_id = $promoCode->id;
					$model->member_id = $user->id;
					$model->influencer_type = $influencerType;
					$model->influencer_id = $promoCode->influencer_id;
					// Influencer Amount //
					$influencer_commission = $promoCode->influencer_commission_type == "fixed" ? $promoCode->influencer_commission_amount	 : ($planDetails->amount * $promoCode->influencer_commission_amount	 / 100);

					$model->influencer_payable_amount += $influencer_commission;
					$data = $model->save();
				} else {
					$subscription = $user->newSubscription($planName, $plan)->create($paymentMethodId, [
						'email' => $user->email
					]);
				}

				$planInterval = $planDetails->interval_count;
				$subscription->ends_at = Carbon::now()->addMonths($planInterval);
				$subscription->save();

				$user->payment_status = Config::get('constants.payment_complete');
				$user->save();

				//return redirect("/dashboard");
				//Save Data on Tele Medicine
				/* $result = (new ConsultationController)->storeGeneralInfo($user);
    			if ($result['success']) {
    				return redirect("/dashboard");
    			} else {
    				if(isset($result['detail']['userid'])) {
    					$userData = User::find($user->id);
    					$userData->userid = $result['detail']['userid'];
    					$userData->save();
    				}
    				return redirect()->back()->with('error', $result['message']);
    			} */
			} catch (\Exception $e) {
				return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
			}
		} catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function createPlan(Request $request)
	{
		echo "nothing here";
		die;
		// To created plans here
		// $createPlan = $this->stripe->plans->create([
		// 	'amount' => 4999,
		// 	'currency' => 'usd',
		// 	'interval' => 'month',
		// 	'nickname' => 'Monthly self full plan',
		// 	'product' => 'prod_JSiXyksua7F8nL',
		// ]);

		// $createPlan = $this->stripe->plans->create([
		// 	'amount' => 5999,
		// 	'currency' => 'usd',
		// 	'interval' => 'month',
		// 	'nickname' => 'Monthly family full plan',
		// 	'product' => 'prod_JSiXyksua7F8nL',
		// ]);

		// $createPlan = $this->stripe->plans->create([
		// 	'amount' => 799,
		// 	'currency' => 'usd',
		// 	'interval' => 'month',
		// 	'nickname' => 'Monthly Plan',
		// 	'product' => 'prod_IvNweZ7tDPzZrd',
		// ]);
		// $getPlan = $stripe->plans->retrieve('prod_IiN2clnjIseNwO');
		// $plans = Cashier::plans("price_1I6wHYKAVM23nplgnR2DXJc9");

		preprint($this->successResponse([
			"data" => $createPlan,
		]));
	}

	public function createDiscount()
	{
		// To create discount here
		$createDiscount = $this->stripe->coupons->create([
			"duration" => "repeating",
			"duration_in_months" => 1,
			"max_redemptions" => 10,
			"name" => "25.5% off",
			"percent_off" => 25.5
		]);
		prePrint($createDiscount);
	}

	// Apply Promo Code
	public function applyPromoCode(Request $request)
	{
		try {
			$input = $request->all();
			$promoCode = $input['promoCode'];
			$getPromo = Promocode::where('code', $promoCode)->first();
			$getTotalUsedPromoCodes = User::where('promo_code_id', $getPromo->id)->count();
			if ($getPromo && $getPromo->valid_to >= date('Y-m-d') && $getTotalUsedPromoCodes < $getPromo->allowed_members && $getPromo->valid_from <= date('Y-m-d')) {
				echo json_encode($this->successResponse([
					"status" => true,
					"data" => $getPromo,
					"message" => "This code is valid"
				]));
				die;
			} else {
				echo json_encode($this->failResponse([
					"status" => false,
					"message" => "This code is not valid"
				]));
				die;
			}
		} catch (\Exception $e) {
			echo json_encode($this->failResponse([
				"message" => $e->getMessage(),
			], 500));
			die;
		}
	}

	/**
	 * handling payment with POST
	 */
	public function handleBraintreePayments(Request $request)
	{
		try {
			
			$input = $request->all();
			$pro_rata_days = 0;
			$pro_rata_amount = 0;
			$response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
				'secret'   => env('RECAPTCHA_SECRET_KEY'),
				'response' => $request->input('g-recaptcha-response'),
				'remoteip' => $request->ip(),
			]);

			if (!$response->json('success')) {
				
				
				return back()
					->withErrors(['g-recaptcha-response' => 'reCAPTCHA failed. Please try again.'])
					->withInput()
					->with('g-recaptcha-response', 'false');
			}

			try {
				$user = Auth::user();
				
				
				
				$environment = env('BTREE_ENVIRONMENT');
				$gateway = new Braintree\Gateway([
					'environment' => $environment,
					'merchantId' => env('BTREE_MERCHANT_ID'),
					'publicKey' => env('BTREE_PUBLIC_KEY'),
					'privateKey' => env('BTREE_PRIVATE_KEY')
				]);

				$nonceFromTheClient = $input["payment_method_nonce"];

				$plan = $input["plan"] ? $input["plan"] : $user->plan;

				$planDetails = Plan::where('id', $plan)->first();
				
				$package_service_list =  GetSelectedPackageServiceList();
				$optional_service = GetPackageOptionalService();
				$optional_amount = GetPackageOptionalAmount();
				$bundle_id  	= GetPackageOptionalBundleID();
				$commission_rate = 0;
				$commission_amount = 0;
				$customer_id = 0;
				if ($user->braintree_customer_id) {
					$customer_id = $user->braintree_customer_id;
				} else {
					$result = $gateway->customer()->create([
						'id' => $user->id,
						'firstName' => $user->fname,
						'lastName' => $user->lname,
						'email' => $user->email
					]);
				
					if ($result->success) {
						$customer_id = $result->customer->id;
					}else{
					    
					   // dd($result->params["customer"]["id"]);
					    if(strpos($result->message ,"Customer ID has already been taken.") !== false){
					        	$customer_id = $result->params["customer"]["id"];
					    }
					}
				}
                
				$final_amount = NULL;
				$braintree_amount = $final_amount = $planDetails->amount;
				if ($user->promo_code_id) {
					$promoDetails = Promocode::where('id', $user->promo_code_id)->first();
					$discount_amount = $promoDetails->member_discount_type == "fixed" ? $promoDetails->member_discount_amount :  round(($planDetails->amount * $promoDetails->member_discount_amount / 100), 2);
					$final_amount = round(($planDetails->amount - $discount_amount), 2);
					$braintree_amount = $final_amount;
				}
				
				if($optional_amount) {
					$braintree_amount += $optional_amount;
					$final_amount += $optional_amount;
				}
				
				// Old Transaction of brain tree Start

				// if ($braintree_amount > 0) {
				// 	$payment_result = $gateway->transaction()->sale([
				// 		'amount' => $braintree_amount,
				// 		'customerId' => $customer_id,
				// 		'paymentMethodNonce' => $nonceFromTheClient,
				// 		'options' => [
				// 			'submitForSettlement' => True
				// 		]
				// 	]);

				// 	if(!$payment_result->success) {
				// 		$request->session()->flash("error", "Please check your card details it doesn't seems to be valid");
				// 		return redirect("/dashboard");
				// 	}
				// }
				
				// Old Braintree Transaction End
				
				// New Code Start
				
    			$result = $gateway->creditCard()->create([
                    'customerId' => $customer_id,
                    'number' => $input['card_number'],
                    'expirationDate' => $input['exp_month'].'/'.$input['exp_year'],
                    'cvv' => $input['ccv']
                ]);
                
                if($result->success){
                        $res = DB::table('card_details')->insert([
                          'user_id' =>  $user->id,
                          'last_4_digit' => $result->creditCard->maskedNumber,
                          'exp_month'=>$result->creditCard->expirationMonth,
                          'exp_year'=>$result->creditCard->expirationYear,
                          'card_id' => $result->creditCard->uniqueNumberIdentifier,
                          'token' => $result->creditCard->token,
                          'card_status' => 'default',
                          'created_at' => date("Y-m-d H:i:s")
                        ]);

                }else{
                   if(!$result->success) {
					   
					   return redirect()->back()->with("error", "Please check your card details, it doesn't seem to be valid.");
					   
						/* $request->session()->flash("error", "Please check your card details it doesn't seems to be valid");
						return redirect("/dashboard"); */
						
					}
                }
				
				$extraDays = config('constants.add_extra_days');
				
				$payment_date = date('Y-m-d H:i:s',strtotime("+{$extraDays} days"));
			
				$pro_rata_days = 0;
				$pro_rata_amount = 0;
				if(config('constants.pro_data_status') === 'active') {
					$billing_info = getFirstBillingDetails($payment_date,$final_amount);
					$pro_rata_days = $billing_info['extra_days'];
					$pro_rata_amount = $billing_info['extra_amount'];
				}
				
				$braintree_amount = $braintree_amount + $pro_rata_amount;
                
                if ($braintree_amount > 0) {
                    $payment_result = $gateway->transaction()->sale([
        				'amount' => $braintree_amount,
        				'customerId' => $customer_id,
        				'options' => ['submitForSettlement' => True]
        			]);
        			
        			if(!$payment_result->success) {
						$request->session()->flash("error", "Please check your card details it doesn't seems to be valid");
						return redirect("/dashboard");
					}
                }
				// New Code End
				
				$user->payment_status = Config::get('constants.payment_complete');
				$user->auto_renewal = 1;
				$user->braintree_customer_id = $customer_id;
				$user->bundle_id = $bundle_id;
				$user->expiry_date = get_payment_expiry_date($planDetails->interval);
				if(empty($user->activation_date)) {
					$user->activation_date = date('Y-m-d H:i:s');
				}
				
				if( isset($input['upgradePlan'])) {
					$user->plan = $input['plan'];
				}
				$user->save();

				$final_amount = $promo_code_amount = NULL;
				if ($user->promo_code_id) {
					$promoDetails = Promocode::where('id', $user->promo_code_id)->first();
					$discount_amount = $promoDetails->member_discount_type == "fixed" ? $promoDetails->member_discount_amount :  round(($planDetails->amount * $promoDetails->member_discount_amount / 100), 2);
					$final_amount = round(($planDetails->amount - $discount_amount), 2);
					$promo_code_amount = $discount_amount;
					
					
					$commission_rate = getCommissionInfulantionerRate($promoDetails->influencer_id);
					

					// Influencer commission amount
					$influencerDetails = User::where('id', $promoDetails->influencer_id)->first();
					$influencerType = (!empty($influencerDetails->organization_id)) ? "organization" : "individual";
					$model = new CommissionTransaction;
					$model->promo_code_id = $promoDetails->id;
					$model->member_id = $user->id;
					$model->influencer_type = $influencerType;
					$model->influencer_id = $promoDetails->influencer_id;

					// Influencer Amount //
					$influencer_commission = $promoDetails->influencer_commission_type == "fixed" ? $promoDetails->influencer_commission_amount	 : ($final_amount * $promoDetails->influencer_commission_amount	 / 100);

					$model->influencer_payable_amount = $influencer_commission;
					if( $promoDetails->valid_from <= date('Y-m-d') &&  $promoDetails->valid_to >= date('Y-m-d') ){
						$data = $model->save();
					}
				} else {
					$final_amount = $planDetails->amount;
				}
				
				
				
				
				
				$activation_type = "activation";
				// Create Subscription start
				$userSubscription = DB::table('braintree_subscription')->where('user_id', $user->id)->first();
                if($userSubscription) {
                    DB::table('braintree_subscription')->where('user_id', $user->id)->update(['subscription_status' => 'canceled']);
					$activation_type = "upgrade";
                }
                
				
				$subscription_type = GetUserMetaWithMetaKey("plan_tab",$user->id);
				if($subscription_type=="self" or $subscription_type=="self-family") {
					$subscription_type = 'monthly';
				}
				
				$final_amount = $final_amount+$optional_amount+$pro_rata_amount;
				
				
				$commission_amount = ($final_amount)*$commission_rate/100;
				
				$payment_date = date('Y-m-d H:i:s');
				
				
				

			    $res = DB::table('braintree_subscription')->insert([
                  'user_id' =>  $user->id,
                  'plan_id' => $planDetails->id,
                  'amount'=>$planDetails->amount,
                  'pro_rata_days'=>$pro_rata_days,
                  'pro_rata_amount'=>$pro_rata_amount,
                  'final_amount'=>$final_amount,
                  'promo_code_id'=>$user->promo_code_id,
                  'promo_code_value' => $promo_code_amount,
				  'package_service_list' => $package_service_list,
				  'optional_service' => $optional_service,
				  'optional_amount' => $optional_amount,
				  'activation_type' => $activation_type,
				  'bundle_id'  => $bundle_id,
				  'commission_rate'  => $commission_rate,
				  'commission_amount'  => $commission_amount,
                  'subscription_start_date' => date("Y-m-d"),
                  'subscription_end_date' => get_payment_expiry_date($planDetails->interval),
                  'auto_renewal' => '1',
                  'subscription_type' => $subscription_type,
                  'terms_accepted' => true,
                  'terms_accepted_at' => now(),
                  'subscription_status' => 'active',
                  'created_at' => date("Y-m-d H:i:s")
                ]);
			   //Create Subscription End

				// save braintree transactions
				$transaction = new BraintreeTransaction;
				$transaction->user_id = $user->id;
				$transaction->plan_id = $planDetails->id;
				$transaction->amount = $planDetails->amount;
				$transaction->status = $final_amount ? $payment_result->transaction->status :  "Settled";
				$transaction->transaction_id = $final_amount ? $payment_result->transaction->id : "nil";
				$transaction->final_amount = $final_amount;
				$transaction->promo_code_id = $user->promo_code_id;
				$transaction->promo_code_amount = $promo_code_amount;
				$transaction_result = $transaction->save();

				$this->SaveUtmSocialPlatformData();
				
				
				$order['user_name']=$user->fname??'John';
				$order['packag_name']=$planDetails->name??'Basic';
				$order['package_price']=$planDetails->amount??'100';
				$order['optional_amount']=$optional_amount??'10';
				$order['package_purchase_date'] = Carbon::now()->format('F j, Y');
				$order['package_purchase_time'] = Carbon::now()->format('g:i A');
				$order['subscription_start_date'] = date("Y-m-d");
				$order['subscription_end_date']   = date("Y-m-d",strtotime(get_payment_expiry_date($planDetails->interval)));
				Mail::to("teqdeft@gmail.com")->send(new OrderPurchasedMail($order)); 


			
				// Save Data on Tele Medicine
				if(!empty($user->userid)) {
				    	$plan = Plan::where('id',$planDetails->id)->first();
    					if(isset($input['upgradePlan'])){
    						activityLog("Upgrade plan from {$plan->type} ({$plan->name})",$user,'select-plan',false);
    						return redirect()->back()->with('success','Your plan successfuly upgrade.');
    					}else{
    						activityLog("Select {$plan->type} plan for {$plan->name}",$user,'select-plan',false);
    						$request->session()->flash("success", "Your plan ({$plan->name}) successfuly added");
							if(isMobile()){
								return redirect("/mobile-dashboard");
							}
    						return redirect("/dashboard");
    					}
				} else {
				    $result = (new ConsultationController)->storeGeneralInfo($user);

				
				if ($result && isset($result['success'])) {
					(new ConsultationController)->setMemberSession($user);
					$plan = Plan::where('id',$planDetails->id)->first();
					if (isset($input['upgradePlan'])) {
						activityLog("Upgrade plan from {$plan->type} ({$plan->name})",$user,'select-plan',false);
						return redirect()->back()->with('success','Your plan successfuly upgrade.');
					} else {
						activityLog("Select {$plan->type} plan for {$plan->name}",$user,'select-plan',false);
						$request->session()->flash("success", "Your plan ({$plan->name}) successfuly added");
						if(isMobile()){
							return redirect("/mobile-dashboard");
						}
						return redirect("/dashboard");
					}
    			} else {
    				if(isset($result['detail']['userid'])) {
						(new ConsultationController)->setMemberSession($user);
    					$userData = User::find($user->id);
    					$userData->userid = (String) $result['detail']['userid'];
    					$userData->save();
    				}

					if (is_array($result) && isset($result['message'])) {
						$message = $result['message'];
					} else {
						$message = $result;
					}
    				return redirect()->back()->with('error', $message);
    			}
				    
				}
				
			} catch (\Exception $e) {
			 //   dd($e->getMessage());
				return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
			}
		} catch (\Exception $e) {
		      //  dd($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}
	
	public function freeTrailSubscription(Request $request) {
		
	
		try {
			
			
			$input = $request->all();
			$pro_rata_days = 0;
			$pro_rata_amount = 0;
			
			try {
				
				
				$user = Auth::user();
	
				$plan = $user->plan;

				$planDetails = Plan::where('id', $plan)->first();
				
				$package_service_list =  GetSelectedPackageServiceList();
				$optional_service = GetPackageOptionalService();
				$optional_amount = GetPackageOptionalAmount();
				$bundle_id  	= GetPackageOptionalBundleID();
				$commission_rate = 0;
				$commission_amount = 0;
				$customer_id = 0;
				
                
				$final_amount = NULL;
				$braintree_amount = $final_amount = $planDetails->amount;
				if($user->promo_code_id) {
					$promoDetails = Promocode::where('id', $user->promo_code_id)->first();
					$discount_amount = $promoDetails->member_discount_type == "fixed" ? $promoDetails->member_discount_amount :  round(($planDetails->amount * $promoDetails->member_discount_amount / 100), 2);
					$final_amount = round(($planDetails->amount - $discount_amount), 2);
					$braintree_amount = $final_amount;
				}
				if($optional_amount) {
					$braintree_amount += $optional_amount;
					$final_amount += $optional_amount;
				}

				$extraDays = config('constants.add_extra_days');
				$payment_date = date('Y-m-d H:i:s',strtotime("+{$extraDays} days"));
			
				$pro_rata_days = 0;
				$pro_rata_amount = 0;
				
				
				$braintree_amount = $braintree_amount + $pro_rata_amount;
				
				
				
				
				$user->payment_status = Config::get('constants.payment_complete');
				$user->auto_renewal = 1;
				$user->braintree_customer_id = $customer_id;
				$user->bundle_id = $bundle_id??'0';
				$user->expiry_date = get_payment_expiry_date($planDetails->interval);
				
				$user->save();


				$final_amount = $promo_code_amount = NULL;
				if ($user->promo_code_id) {
					
				} else {
					$final_amount = $planDetails->amount;
				}
				$final_amount = $planDetails->amount;
				
				
			
				
				
				$activation_type = "activation";
				
				$userSubscription = DB::table('braintree_subscription')->where('user_id', $user->id)->first();
                if($userSubscription) {
                    DB::table('braintree_subscription')->where('user_id', $user->id)->update(['subscription_status' => 'canceled']);
					$activation_type = "upgrade";
                }
                
				
				$subscription_type = GetUserMetaWithMetaKey("plan_tab",$user->id);
				if($subscription_type=="self" or $subscription_type=="self-family") {
					$subscription_type = 'monthly';
				}
				
				$final_amount = $final_amount+$optional_amount+$pro_rata_amount;
				
				
				$commission_amount = ($final_amount)*$commission_rate/100;
				
				$payment_date = date('Y-m-d H:i:s');
				
				
				

			    $res = DB::table('braintree_subscription')->insert([
                  'user_id' =>  $user->id,
                  'plan_id' => $planDetails->id,
                  'amount'=>$planDetails->amount,
                  'pro_rata_days'=>$pro_rata_days,
                  'pro_rata_amount'=>$pro_rata_amount,
                  'final_amount'=>$final_amount,
                  'promo_code_id'=>$user->promo_code_id,
                  'promo_code_value' => $promo_code_amount,
				  'package_service_list' => $package_service_list,
				  'optional_service' => $optional_service,
				  'optional_amount' => $optional_amount,
				  'activation_type' => $activation_type,
				  'bundle_id'  => $bundle_id,
				  'commission_rate'  => $commission_rate,
				  'commission_amount'  => $commission_amount,
                  'subscription_start_date' => date("Y-m-d"),
                  'subscription_end_date' => get_payment_expiry_date($planDetails->interval),
                  'auto_renewal' => '1',
                  'subscription_type' => $subscription_type,
                  'terms_accepted' => true,
                  'terms_accepted_at' => now(),
                  'subscription_status' => 'active',
                  'free_trial_days' => '30',
                  'created_at' => date("Y-m-d H:i:s")
                ]);
			   
				$transaction = new BraintreeTransaction;
				$transaction->user_id = $user->id;
				$transaction->plan_id = $planDetails->id;
				$transaction->amount = $planDetails->amount;
				$transaction->status = "Settled";
				$transaction->transaction_id = "nil";
				$transaction->final_amount = $final_amount;
				$transaction->promo_code_id = $user->promo_code_id;
				$transaction->promo_code_amount = $promo_code_amount;
				$transaction_result = $transaction->save();

				$this->SaveUtmSocialPlatformData();
				
				
				$order['user_name']=$user->fname??'John';
				$order['packag_name']=$planDetails->name??'Basic';
				$order['package_price']=$planDetails->amount??'100';
				$order['optional_amount']=$optional_amount??'10';
				$order['package_purchase_date'] = Carbon::now()->format('F j, Y');
				$order['package_purchase_time'] = Carbon::now()->format('g:i A');
				$order['subscription_start_date'] = date("Y-m-d");
				$order['subscription_end_date']   = date("Y-m-d",strtotime(get_payment_expiry_date($planDetails->interval)));
				Mail::to("teqdeft@gmail.com")->send(new OrderPurchasedMail($order)); 
				$result = (new ConsultationController)->storeGeneralInfo($user);
				$response = (new ConsultationController())->setMemberSession($user);


				


				if($result && isset($result['success'])) {
						(new ConsultationController)->setMemberSession($user);
						$plan = Plan::where('id',$planDetails->id)->first();
						if (isset($input['upgradePlan'])) {
							activityLog("Upgrade plan from {$plan->type} ({$plan->name})",$user,'select-plan',false);
							return redirect()->back()->with('success','Your plan successfuly upgrade.');
						} else {
							activityLog("Select {$plan->type} plan for {$plan->name}",$user,'select-plan',false);
							$request->session()->flash("success", "Your plan ({$plan->name}) successfuly added");
							if(isMobile()){
								return redirect("/mobile-dashboard");
							}
							return redirect("/dashboard");
						}
				} else {
						if(isset($result['detail']['userid'])) {
							(new ConsultationController)->setMemberSession($user);
							$userData = User::find($user->id);
							$userData->userid = (String) $result['detail']['userid'];
							$userData->save();
						}

						if (is_array($result) && isset($result['message'])) {
							$message = $result['message'];
						} else {
							$message = $result;
						}
						return redirect()->back()->with('error', $message);
				}
				    
				
			
			} catch (\Exception $e) {
				
				$request->session()->flash("error", $e->getMessage());
				return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
			}
			
		} catch (\Exception $e) {
		      $request->session()->flash("error", $e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
		
	}

	public function handleBraintreePaymentsAwmiFamily(Request $request)
	{
		 try { 
			$input = $request->all();
		

		 	try { 
				$user = Auth::user();
				$user = User::where('id',$user->id)->first();
				$environment = env('BTREE_ENVIRONMENT');
				$gateway = new Braintree\Gateway([
					'environment' => $environment,
					'merchantId' => env('BTREE_MERCHANT_ID'),
					'publicKey' => env('BTREE_PUBLIC_KEY'),
					'privateKey' => env('BTREE_PRIVATE_KEY')
				]);

				$nonceFromTheClient = $input["payment_method_nonce"];

				
				$customer_id = 0;
				if ($user->braintree_customer_id) {
					$customer_id = $user->braintree_customer_id;
				} else {
					$result = $gateway->customer()->create([
						'id' => $user->id,
						'firstName' => $user->fname,
						'lastName' => $user->lname,
						'email' => $user->email
						//'email' => 'imwell2@gmail.com'
					]);
					
					if ($result->success) {
						$customer_id = $result->customer->id;
						User::where('id',$user->id)->update(['braintree_customer_id' => $customer_id ]);
					}
				}

				// dd($result);
				$discount_amount = 0;

				
				if( !isset( Config('constants.awmiPricing')[$input['awmitype']][$input['awmiprice']] )  ){
					return redirect('awmi-pricing');
				}
				

				$braintree_amount = Config('constants.awmiPricing')[$input['awmitype']][$input['awmiprice']];
				$braintree_amount_old = $braintree_amount;
				
					if ($user->promo_code_id) {
					$promoDetails = Promocode::where('id', $user->promo_code_id)->first();
					$discount_amount = $promoDetails->member_discount_type == "fixed" ? $promoDetails->member_discount_amount :  round(($braintree_amount * $promoDetails->member_discount_amount / 100), 2);
					$final_amount = round(($braintree_amount - $discount_amount), 2);
					$braintree_amount = $final_amount;
				}
				  

				// if ($braintree_amount > 0) {
				// 	$payment_result = $gateway->transaction()->sale([
				// 		'amount' => $braintree_amount,
				// 		'customerId' => $customer_id,
				// 		'paymentMethodNonce' => $nonceFromTheClient,
				// 		'options' => [
				// 			'submitForSettlement' => True
				// 		]
				// 		]);

				// 	if(!$payment_result->success) {
				// 		$request->session()->flash("error", "Please check your card details it doesn't seems to be valid");
				// 		return redirect("/awmi-pricing");
				// 	}
				// }
				
					// New Code Start
				
    			$result = $gateway->creditCard()->create([
                    'customerId' => $customer_id,
                    'number' => $input['card_number'],
                    'expirationDate' => $input['exp_month'].'/'.$input['exp_year'],
                    'cvv' => $input['ccv']
                ]);
                
                if($result->success){
                        $res = DB::table('card_details')->insert([
                          'user_id' =>  $user->id,
                          'last_4_digit' => $result->creditCard->maskedNumber,
                          'exp_month'=>$result->creditCard->expirationMonth,
                          'exp_year'=>$result->creditCard->expirationYear,
                          'card_id' => $result->creditCard->uniqueNumberIdentifier,
                          'token' => $result->creditCard->token,
                          'card_status' => 'default',
                          'created_at' => date("Y-m-d H:i:s")
                        ]);

                }else{
                   if(!$result->success) {
						$request->session()->flash("error", "Please check your card details it doesn't seems to be valid");
						return redirect("/dashboard");
					}
                }
                
                if ($braintree_amount > 0) {
                    $payment_result = $gateway->transaction()->sale([
        				'amount' => $braintree_amount,
        				'customerId' => $customer_id,
        				'options' => ['submitForSettlement' => True]
        			]);
        			
        			if(!$payment_result->success) {
						$request->session()->flash("error", "Please check your card details it doesn't seems to be valid");
						return redirect("/dashboard");
					}else{
					   
					}
                }
    
				// New Code End
				
				
				$user->payment_status = Config::get('constants.payment_complete');
				$user->braintree_customer_id = $customer_id;
				$user->awmi_family = 1;
				$user->step_position = 4;
				$user->auto_renewal = 1;
				$user->expiry_date = get_payment_expiry_date('monthly');
				if(isset($input['upgradePlan'])){
					$user->plan = $input['plan'];
				}
				$user->save();
				
				
				
				
				// Create Subscription start
				
				DB::table('braintree_subscription')
                ->where('user_id',$user->id)
                ->update(['subscription_status' => 'canceled']);
                
            
			    $res = DB::table('braintree_subscription')->insert([
                  'user_id' =>  $user->id,
                  'plan_id' => 1,
                  'amount'=>$braintree_amount_old,
                  'promo_code_id'=>$user->promo_code_id,
                  'promo_code_value' => $discount_amount,
                  'subscription_start_date' => date("Y-m-d"),
                  'subscription_end_date' => get_payment_expiry_date('monthly'),
                  'auto_renewal' => '1',
                  'subscription_type' => 'monthly',
                  'subscription_status' => 'active',
                  'created_at' => date("Y-m-d H:i:s")
                ]);
			   //Create Subscription End
				

				$final_amount = $promo_code_amount = $braintree_amount;

				// save braintree transactions //
				$transaction = new BraintreeTransaction;
				$transaction->user_id = $user->id;
				$transaction->plan_id = 1;
				// $transaction->plan_id = $planDetails->id??1;
				$transaction->amount = $final_amount;
				$transaction->status = $final_amount ? $payment_result->transaction->status :  "Settled";
				$transaction->transaction_id = $final_amount ? $payment_result->transaction->id : "nil";
				$transaction->final_amount = $final_amount;
				$transaction_result = $transaction->save();
				
				
				//Save Data on Tele Medicine
				//$result = (new ConsultationController)->storeGeneralInfo($user);
				
				//Save Data on Tele Medicine
				
				
				
					if(empty($user->userid)){
					    $result = (new ConsultationController)->storeGeneralInfo($user);
            			if ($result['success']) {
        					$request->session()->flash("success", "Your plan ({$input['awmitype']}) successfuly added");
        					return redirect("/dashboard");
            			} else {
            				$request->session()->flash("error", "Something wrong. Please try again or connect our support");
        				    return redirect()->back();
            			}
					    
					} else {
					    	$request->session()->flash("success", "Your plan ({$input['awmitype']}) successfuly added");
        					return redirect("/dashboard");
					    
					}
				
    			
    // 			if ($result->succes = true ) {
				// 	User::where('id',$user->id)->update(['payment_status' => 1,'step_position' => 4 ,'awmi_family' => 1 ]);
				// 	$request->session()->flash("success", "Your plan ({$input['awmitype']}) successfuly added");
				// 	return redirect("/dashboard");
    // 			}
				// $request->session()->flash("error", "Something wrong. Please try again or connect our support");
				// return redirect()->back();
			} catch (\Exception $e) {
				return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
			}
		 } catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}
	
	public function logTransaction($user_id, $status, $response){
	     $res = DB::table('subscription_charge_log')->insert([
                  'user_id' =>  $user_id,
                  'status' => $status,
                  'response'=>$response,
                  'created_at' => date("Y-m-d H:i:s")
                ]);
	}
	
	public function handleBraintreeSubscription(Request $request){
	    
  	    $environment = env('BTREE_ENVIRONMENT');
		$gateway = new Braintree\Gateway([
			'environment' => $environment,
			'merchantId' => env('BTREE_MERCHANT_ID'),
			'publicKey' => env('BTREE_PUBLIC_KEY'),
			'privateKey' => env('BTREE_PRIVATE_KEY')
		]);
		$this->logTransaction(null, 'Started', serialize(''));
	
                
        $subscribed_users = DB::table('users')->where('auto_renewal', '1')->where('expiry_date', "=", date("Y-m-d"))->get();
        if(count($subscribed_users) > 0){
            foreach($subscribed_users as $eachRow){
                
                $active_card = DB::table('card_details')->where('user_id', "=",$eachRow->id)->where('card_status', "=", 'default')->orderBy('created_at', 'desc')->first();
                if($active_card){
                    $subscription_details = DB::table('braintree_subscription')->where('user_id', "=",$eachRow->id)->where('auto_renewal', "=", '1')->where('subscription_status', "=", "active")->orderBy('created_at', 'desc')->first();
                    if($subscription_details){
                        $this->logTransaction($eachRow->id, 'Charge Customer', serialize(''));
                        $chargable_amount = $subscription_details->amount - $subscription_details->promo_code_value; 
                        $token = $active_card->token;
                        $exp_date = get_payment_expiry_date('monthly');
                        
                        echo $chargable_amount;
                        
                        // Charge Customer Start
                        $payment_result = $gateway->transaction()->sale([
            	    	    'amount'=> $chargable_amount,
            				'paymentMethodToken'=>  $active_card->token,
                            'options'=> [ 'submitForSettlement'=> true ]
            
            				]);
            				
            			if(!$payment_result->success) {
    						$this->logTransaction($eachRow->id, 'Customer Charge Falied', serialize($payment_result));
    					}else{
                            DB::table('braintree_subscription')
                            ->where('user_id',$eachRow->id)
                            ->update(['subscription_end_date' => $exp_date]);
                            DB::table('users')
                            ->where('id',$eachRow->id)
                            ->update(['expiry_date' => $exp_date]);
                            
					    	$transaction = new BraintreeTransaction;
            				$transaction->user_id = $eachRow->id;
            				$transaction->plan_id = $eachRow->planid;
            				$transaction->amount = $chargable_amount;
            				$transaction->status =$chargable_amount ? $payment_result->transaction->status :  "Settled";
            				$transaction->transaction_id = $chargable_amount ? $payment_result->transaction->id : "nil";
            				$transaction->final_amount = $chargable_amount;
            				$transaction_result = $transaction->save();
                				
    					    $this->logTransaction($eachRow->id, 'Customer Charged successfullt', serialize($payment_result));
    					}
            				
                        // Charge Customer End
                         
                     }else{
                         $this->logTransaction($eachRow->id, 'No Card', serialize('No Subscription found'));
                     }
                 }else{
                     $this->logTransaction($eachRow->id, 'No Card', serialize(''));
                 }
            }
         }else{
             $this->logTransaction(null, 'Cron executed No Subscription for Today', serialize(''));
         }

	}

	public function SaveUtmSocialPlatformData() {

		if(session()->has('utm_source') && session()->has('utm_medium') && session()->has('utm_campaign')) {
			UserMeta::CustomeUpdateInsert('utm_source',session('utm_source'));
			UserMeta::CustomeUpdateInsert('utm_medium',session('utm_medium'));
			UserMeta::CustomeUpdateInsert('utm_campaign',session('utm_campaign'));
			session()->forget(['utm_source', 'utm_medium', 'utm_campaign']);
		}
	}		 
	protected function gateway()    {
		
	


	return new Gateway(
				[
					'environment' => env('BTREE_ENVIRONMENT'),
					'merchantId' => env('BTREE_MERCHANT_ID'),            
					'publicKey' => env('BTREE_PUBLIC_KEY'),            
					'privateKey' => env('BTREE_PRIVATE_KEY'),       
				]);    
	}		
	public function token(){
		
		$token = $this->gateway()->clientToken()->generate();        
		return response()->json(['token' => $token]);
		
	}			
	public function process(Request $request)    {
		
		
		$gateway = new Gateway([
		
						'environment' => env('BTREE_ENVIRONMENT'),
						'merchantId' => env('BTREE_MERCHANT_ID'),            
						'publicKey' => env('BTREE_PUBLIC_KEY'),            
						'privateKey' => env('BTREE_PRIVATE_KEY'), 
			
		]);

		$result = $gateway->transaction()->sale([
			'amount' => $request->amount,
			'paymentMethodNonce' => $request->payment_method_nonce,
			'options' => ['submitForSettlement' => true],
		]);

		if ($result->success) {
			return response()->json([
				'success' => true,
				'redirect_url' => ''
			]);
		} else {
			return response()->json([
				'success' => false,
				'message' => $result->message
			]);
		}
	
		
       /*  $price = $request->scheduleConsultation['price'];
		
		$result = $this->gateway()->transaction()->sale(
			[            
				'amount' =>$price,             
				'paymentMethodNonce' => $request->nonce,            
				'options' => ['submitForSettlement' => true],        
			]);        
			if ($result->success) {
				
				return response()->json([              
					'success' => true,                
					'transaction_id' => $result->transaction->id            
				]);  
				
			} else {            
			
			return response()->json(['success' => false,'message' => $result->message]);    
			
		}  */   
	}
	
	public function accountActiveCouponCode(Request $request) {
		
		try {
			$user = Auth::user();
			if(!$user->plan) {
				throw new \Exception("Plan Missing");
			}
			$planDetails = Plan::where('id', $user->plan)->where('deleted_at',null)->first();
			if(!$planDetails || !$user->promo_code_id) {
				throw new \Exception(!$planDetails ? 'Plan Missing' : 'Promo Code Missing');
			}
			$braintree_amount = $planDetails->amount;
			if($user->promo_code_id) {
				$promoDetails = Promocode::where('id', $user->promo_code_id)->first();
				if($promoDetails->code!="FULLPANDA") {
					throw new \Exception("Promo Code Wrong");
				}
				$discount_amount = $promoDetails->member_discount_type == "fixed" ? $promoDetails->member_discount_amount :  round(($planDetails->amount * $promoDetails->member_discount_amount / 100), 2);
				$final_amount = round(($planDetails->amount - $discount_amount), 2);
				$braintree_amount = $final_amount;
			}
			if($braintree_amount > 0) {

				throw new \Exception("Wrong Method Choose");
			}
			
			$twoYearsLater = Carbon::now()->addYears(2);
			$twoYearsLater->toDateString(); 
			$user->expiry_date =  $twoYearsLater;	
			$user->payment_status =  1;	
			$user->save();	
			
			$userSubscription = DB::table('braintree_subscription')->where('user_id', $user->id)->first();
            if ($userSubscription) {
                DB::table('braintree_subscription')->where('user_id', $user->id)->update(['subscription_status' => 'canceled']);
            }
            
			$res = DB::table('braintree_subscription')->insert([
                  'user_id' =>  $user->id,
                  'plan_id' => $planDetails->id,
                  'amount'=>$planDetails->amount,
                  'promo_code_id'=>$user->promo_code_id,
                  'promo_code_value' => 0,
                  'subscription_start_date' => date("Y-m-d"),
                  'subscription_end_date' => $twoYearsLater,
                  'auto_renewal' => '1',
                  'subscription_type' => 'monthly',
                  'subscription_status' => 'active',
                  'created_at' => date("Y-m-d H:i:s")
                ]);
			
			(new ConsultationController)->storeGeneralInfo($user);
			$request->session()->flash("success", "Your plan ({$planDetails->name}) successfuly added");
			
			
			return response()->json(['status' =>true,'message' =>"Account Activated"]);
			
		} catch (\Exception $e) {
			
			return response()->json(['status' =>false,'message' =>$e->getMessage()]);
			
		}
		
	}

}
