<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class completeProfileCheck
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

        $user = Auth::user();
        $userDetails = User::where('id',$user->id)->first();

        if( $userDetails->payment_status ){
            $check = UserMeta::where(['prefix' => 'iwilltilimwell','user_id' => $user->id, 'meta_key' => 'counseling-type','meta_value' => 'counseling-consent'])->count();
            if( !$check ){
                return redirect('share/user/medical-consent');
            }
            return $next($request);
        }
        if( getSegment(1) != 'dashboard' ){
            return redirect('dashboard');
        }
        return $next($request);


    }
}
