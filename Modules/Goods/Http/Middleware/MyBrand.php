<?php

namespace Modules\Goods\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\CompanyHasBrands;

class MyBrand
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
        $brand_id = $request->route('brand_id');
        $default_brands = Brand::where('is_custom',0)->get();

        if($default_brands->contains('id', $brand_id)){
            return $next($request);
        } 

        $brand_ids = CompanyHasBrands::where('company_id', auth('api')->user()->getCompany()->id)->pluck('brand_id')->toArray();
        $brands = Brand::whereIn('id', $brand_ids)->get();
        
        if($brands->contains('id', $brand_id)){
            return $next($request);
        }

        return response()->json(['error' => 'You do not have permission to this brand or it does not exist'], 403);
    }
}
