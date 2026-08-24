<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class VerifyUserByPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(!Auth::user()->payment_status && is_null(Auth::user()->parentId)) {
            $request->session()->flash('error', "Please complete you registration process.");
            return redirect("/dashboard");
        }
        return $next($request);
    }
}
