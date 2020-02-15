<?php

namespace Modules\Devices\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Devices\Entities\Device;
use Modules\Devices\Entities\CustomerHasDevice;
use Modules\Devices\Http\Requests\StoreDeviceRequest;
use Modules\Devices\Http\Requests\UpdateDeviceRequest;

class DevicesController extends Controller
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
    public function store(StoreDeviceRequest $request)
    {
        
        $device = new Device();
        $device->store($request, $request->customer_id);

        $device->status_name = "No Status";
        $device->status_hexcode = "#CCCCCC";
        $device->last_request = "None";

        return response()->json([
            "message" => "device created",
            "device" => $device
        ]);

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
    public function update(UpdateDeviceRequest $request, $id)
    {

        $device = Device::find($id);
        $device->storeUpdated($request);

        return response()->json([
            "message" => "device updated"
        ]);
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
