<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerType;
use Modules\Login\Entities\Login;
use Modules\Orders\Entities\DeviceHasService;
use Modules\Orders\Entities\DiscountCode;
use Modules\Orders\Entities\OrderStatusesTranslation;
use Modules\Orders\Entities\OrderTypes;
use Modules\Orders\Entities\OrderTypesTranslations;
use Modules\Orders\Entities\Payment;
use Modules\Orders\Entities\PaymentStatuses;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\RepairOrderHasDevice;
use Modules\Orders\Entities\RepairOrderHasGood;
use Modules\Orders\Entities\ReworkOrderHasWarrantyCase;
use Modules\Orders\Entities\ReworkOrders;
use Modules\Orders\Entities\SalesOrder;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\OrderStatus;
use Modules\Customers\Entities\Customer;
use Modules\Orders\Entities\Warranty;
use Modules\Orders\Entities\PayOrders;
use Modules\Orders\Http\Requests\StoreRepairOrderRequest;
use Modules\Orders\Http\Requests\UpdateRepairOrderRequest;
use Modules\Customers\Entities\CustomerHasBranch;
use Modules\Services\Entities\Service;
use Modules\Users\Entities\People;
use Modules\Companies\Entities\Currency;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRepairOrderRequest $request)
    {
        $order = new Order();
        $order = $order->store($request);

        $repair_order = new RepairOrder();
        $request = $repair_order->setPaymentStatus($request);
        $repair_order = $repair_order->store($request, $order->id);

        return response()->json([
            'status' => 'Successfully created',
            'order' => [
                'id' => $repair_order->id,
                'accept_date' => $order->accept_date,
                'price' => $order->price,
                'branch_id' => $order->branch_id,
                'order_nr' => $repair_order->order_nr,
                'comment' => $repair_order->comment,
                'prepay_sum' => $repair_order->prepay_sum,
                'status_id' => $repair_order->status_id,
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
     */
    public function update(UpdateRepairOrderRequest $request, $id)
    {
        $repair_order = RepairOrder::findOrFail($id);
        $order = Order::findOrFail($repair_order->order_id);

        $order = $order->storeUpdated($request, $order->id);
        $repair_order = $repair_order->storeUpdated($request, $repair_order->id);

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
                'located_in' => $repair_order->located_in,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'created_by' => $order->created_by
            ]
        ]);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($repair_order_id)
    {
        $company = auth('api')->user()->getCompany();
        $repair_order = RepairOrder::findOrFail($repair_order_id);
        $order = Order::findOrFail($repair_order->order_id);
        $login = Login::findOrFail($order->created_by);
        $order_status = OrderStatus::getOrderStatusWithTranslation($repair_order);
        $customer = Customer::findOrFail($repair_order->customer_id);
        $customer_person = People::findOrFail($customer->person_id);
        $customer_type = CustomerType::findOrFail($customer->type_id);
        $result_devices = RepairOrderHasDevice::getDevicesOfOrderWithServices($repair_order);
        $order_type = OrderTypes::getOrderTypeWithTranslation($repair_order);
        $discount_code = ($repair_order->discount_code_id == null) ? null : DiscountCode::findOrFail($repair_order->discount_code_id);
        $warranty = ($repair_order->warranty_id == null) ? null : Warranty::findOrFail($repair_order->warranty_id);
        $payment_status = PaymentStatuses::getPaymentStatusWithTranslation($repair_order);
        $branch = $order->getBranch();
        $currency_id = Login::find(auth('api')->id())->getCompany()->currency_id;
        $currency = Currency::find($currency_id);

        return response()->json([
            'order' => [
                'id' => $repair_order->id,
                'order_nr' => $repair_order->order_nr,
                'order_type_id' => $repair_order->order_type_id,
                'created_by_name' => $login->username,
                'created_by' => $login->id,
                'status_color' => $order_status->hex_code,
                'status_name' => $order_status->name,
                'status_id' => $order_status->id,
                'created_at' => $repair_order->created_at,
                'customer_id' => $customer->id,
                'customer_name' => $customer_person->name,
                'customer_phone' => $customer_person->phone,
                'customer_email' => $customer->email,
                'customer_address' => $customer_person->address,
                'customer_type_name' => $customer_type->name,
                'devices' => $result_devices,
                'order_type_name' => $order_type->name,
                'deadline_date' => $repair_order->deadline,
                'discount_code_id' => ($discount_code == null) ? null : $discount_code->id,
                'discount_code_name' => ($discount_code == null) ? null : $discount_code->name,
                'discount_code_percent' => ($discount_code == null) ? null : $discount_code->percent_amount,
                'prepay_sum' => $repair_order->prepay_sum,
                'branch_name' => $branch->name,
                'branch_id' => $branch->id,
                'comment' => $repair_order->comment,
                'price' => $order->price,
                'warranty_id' => ($warranty == null) ? null : $warranty->id,
                'warranty_name' => ($warranty == null) ? null : $warranty->name,
                'warranty_days_number' => ($warranty == null) ? null : $warranty->days_number,
                'payment_status_id' => $payment_status->id,
                'payment_status_name' => $payment_status->name,
                'currency_id' => $currency->id,
                'currency_name' => $currency->name,
                'currency_symbol' => $currency->symbol
                ]
        ]);
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

        RepairOrderHasGood::where('repair_order_id',$repair_order->id)->delete();
        RepairOrderHasDevice::where('repair_order_id',$repair_order->id)->delete();
        PayOrders::where('repair_order_id',$repair_order->id)->delete();
        $repair_order->delete();
        $order->delete();

        return response()->json(["status" => "Successfully deleted"]);

    }
}
