<?php

namespace Modules\Goods\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyWarehouse
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
        $warehouse_id = $request->route('warehouse_id');
        $my_warehouse_ids = auth('api')->user()->getCompany()->getWarehousesIds();

        if(in_array($warehouse_id, $my_warehouse_ids)){
            return $next($request);
        }

        return response()->json([
            'error' => 'warehouse_id is '. $warehouse_id .': you do not have permission to this warehouse or it does not exist'
        ],403);
    }
}
