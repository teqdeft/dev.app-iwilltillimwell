<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserMood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMoodWare
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

        if( Auth::user()->payment_status ){
            if( UserMood::where([
                    ['user_id',Auth::user()->id],
                    ['emoji_date',date('Y-m-d')],
                ]
            )->count() == 0 ){
                return redirect('user-mood');
            }
        }
        return $next($request);
    }
}
