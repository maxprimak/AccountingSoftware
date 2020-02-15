<?php

namespace Modules\Goods\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Goods\Entities\Good;
use Modules\Warehouses\Entities\WarehouseHasGood;

class MyGood
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
        $good_id = $request->route('good_id');
        $warehouses_ids = auth('api')->user()->getCompany()->getWarehousesIds();

        $goods_ids = WarehouseHasGood::whereIn('warehouse_id', $warehouses_ids)->pluck('good_id')->toArray();
        $goods = Good::whereIn('id', $goods_ids)->get();
        if($goods->contains('id', $good_id)){
            return $next($request);
        }

        return response()->json(['error' => 'You do not have permission to this good or it does not exist'], 403);
    }
}
