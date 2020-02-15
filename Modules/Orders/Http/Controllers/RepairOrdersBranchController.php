<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\OrderTypesTranslations;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\OrderStatus;
use Modules\Orders\Entities\OrderStatusesTranslation;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\OrderTypes;
use Modules\Orders\Entities\RepairOrderHasDevice;
use Modules\Orders\Entities\PaymentStatuses;
use Modules\Orders\Entities\PaymentStatusesTranslations;
// use Modules\Orders\Entities\RepairOrderHasGood;
use Modules\Orders\Entities\DeviceHasService;
use Modules\Devices\Entities\Device;
use Modules\Services\Entities\Service;
use Modules\Goods\Entities\Color;
use Modules\Customers\Entities\Customer;
use Modules\Users\Entities\People;
use Modules\Companies\Entities\Branch;
use DB;


class RepairOrdersBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id,$is_completed)
    {
        $company = auth('api')->user()->getCompany();
        $repair_order_ids = RepairOrder::where('is_completed',$is_completed)->pluck('order_id');
        $order_ids = Order::whereIn('id', $repair_order_ids)->where('branch_id', $id)->pluck('id');
        $repair_orders = RepairOrder::whereIn('order_id', $order_ids)->orderBy('id', 'DESC')->get();
        $currency = $company->getCurrency();
        $result = array();

        foreach($repair_orders as $repair_order){

            $order = Order::find($repair_order->order_id);
            $customer = Customer::find($repair_order->customer_id);
            $person = People::find($customer->person_id);
            $branch = Branch::find($order->branch_id);
            $order_type = OrderTypes::getOrderTypeWithTranslation($repair_order);
            $status = OrderStatus::getOrderStatusWithTranslation($repair_order);
            $payment_status = PaymentStatuses::getPaymentStatusWithTranslation($repair_order);
            $result_devices = RepairOrderHasDevice::getDevicesOfOrderWithServices($repair_order);
            $item = array(
                'id' => $repair_order->id,
                'accept_date' => $order->accept_date,
                'order_nr' => $repair_order->order_nr,
                'order_type_id' => $order_type->id,
                'order_type_name' => $order_type->name,
                'customer_id' => $customer->id,
                'customer_name' => $person->name,
                'customer_phone' => $person->phone,
                'comment' => $repair_order->comment,
                'prepay_sum' => $repair_order->prepay_sum,
                'status_id' => $status->id,
                'status_color' => $status->hex_code,
                'status_name' => $status->name,
                'devices' => $result_devices,
                'price' => $order->price,
                'payment_status_id' => $payment_status->id,
                'payment_status' => $payment_status->name,
                'branch_id' => $order->branch_id,
                'branch_name' => $branch->name,
                'currency_symbol' => $currency->symbol,
                'deadline' => $repair_order->deadline,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'created_by' => $order->created_by,
            );

            array_push($result, $item);

        }

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
