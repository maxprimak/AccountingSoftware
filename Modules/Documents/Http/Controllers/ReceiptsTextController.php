<?php

namespace Modules\Documents\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Companies\Entities\Branch;
use Modules\Documents\Entities\Receipt;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\RepairOrder;

class ReceiptsTextController extends Controller
{
   public function show($repair_order_id, $language_id){

        $repairOrder = RepairOrder::find($repair_order_id);
        $order = Order::find($repairOrder->order_id);
        $result = Receipt::where('branch_id', $order->branch_id)->where('language_id', $language_id)->first()->main_text;

        return response()->json(['main_text' => $result]);

   }

    public function update(Request $request, $repair_order_id, $language_id){

    $repairOrder = RepairOrder::find($repair_order_id);
    $order = Order::find($repairOrder->order_id);
    $result = Receipt::where('branch_id', $order->branch_id)->where('language_id', $language_id)->first();
    $result->main_text = $request->main_text;
    $result->save();

    return response()->json(['success' => true, 'main_text' => $result->main_text]);

    }
}
