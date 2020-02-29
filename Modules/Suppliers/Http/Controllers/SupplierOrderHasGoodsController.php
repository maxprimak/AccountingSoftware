<?php

namespace Modules\Suppliers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Goods\Entities\Good;
use Modules\Suppliers\Entities\SupplierOrder;
use Modules\Suppliers\Entities\SupplierOrderHasGood;

class SupplierOrderHasGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id)
    {
        $ids = SupplierOrderHasGood::where('orders_to_supplier_id', $id)->pluck('good_id')->toArray();
        $goods = Good::whereIn('id', $ids)->get();
        $order = SupplierOrder::find($id);

        foreach($goods as $good){
            $good->addInfoForSupplierOrder($order);
        }

        return response()->json($goods);
    }
}
