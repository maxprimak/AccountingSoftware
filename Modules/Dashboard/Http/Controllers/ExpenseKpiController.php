<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\Order;
use Modules\Suppliers\Entities\SupplierOrder;

class ExpenseKpiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index()
    {
        $user = auth('api')->user()->user;
        $orders = Order::whereIn('branch_id', $user->company->getBranchesIdsOfCompany()->toArray())
            ->where('accept_date', '>=', now()->startOfMonth())->get();

        $excludeOrdersIds = SupplierOrder::whereIn('order_id', $orders->pluck('id')->toArray())->pluck('order_id')->toArray();
        $orders = $orders->whereIn('id', $excludeOrdersIds);

        $result = [
            'value' => $orders->sum('price')
        ];
        return response()->json($result);
    }
}
