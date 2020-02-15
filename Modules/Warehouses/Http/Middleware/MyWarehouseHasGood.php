<?php

namespace Modules\Warehouses\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Warehouses\Entities\WarehouseHasGood;

class MyWarehouseHasGood
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
        $warehouse_has_good_id = $request->route('warehouse_has_good_id');
        if(WarehouseHasGood::where('id', $warehouse_has_good_id)->exists()){
            $warehouse_id = WarehouseHasGood::where('id', $warehouse_has_good_id)->first()->warehouse_id;
            $my_warehouses_ids = auth('api')->user()->getCompany()->getWarehousesIds();
            if(in_array($warehouse_id, $my_warehouses_ids)){
                return $next($request);
            }
            else{
                return response()->json([
                    'error' => 'you do not have permission fo this warehouse_has_good entity'
                ],403);
            }
        }
        return response()->json([
            'error' => 'such warehouse_has_good entity does not exist'
        ],403);
    }
}
