<?php

namespace Modules\Registration\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Users\Entities\User;

class IsRegistered
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

        if (!User::where('login_id', auth('api')->id())->exists()) {
            return response()->json(['error' => 'User is not registered in system '], 403);
        }

        return $next($request);
    }
}
