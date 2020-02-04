<?php

namespace Modules\Customers\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Customers\Entities\Customer;

class MyCustomer
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
        $customer_id = $request->route('customer_id');
        $my_customers = Customer::where('company_id', auth('api')->user()->getCompany()->id)->get();

        if($my_customers->contains('id', $customer_id)){
            return $next($request);
        }else{
            return response()->json(['error' => 'You do not have permission to edit this customer or such customer does not exist'], 403);
        }
        return $next($request);
    }
}
