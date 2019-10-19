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
        $role_id = auth('api')->user()->getRoleId();

        if($role_id == '5')
        {
            return response()->json(['message' => 'Courier does not have permission to access this route'], 403);
        }else {
            return $next($request);
        }

    }
}
