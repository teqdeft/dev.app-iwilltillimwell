<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\UserMeta;

class checkAWMIpricing
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

        $userId = auth()->id();
        $userMeta = UserMeta::where('user_id', $userId)
            ->where('meta_key', 'awmi_priceCheck')
            ->first();

        if ($userMeta && $userMeta->meta_value == 0) {
            return redirect('awmi-pricing');
        }   

        return $next($request);

    }
}