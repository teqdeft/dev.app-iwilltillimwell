<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Route;


class UserDashboardPaymentStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		$login_info  = Auth::user();
		$routeName = Route::currentRouteName();
		if($login_info->payment_status==1) {
			
			$check = UserMeta::where(['prefix' => 'iwilltilimwell','user_id' => $login_info->id, 'meta_key' => 'counseling-type','meta_value' => 'counseling-consent'])->count();
            if(!$check ){
                return redirect('share/user/medical-consent');
            }
			if($login_info->doctor_step==4) {
				return redirect('document-manager');
			} else if($login_info->doctor_step==3) {
				return redirect('medical-history');
			} else if($login_info->doctor_step==2) {
				return redirect('medication-allergies');
			} else if($login_info->doctor_step==1) {
				return redirect('medications');
			} else if($login_info->doctor_step==0) {
				return redirect('personal-record');
			}
			
		} else { 
			if(ismobile()){
				
			} else {
				
				if($routeName!='dashboard') {
					
					return redirect('dashboard');
				}
			}
			
			
		}
		
        return $next($request); 
    }
}
