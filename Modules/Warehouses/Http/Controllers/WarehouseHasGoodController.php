<?php

namespace Modules\Warehouses\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Warehouses\Entities\WarehouseHasGood;
use Modules\Warehouses\Entities\Warehouse;
use Modules\Goods\Entities\GoodHasPrices;
use Modules\Goods\Entities\Good;
use Modules\Warehouses\Http\Requests\MoveGoodToWarehouseRequest;
use Modules\Warehouses\Http\Requests\UpdateWarehouseHasGoodRequest;

class WarehouseHasGoodController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id)
    {
        $has_good = WarehouseHasGood::find($id);
        $has_good->warehouse_name = Warehouse::find($has_good->warehouse_id)->name;

        return response()->json($has_good);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('warehouses::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('warehouses::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('warehouses::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateWarehouseHasGoodRequest $request, $id)
    {
      $warehouse_has_good = WarehouseHasGood::find($request->warehouse_has_good_id);
      $warehouse_has_good = $warehouse_has_good->edit($request);
      return response()->json(['message' => 'Successfully updated!']);;
    }

    public function moveGoodToWarehouse(MoveGoodToWarehouseRequest $request)
    {
      $warehouse_has_good = WarehouseHasGood::find($request->warehouse_has_good_id);
      $warehouse_has_good = $warehouse_has_good->moveToAnotherWarehouse($request);
      return response()->json(['message' => $request->amount.' goods are successfully moved!']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $warehouse_has_good = WarehouseHasGood::find($id);
        $good = Good::find($warehouse_has_good->good_id);
        $warehouse = Warehouse::find($warehouse_has_good->warehouse_id);
        $good_has_prices = GoodHasPrices::where('good_id',$good->id)->where('branch_id',$warehouse->getBranchId())->first();

        $warehouse_has_good->delete();
        $good_has_prices->delete();
        $good->delete();
        return response()->json(['message' => 'Successfully deleted!']);
    }
}
