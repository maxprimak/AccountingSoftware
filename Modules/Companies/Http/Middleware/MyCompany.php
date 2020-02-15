<?php

namespace Modules\Companies\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyCompany
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
        $company_id = $request->route('company_id');
        $my_company_id = auth('api')->user()->getCompany()->id;
        if($my_company_id == $company_id){
            return $next($request);
        }else{
            return response()->json(['error' => 'You do not have permission to this company or such company does not exist'], 403);
        }
        return $next($request);
    }
}
