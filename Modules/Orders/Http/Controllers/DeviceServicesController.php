<?php

namespace Modules\Orders\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Devices\Entities\Device;
use Modules\Orders\Entities\DeviceHasService;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Http\Requests\IndexDeviceServiceRequest;
use Modules\Orders\Http\Requests\UpdateDeviceServicesRequest;

class DeviceServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param IndexDeviceServiceRequest $request
     * @param $device_id
     * @return Response
     */
    public function index(IndexDeviceServiceRequest $request,$device_id)
    {   
        $company = auth('api')->user()->getCompany();
        $services_ids = DeviceHasService::where('device_id',$device_id)->where('repair_order_id',$request->repair_order_id)->pluck('service_id');
        $device_has_services = DeviceHasService::where('device_id',$device_id)->where('repair_order_id',$request->repair_order_id)->get();

        $services = DB::table('services')
            ->join('services_translations','services_translations.service_id', '=', 'services.id')
            ->select('services.id as id', 'services.is_custom as is_custom','services_translations.name as name')
            ->whereIn('services.id',$services_ids)
            ->where('services_translations.language_id',$company->language_id)
            ->get();

        foreach ($device_has_services as $device_has_service){
            foreach ($services as $service){
                if($device_has_service->service_id == $service->id){
                    $service->is_completed = $device_has_service->is_completed;
                    $service->repair_order_id = $device_has_service->repair_order_id;
                }
            }
        }

        return response()->json($services);
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
    public function update(UpdateDeviceServicesRequest $request, $device_id)
    {
        $repair_order = RepairOrder::findOrFail($request->repair_order_id);
        $device = Device::findOrFail($device_id);
       $device_has_services = DeviceHasService::where('device_id',$device_id)->where('repair_order_id',$request->repair_order_id)->get();
           foreach ($device_has_services as $device_has_service){
               $device_has_service->delete();
           }
        $device = (array) $device;
        $device['device_id'] = $device_id;
        $device['services_id'] = array();
        $device['services_id'] = $request->services_id;
        $repair_order->storeDeviceHasService($device);

        return response()->json(['message' => 'Services are successfully updated!']);
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
