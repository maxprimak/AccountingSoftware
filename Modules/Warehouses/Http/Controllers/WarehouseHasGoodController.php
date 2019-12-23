<?php

namespace Modules\Warehouses\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Warehouses\Entities\WarehouseHasGood;
use Modules\Warehouses\Http\Requests\moveGoodToWarehouseRequest;
use Modules\Warehouses\Http\Requests\UpdateWarehouseHasGoodRequest;




class WarehouseHasGoodController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('warehouses::index');
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

    public function moveGoodToWarehouse(moveGoodToWarehouseRequest $request)
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
        $warehouse_has_good->delete();
        return response()->json(['message' => 'Successfully deleted!']);
    }
}
