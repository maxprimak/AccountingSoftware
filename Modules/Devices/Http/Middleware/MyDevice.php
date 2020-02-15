<?php

namespace Modules\Devices\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Devices\Entities\Device;
use Modules\Devices\Entities\CustomerHasDevice;
use Modules\Customers\Entities\Customer;

class MyDevice
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
        $device_id = $request->route('device_id');
        if(CustomerHasDevice::where('device_id',$device_id)->exists()){
            $customer_id = CustomerHasDevice::where('device_id',$device_id)->pluck('customer_id');
            $customer = Customer::where('id', $customer_id)->first();
    
            if(auth('api')->user()->getCompany()->id == $customer->company_id){
                return $next($request);
            }
            return response()->json([
                'error' => 'you do not have permission for this device'
            ],403);
        }else{
            return response()->json([
                'error' => 'such device does not exist'
            ],403);
        }

    }
}
