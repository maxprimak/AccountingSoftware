<?php

namespace Modules\Services\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Services\Entities\Service;
use Modules\Services\Entities\CompanyHasService;

class MyService
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
        $service_id = $request->route('service_id');
        if(!CompanyHasService::where('service_id', $service_id)->exists()){
            return response()->json([
                'error' => 'such service does not exists'
            ], 403);
        }
        
        $company_id = CompanyHasService::where('service_id', $service_id)->first()->company_id;
        $my_company_id = auth('api')->user()->getCompany()->id;

        if($company_id == $my_company_id){
            return $next($request);
        }

        return response()->json([
            'error' => 'you do not have permission for this service'
        ], 403);

    }
}
