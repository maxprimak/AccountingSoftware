<?php

namespace Modules\Login\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAuthorized
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
        $user = auth()->user();
        if($user != null){
            return $next($request);
        }else{
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
