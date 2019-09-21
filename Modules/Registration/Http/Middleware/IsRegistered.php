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

        if (!User::where('login_id', auth()->id())->exists()) {
            return redirect(route('registration.index'));
        }

        return $next($request);
    }
}
