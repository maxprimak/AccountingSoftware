<?php

namespace Modules\Dashboard\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\Customer;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\RepairOrder;

class WorkshopStatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index()
    {
        $user = auth('api')->user()->user;
        $ordersIds = Order::whereIn('branch_id', $user->company->getBranchesIdsOfCompany()->toArray())->pluck('id')->toArray();
        $repairOrders = RepairOrder::whereIn('order_id', $ordersIds)->get();

        $result = [
            'PayOrders' => [
                'label' => 'Pay Orders',
                'value' => $repairOrders->where('order_type_id', 1)->count()
            ],
            'Warranty' => [
                'label' => 'Warranty',
                'value' => $repairOrders->where('order_type_id', 2)->count()
            ],
            'Rework' => [
                'label' => 'Rework',
                'value' => $repairOrders->where('order_type_id', 3)->count()
            ]
        ];
        return response()->json($result);
    }
}
