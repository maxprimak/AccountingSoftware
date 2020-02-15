<?php

namespace Modules\Orders\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyRepairOrder
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
        $repair_order_id = ($request->route('order_id') == null) ? $request->route('repair_order_id') 
                                                                           : $request->route('order_id');
        $repair_orders = auth('api')->user()->getCompany()->getRepairOrders();
        if($repair_orders->contains('id', $repair_order_id)){
            return $next($request);
        }
        else{
            return response()->json(['error' => 'You do not have permission to this repair order or it does not exist'],403);
        }
        return $next($request);
    }
}
