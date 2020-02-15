<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\DiscountCode;
use Modules\Orders\Entities\Warranty;
use Modules\Orders\Http\Requests\UpdateDiscountOrderRequest;

class DiscountCodesOrdersController extends Controller
{
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateDiscountOrderRequest $request, $id)
    {
        $repair_order = RepairOrder::find($id);
        $repair_order->updateDiscountCode($request->discount_code_id);

        $repair_order->warranty_name = ($repair_order->warranty_id == null) ? null : Warranty::findOrFail($repair_order->warranty_id)->name;
        $repair_order->discount_code_name = DiscountCode::findOrFail($repair_order->discount_code_id)->name;
        
        return response()->json([
            'message' => 'successfully updated',
            'order' => $repair_order
        ]);
    }
}
