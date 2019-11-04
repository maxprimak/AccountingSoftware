<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\SalesOrder;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\OrderStatus;
use Modules\Customers\Entities\Customer;
use Modules\Orders\Http\Requests\StoreRepairOrderRequest;
use Modules\Orders\Http\Requests\UpdateRepairOrderRequest;
use Modules\Customers\Entities\CustomerHasBranch;

class RepairOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('orders::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('orders::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreRepairOrderRequest $request)
    {
        $order = new Order();
        $order = $order->store($request);

        $repair_order = new RepairOrder();
        $repair_order = $repair_order->store($request, $order->id);

        $permission = new CustomerHasBranch();
        $permission->customer_id = $repair_order->customer_id;
        $permission->branch_id = $order->branch_id;
        $permission->save();

        return response()->json([
            'status' => 'Successfully created',
            'order' => [
                'id' => $repair_order->id,
                'accept_date' => $order->accept_date,
                'price' => $order->price,
                'branch_id' => $order->branch_id,
                'order_nr' => $repair_order->order_nr,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'defect_description' => $repair_order->defect_description,
                'comment' => $repair_order->comment,
                'prepay_sum' => $repair_order->prepay_sum,
                'status_id' => $repair_order->status_id,
                'located_in' => $repair_order->located_in,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'created_by' => $order->created_by,
            ]
        ]);
    }

        /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateRepairOrderRequest $request, $id)
    {

        $repair_order = RepairOrder::find($id);
        $order = Order::find($repair_order->order_id);

        $order = $order->storeUpdated($request, $order->id);
        $repair_order = $repair_order->storeUpdated($request, $repair_order->id);
        $status_name = OrderStatus::find($repair_order->status_id)->name;

        return response()->json([
            'status' => 'Successfully updated',
            'order' => [
                'id' => $repair_order->id,
                'accept_date' => $order->accept_date,
                'price' => $order->price,
                'branch_id' => $order->branch_id,
                'order_nr' => $repair_order->order_nr,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'defect_description' => $repair_order->defect_description,
                'comment' => $repair_order->comment,
                'prepay_sum' => $repair_order->prepay_sum,
                'status' => $status_name,
                'located_in' => $repair_order->located_in,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'created_by' => $order->created_by,
            ]
        ]);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('orders::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('orders::edit');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {   

        $repair_order = RepairOrder::findOrFail($id);
        $order = Order::findOrFail($repair_order->order_id);
        $repair_order->delete();
        $order->delete();

        return response()->json(["status" => "Successfully deleted"]);

    }
}
