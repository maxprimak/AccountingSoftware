<?php

namespace App\Http\Middleware;

use Closure;

class EmployeesMiddleware
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
        $role_id = auth()->user()->checkRole();
        
        if($role_id == '5')
        {
            return redirect()->back();
        }else {
            return $next($request);
        }
        
    }
}
