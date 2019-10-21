<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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

        if($role_id != '1' && $role_id != '2')
        {
            return response()->json(["message" => "Only top manager and head can access this route"], 403);
        }
        return $next($request);
    }
}
