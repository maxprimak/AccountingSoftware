<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\Warranty;
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

        return response()->json(['message' => 'successfully updated', 
                                'order' => $repair_order]);

    }
}
