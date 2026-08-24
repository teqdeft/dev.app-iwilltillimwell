<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Permission;

class AdminManagers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$moduleName)
    {
        //pre($moduleName,1);
        if( Auth::user()->isAdmin() ){
            return $next($request);
        }elseif(Auth::user()->isManagers()){
          if(Auth::user()->admin_managers != 0 ){
            $givenPermission = Permission::where('role_id',Auth::user()->admin_managers)
        											->pluck('permissions')->first();
              if( !empty($givenPermission) ){
                if(permission_exist($moduleName,$givenPermission)){
                  return $next($request);
                }
              }
          }
        }
        abort(403);

    }
}
