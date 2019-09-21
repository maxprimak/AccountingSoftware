<?php

namespace Modules\Registration\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        return $next($request);
    }
}
