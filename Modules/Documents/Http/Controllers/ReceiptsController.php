<?php

namespace Modules\Documents\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\Order;
use Modules\Companies\Entities\Branch;
use Modules\Customers\Entities\Customer;
use Modules\Documents\Entities\Receipt;

class ReceiptsController extends Controller
{
    public function show($repairOrderId){
        $repairOrder = RepairOrder::find($repairOrderId);
        $order = Order::where('id', $repairOrder->order_id)->first();
        $company = auth('api')->user()->getCompany();
        $branch = Branch::find($order->branch_id);
        $customer = Customer::find($repairOrder->customer_id);
        

        return response()->json([
            'repair_shop_name' => $company->name,
            'branch_address' => $branch->getAddress()->getName(),
            'branch_name' => $branch->name,
            'order_nr' => $repairOrder->order_nr,
            'branch_phone' => $branch->phone,
            'current_date' => date('d.m.Y'),
            'order_type' => $repairOrder->getType()->getTranslatedName($company->language_id),
            'customer_name' => $customer->getPerson()->name,
            'customer_phone' => $customer->getPerson()->phone,
            'services_names' => $repairOrder->getServicesNamesString(),
            'devices_names' => $repairOrder->getDevicesNamesString(),
            'devices_serial_nr' => $repairOrder->getDevicesSerialNumberString(),
            'devices_conditions' => $repairOrder->getDevicesConditionsString(),
            'order_prepay_sum' => $repairOrder->showPrepayAsString(),
            'order_price' => $order->showPriceAsString(),
            'defect_description_names' => $repairOrder->getDefectDescriptionsAsString(),
            'order_comment' => ($repairOrder->comment != null) ? $repairOrder->comment : "Not set",
            'receipt_text' => Receipt::where('branch_id', $branch->id)->where('language_id', $company->language_id)->first()->main_text,
        ]);
    }
}
