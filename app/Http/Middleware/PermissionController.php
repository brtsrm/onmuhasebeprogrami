<?php

namespace App\Http\Middleware;

use App\Models\UserPermission;
use Closure;
use Illuminate\Http\Request;

class PermissionController
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
        $prefix = str_replace("/","",request()->route()->getPrefix());
        $index  = array_search($prefix,config("app.permission"));
        if(!UserPermission::getMyController($index)){
            return redirect("/");
        }
        return $next($request);
    }
}
