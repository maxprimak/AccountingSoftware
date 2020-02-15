<?php

namespace Modules\Orders\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MySalesOrder
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
        $sales_order_id = ($request->route('order_id') == null) ? $request->route('sales_order_id') 
                                                                            : $request->route('order_id');
        $sales_orders = auth('api')->user()->getCompany()->getSalesOrders();
        if($sales_orders->contains('id', $sales_order_id)){
            return $next($request);
        }
        else{
            return response()->json(['error' => 'You do not have permission to this sales order or it does not exist'],403);
        }
        return $next($request);
    }
}
