<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\Warranty;
use Modules\Orders\Entities\DiscountCode;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Http\Requests\UpdateWarrantyRequest;

class WarrantyOrdersController extends Controller
{
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateWarrantyRequest $request, $id)
    {
        $repair_order = RepairOrder::findOrFail($id);
        $repair_order->updateWarranty($request->warranty_id);

        $repair_order->warranty_name = Warranty::findOrFail($repair_order->warranty_id)->name;
        $repair_order->discount_code_name = ($repair_order->discount_code_id == null) ? null : DiscountCode::findOrFail($repair_order->discount_code_id)->name;

        return response()->json(['message' => 'successfully updated', 
                                'order' => $repair_order]);

    }
}
