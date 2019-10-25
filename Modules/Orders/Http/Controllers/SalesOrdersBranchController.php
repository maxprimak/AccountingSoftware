<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\SalesOrder;
use Modules\Orders\Entities\OrderStatus;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\PaymentType;
use Modules\Customers\Entities\Customer;
use Modules\Users\Entities\People;

class SalesOrdersBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id)
    {   

        $sales_order_ids = SalesOrder::all()->pluck('order_id');
        $order_ids = Order::whereIn('id', $sales_order_ids)
        ->where('accept_date', date("Y-m-d"))
        ->where('branch_id', $id)->pluck('id');
        $sales_orders = SalesOrder::whereIn('order_id', $order_ids)->orderBy('id', 'DESC')->get();

        $result = array();

        foreach($sales_orders as $sales_order){

            $order = Order::find($sales_order->order_id);
            $payment_type_name = PaymentType::findOrFail($sales_order->payment_type_id)->name;

            $item = array(
                'id' => $sales_order->id,
                'accept_date' => $order->accept_date,
                'price' => $order->price,
                'branch_id' => $order->branch_id,
                'article_description' => $sales_order->article_description,
                'payment_type' => $payment_type_name,
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
