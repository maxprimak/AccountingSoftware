<?php

namespace Modules\Suppliers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Employees\Entities\Employee;
use Modules\Orders\Entities\Order;
use Modules\Suppliers\Entities\Supplier;
use Modules\Suppliers\Entities\SupplierOrder;
use Modules\Suppliers\Entities\SupplierOrderHasGood;
use Modules\Suppliers\Http\Requests\StoreSupplierOrderRequest;

class SupplierOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $company = auth('api')->user()->getCompany();
        $branch_ids = $company->getBranchesIdsOfCompany();
        $order_ids = Order::whereIn('branch_id',$branch_ids)->pluck('id')->toArray();
        $supplier_orders = SupplierOrder::whereIn('order_id',$order_ids)->get();

        foreach ($supplier_orders as $supplier_order){
            $result_goods = SupplierOrderHasGood::getGoodsForSupplierOrder($supplier_order);

            $supplier = Supplier::find($supplier_order->supplier_id);
            $order = Order::find($supplier_order->order_id);
            $supplier_order->supplier_name = $supplier->name;
            $supplier_order->price = $order->price;
            $supplier_order->description = $result_goods;
        }
       return response()->json($supplier_orders);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('suppliers::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreSupplierOrderRequest $request)
    {
        $supplier_order = new SupplierOrder();
        $supplier_order = $supplier_order->store($request);
        return response()->json('Successfully created');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('suppliers::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('suppliers::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
