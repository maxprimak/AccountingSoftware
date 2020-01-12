<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Devices\Entities\DeviceHasDeviceLocations;
use Modules\Orders\Entities\DeviceHasService;
use Modules\Orders\Entities\RepairOrderHasDevice;
use Modules\Orders\Entities\RepairOrderHasGood;
use Modules\Orders\Http\Requests\DeleteRepairOrderHasDeviceRequest;
use mysql_xdevapi\Exception;

class RepairOrderHasDeviceController extends Controller
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
    public function destroy(DeleteRepairOrderHasDeviceRequest $request, $repair_order_id)
    {
        $repair_order_has_devices = RepairOrderHasDevice::where('repair_order_id',$repair_order_id)->get();
        $repair_order_has_goods = RepairOrderHasGood::where('repair_order_id',$repair_order_id)
            ->where('device_id',$request->device_id)
            ->get();
        if(sizeof($repair_order_has_devices) > 1){
            foreach ($repair_order_has_goods as $repair_order_has_good){
                $repair_order_has_good->delete();
            }

            $device_has_service = DeviceHasService::where('repair_order_id',$repair_order_id)
                ->where('device_id',$request->device_id)
                ->get();
            $device_has_service->delete();

//        $device_has_service= DeviceHasDeviceLocations::where('device_id',$request->device_id)->first();
//        $device_has_service->delete();

            $repair_order_has_device = RepairOrderHasDevice::where('repair_order_id',$repair_order_id)
                ->where('device_id',$request->device_id)->first();
            $repair_order_has_device->delete();

            return response()->json("Successfully deleted!");
        }else{
            return response()->json("You can not delete last Device");
        }

    }
}
