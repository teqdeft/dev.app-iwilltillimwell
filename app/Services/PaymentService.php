<?php

namespace App\Services;
use App\Models\Plan;
use Auth;
use DB;

class PaymentService
{
    public function store($request,$data)
    {

        $user = Auth::user();
        $plan = $user->plan;
        $planDetails = Plan::where('id', $plan)->first();
        $package_service_list =  GetSelectedPackageServiceList();
		$optional_service = GetPackageOptionalService();
        $optional_amount = GetPackageOptionalAmount();
        $bundle_id  	= GetPackageOptionalBundleID();
        $commission_rate = 0;
		$commission_amount = 0;
        $pro_rata_days = 0;
		$pro_rata_amount = 0;
        $activation_type = "activation";
        $promo_code_amount = 0;
        $customer_id = 0;


        $userSubscription = DB::table('braintree_subscription')->where('user_id', $user->id)->first();
        if($userSubscription) {
            DB::table('braintree_subscription')->where('user_id', $user->id)->update(['subscription_status' => 'canceled']);
			$activation_type = "upgrade";
        }

        $subscription_type = GetUserMetaWithMetaKey("plan_tab",$user->id);
		if($subscription_type=="self" or $subscription_type=="self-family") {
            $subscription_type = 'monthly';
        }

        $final_amount = $planDetails->amount;
        $final_amount = $final_amount+$optional_amount+$pro_rata_amount;
        $commission_amount = ($final_amount)*$commission_rate/100;


        $user->payment_status = 1;
		$user->auto_renewal = 1;
        $user->braintree_customer_id = $customer_id;
        $user->bundle_id = $bundle_id??'0';
        $user->expiry_date = get_payment_expiry_date($planDetails->interval);
        $user->save();

        


         DB::table('braintree_subscription')->insert([

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
                  'free_trial_days' => '0',
                  'payment_method'=>$data['payment_method'],
                  'created_at' => date("Y-m-d H:i:s")

                ]);
        
        $request->session()->flash("success", "Your plan ({$planDetails->name}) successfuly added");

    }
}