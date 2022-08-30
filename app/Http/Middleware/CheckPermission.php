<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckPermission
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
        if(auth()->user()->role->name === 'admin')
            return $next($request);
            
        $user_permissions = auth()->user()->role->permissions->toArray();
        $route_name = $request->route()->getName();
        foreach($user_permissions as $permission){
            if($route_name === $permission['name'])
                return $next($request);
        }

        abort(403,'Access Denied');
    }
}
