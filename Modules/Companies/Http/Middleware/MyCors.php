<?php

namespace Modules\Companies\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyCors
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
        return $next($request)
        ->header('Access-Control-Allow-Origin', 'http://localhost:8080') // maybe put this into the .env file so you can change the URL in production.
        ->header('Access-Control-Allow-Methods', '*') // or specify `'GET, POST, PUT, DELETE'` etc as the second parameter if you want to restrict the methods that are allowed.
        ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Authorization') // or add your headers.
    }
}
