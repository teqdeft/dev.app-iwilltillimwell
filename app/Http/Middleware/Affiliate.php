<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Affiliate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->isAffiliate()) {
            return $next($request);
        } 
        abort(403);
    }
}
