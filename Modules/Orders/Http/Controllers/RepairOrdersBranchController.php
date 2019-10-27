<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\OrderStatus;
use Modules\Orders\Entities\Order;
use Modules\Customers\Entities\Customer;
use Modules\Users\Entities\People;
use Modules\Companies\Entities\Branch;

class RepairOrdersBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id)
    {
        $repair_order_ids = RepairOrder::all()->pluck('order_id');
        $order_ids = Order::whereIn('id', $repair_order_ids)->where('branch_id', $id)->pluck('id');
        $repair_orders = RepairOrder::whereIn('order_id', $order_ids)->orderBy('id', 'DESC')->get();

        $result = array();

        foreach($repair_orders as $repair_order){

            $order = Order::find($repair_order->order_id);
            $customer = Customer::find($repair_order->customer_id);
            $person = People::find($customer->person_id);
            $status_name = OrderStatus::find($repair_order->status_id)->name;
            $location_name = Branch::find($repair_order->located_in)->name;

            $item = array(
                'id' => $repair_order->id,
                'accept_date' => $order->accept_date,
                'price' => $order->price,
                'branch_id' => $order->branch_id,
                'order_nr' => $repair_order->order_nr,
                'customer_name' => $person->name,
                'customer_phone' => $person->phone,
                'defect_description' => $repair_order->defect_description,
                'comment' => $repair_order->comment,
                'prepay_sum' => $repair_order->prepay_sum,
                'status' => $status_name,
                'located_in' => $location_name,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'created_by' => $order->created_by,
            );

            array_push($result, $item);

        }

        $result = json_encode($result);

        return response()->json($result);

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
    public function store(Request $request)
    {
        //
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
