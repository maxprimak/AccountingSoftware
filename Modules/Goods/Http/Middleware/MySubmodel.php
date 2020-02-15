<?php

namespace Modules\Goods\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Goods\Entities\Submodel;
use Modules\Goods\Entities\CompanyHasSubmodel;

class MySubmodel
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
        $submodel_id = $request->route('submodel_id');
        $default_submodels = Submodel::where('is_custom',0)->get();

        if($default_submodels->contains('id', $submodel_id)){
            return $next($request);
        } 

        $submodel_ids = CompanyHasSubmodel::where('company_id', auth('api')->user()->getCompany()->id)->pluck('submodel_id')->toArray();
        $submodels = Submodel::whereIn('id', $submodel_ids)->get();
        
        if($submodels->contains('id', $submodel_id)){
            return $next($request);
        }

        return response()->json(['error' => 'You do not have permission to this submodel or it does not exist'], 403);
    }
}
