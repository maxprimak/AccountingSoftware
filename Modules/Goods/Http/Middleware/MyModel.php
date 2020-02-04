<?php

namespace Modules\Goods\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\CompanyHasModels;

class MyModel
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
        $model_id = $request->route('model_id');
        $default_models = Models::where('is_custom',0)->get();

        if($default_models->contains('id', $model_id)){
            return $next($request);
        } 

        $model_ids = CompanyHasModels::where('company_id', auth('api')->user()->getCompany()->id)->pluck('model_id')->toArray();
        $models = Models::whereIn('id', $model_ids)->get();
        
        if($models->contains('id', $model_id)){
            return $next($request);
        }

        return response()->json(['error' => 'You do not have permission to this model or it does not exist'], 403);
    }
}
