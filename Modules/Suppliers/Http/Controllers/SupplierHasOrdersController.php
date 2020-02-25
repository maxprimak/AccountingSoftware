<?php

namespace Modules\Suppliers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Suppliers\Entities\SupplierOrder;

class SupplierHasOrdersController extends Controller
{

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $orders = SupplierOrder::where('supplier_id', $id)->get();

        return response()->json($orders);
        
    }

}
