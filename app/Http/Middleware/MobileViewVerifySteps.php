<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class MobileViewVerifySteps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$request_type)
    {
        if (isMobile()) {
            $user = Auth::user();
            $userDetails = User::where('id',$user->id)->first();
            $rounter_name = Route::currentRouteName();
            if($userDetails->onboard == 0 && $rounter_name!="mobile-onboard"){
                return redirect('/mobile-onboard'); 
            } else if ($request_type=="mobile-step-1" && $userDetails->onboard==1) {
                return redirect('/mobile-plan'); 
            } else if ($request_type=="mobile-step-2" && $userDetails->onboard==0) {
                return redirect('/mobile-onboard'); 
            } else if ($userDetails->payment_status==1 && $request_type!="plan-package-completed" && $userDetails->onboard != 0) {
                return redirect('/mobile-dashboard');    
            }  else if (!$userDetails->payment_status && $userDetails->step_position == 2 && $request_type=="plan-package-completed") {
                return redirect('/mobile-plan');    
            } elseif (!$userDetails->payment_status && $userDetails->step_position == 3 && $request_type=="plan-package-completed") {
                return redirect('/mobile-plan');    
            } elseif (!$userDetails->payment_status && $userDetails->step_position == 4 && $request_type=="plan-package-completed") {
                return redirect('/mobile-plan');    
            }  
            
        } else {
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
