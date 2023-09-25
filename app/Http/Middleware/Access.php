<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 


class Access
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
        $roleUserId = session('userdata.user_role');

        $check = DB::table('v_user_roles')->where([
            ['user_role_role_id', $roleUserId], 
            ['route_name', $request->route()->getName()], 
        ])->get()->toArray();

        $route = convertArray($check);
        
        if(is_array_empty($route) == false){
            return abort(404);
        }else{
            $routeName = $route[0]['route_name'];

            if($request->route()->getName() == $routeName){
                return $next($request);
            }else{
                return abort(404);
            }
        }
    }
}
