<?php

namespace Modules\Suppliers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Goods\Entities\Good;
use Modules\Suppliers\Entities\SupplierOrder;

class SupplierOrderHasGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id)
    {
        $ids = SupplierOrder::where('orders_to_supplier_id', $id)->pluck('good_id')->toArray();
        $goods = Good::whereIn('id', $ids)->get();

        return response()->json($goods);
    }
}
