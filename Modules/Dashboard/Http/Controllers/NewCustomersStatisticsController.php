<?php

namespace Modules\Dashboard\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\Customer;
use Modules\Orders\Entities\Order;

class NewCustomersStatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = auth('api')->user()->user;
        $customers = Customer::where('company_id', $user->company_id)
            ->whereBetween('created_at', [now()->startOfMonth()->subMonths (6), now ()])->get();
        $groupedOrders = $customers->groupBy(function ($customer) {
            $customer->created_at = Carbon::parse($customer->created_at);
            return $customer->created_at->format('m');
        });

        $result = $groupedOrders->map(function ($group) {
            $firstCustomer = $group->first();
            $customersCounted = $group->count();
            return [
                'label' => $firstCustomer->created_at->format('M'),
                'value' => $customersCounted
            ];
        })->sortBy('month');

        return response()->json($result);
    }
}
