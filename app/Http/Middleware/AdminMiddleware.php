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
        $role_id = auth()->user()->checkRole();
        
        if($role_id != '1' && $role_id != '2')
        {
            return redirect()->back();
        }
        return $next($request);
    }
}
