<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\RepairOrder;

class OrdersKpiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index()
    {
        $user = auth('api')->user()->user;
        $ordersIds = Order::whereIn('branch_id', $user->company->getBranchesIdsOfCompany()->toArray())
            ->where('accept_date', '>=', now()->startOfMonth())->pluck('id')->toArray();

        $repairOrdersCounted = RepairOrder::whereIn('order_id', $ordersIds)->count();

        $result = [
            'value' => $repairOrdersCounted
        ];
        return response()->json($result);
    }
}
