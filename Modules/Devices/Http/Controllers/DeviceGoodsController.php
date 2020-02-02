<?php

namespace Modules\Devices\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Devices\Http\Requests\UseGoodsRequest;
use Modules\Orders\Entities\RepairOrder;
use Modules\Warehouses\Entities\WarehouseHasGood;
use Modules\Devices\Entities\Device;



class DeviceGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('devices::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('devices::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(UseGoodsRequest $request)
    {
        $goods = $request->goods;

        foreach($goods as $good){
            $warehouse_has_good = WarehouseHasGood::find($good['warehouse_has_good_id']);
            try{
                $warehouse_has_good->use($good['amount']);
            }catch(\Exception $e){
                return response()->json(['error' => $e->getMessage()], 403);
            }
        }

        return response()->json(['message' => 'successfully used'], 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('devices::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('devices::edit');
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
