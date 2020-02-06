<?php

namespace Modules\Devices\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\DeviceHasService;
use Modules\Services\Entities\Service;
use Modules\Devices\Http\Requests\CompleteServiceRequest;

class DeviceHasServiceController extends Controller
{
    public function show($device_id){

        return response()->json(DeviceHasService::where('device_id', $device_id)->get());

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function index()
    {
        return view('devices::index');
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
    public function update(CompleteServiceRequest $request)
    {
        if($request->device_has_services_id == []){
            $device_has_services = DeviceHasService::where('device_id', $request->device_id)
                                    ->where('repair_order_id', $request->repair_order_id)->get();
            foreach($device_has_services as $device_has_service){
                $device_has_service->is_completed = 0;
                $device_has_service->save();
            }

            return response()->json([
                'message' => 'services completed',
            ]);
        }

        $device_has_services_id = $request->device_has_services_id;
        $device_has_service = DeviceHasService::whereIn('id',$device_has_services_id)->first();
        $device_has_services = DeviceHasService::where('device_id',$device_has_service->device_id)->where('repair_order_id',$device_has_service->repair_order_id)->get();
        foreach ($device_has_services as $device_has_service){
            $device_has_service->is_completed = 0;
            $device_has_service->save();
        }

        foreach($device_has_services_id as $device_has_service_id){
            try{
                $device_has_service = DeviceHasService::findOrFail($device_has_service_id);
                $device_has_service->completeService();
            }catch(\Exception $e){
                return response()->json(['error' => 'device_has_service_id '. $device_has_service_id .' is not valid'],403);
            }

        }

        return response()->json([
            'message' => 'services completed',
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
