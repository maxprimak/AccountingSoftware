<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Goods\Entities\Good;
use Modules\Orders\Entities\RepairOrderHasGood;
use Modules\Orders\Http\Requests\StoreRepairOrderHasGoodsRequest;
use Modules\Warehouses\Entities\WarehouseHasGood;

class RepairOrderHasGoodsController extends Controller
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
     * @return Response
     */
    public function store(StoreRepairOrderHasGoodsRequest $request,$repair_order_id)
    {
        //TODO::Make sure that is we could not store new RepairOrderHasGood it will not delete existin RepairOrderHasGoods
        $delete_repair_order_has_goods = new RepairOrderHasGood();
        $delete_repair_order_has_goods->deleteExistingGoods($repair_order_id);

        $repair_order_has_goods = array();
        $warehouse_has_good_ids = array();
        foreach ($request->warehouse_has_goods as $warehouse_has_good){
            $repair_order_has_good = new RepairOrderHasGood();

            $repair_order_has_good = $repair_order_has_good->store($warehouse_has_good,$repair_order_id, $request->device_id);
            array_push($repair_order_has_goods,$repair_order_has_good);
            array_push($warehouse_has_good_ids,$warehouse_has_good['id']);
        }
        $warehouse_has_goods = WarehouseHasGood::whereIn('id',$warehouse_has_good_ids)->get();
        $goods = array();
        foreach ($warehouse_has_goods as $warehouse_has_good){
            $good = $warehouse_has_good->getGoodForDevice();
            array_push($goods,$good);
        }
        $result_goods = $repair_order_has_good->combineGoodsRepairOrderHasGood($repair_order_has_goods,$goods);

        return response()->json($result_goods);
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
