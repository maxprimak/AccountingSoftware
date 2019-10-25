<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Http\Requests\StoreSalesOrderRequest;
use Modules\Orders\Http\Requests\UpdateSalesOrderRequest;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\SalesOrder;

class SalesOrdersController extends Controller
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
    public function store(StoreSalesOrderRequest $request)
    {
        $order = new Order();
        $order = $order->store($request);

        $sales_order = new SalesOrder();
        $sales_order = $sales_order->store($request, $order->id);

        return response()->json([
            'status' => 'Successfully created',
            'order' => [
                'id' => $sales_order->id,
                'accept_date' => $order->accept_date,
                'price' => $order->price,
                'branch_id' => $order->branch_id,
                'article_description' => $sales_order->article_description,
                'payment_type_id' => $sales_order->payment_type_id,
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
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateSalesOrderRequest $request, $id)
    {
        $sales_order = SalesOrder::find($id);
        $order = Order::find($sales_order->order_id);

        $order = $order->storeUpdated($request, $order->id);
        $sales_order = $sales_order->storeUpdated($request);

        return response()->json([
            'status' => 'Successfully updated',
            'order' => [
                'id' => $sales_order->id,
                'accept_date' => $order->accept_date,
                'price' => $order->price,
                'branch_id' => $order->branch_id,
                'article_description' => $sales_order->article_description,
                'payment_type_id' => $sales_order->payment_type_id,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'created_by' => $order->created_by,
            ]
        ]);

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
