<?php

namespace Modules\Dashboard\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\Order;
use Modules\Suppliers\Entities\SupplierOrder;

class TotalRevenueStatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $user = auth('api')->user()->user;
        $orders = Order::whereIn('branch_id', $user->company->getBranchesIdsOfCompany()->toArray())
            ->whereBetween('accept_date', [now()->startOfMonth()->subMonths (6), now ()])->get();

        $excludeOrdersIds = SupplierOrder::whereIn('order_id', $orders->pluck('id')->toArray())->pluck('order_id')->toArray();
        $orders = $orders->whereNotIn('id', $excludeOrdersIds);

        $groupedOrders = $orders->groupBy(function ($order) {
            $order->accept_date = Carbon::parse($order->accept_date);
            return $order->accept_date->format('m');
        });

        $result = $groupedOrders->map(function ($group) {
            $firstOrder = $group->first();
            $totalRevenueOfGroup = $group->sum('price');
            return [
                'label' => $firstOrder->accept_date->format('M'),
                'value' => $totalRevenueOfGroup
            ];
        })->sortBy('month');
        return response()->json($result);
    }
}
