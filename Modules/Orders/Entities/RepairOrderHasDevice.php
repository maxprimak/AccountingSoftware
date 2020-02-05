<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Devices\Entities\Device;
use DB;

class RepairOrderHasDevice extends Model
{
    protected $fillable = [];

    public static function getDevicesOfOrderWithServices($repair_order)
    {
        $repair_order_has_devices = RepairOrderHasDevice::where('repair_order_id',$repair_order->id)->get();
        $devices_ids = RepairOrderHasDevice::where('repair_order_id',$repair_order->id)->pluck('device_id');
        $devices = Device::whereIn('id',$devices_ids)->get();
        $device_has_services = DeviceHasService::whereIn('device_id',$devices_ids)->get();
        $services_ids = DeviceHasService::whereIn('device_id',$devices_ids)->pluck('service_id');
        $company = auth('api')->user()->getCompany();
        $services = DB::table('services')
            ->join('services_translations','services_translations.service_id', '=', 'services.id')
            ->join('device_has_services','device_has_services.service_id', '=', 'services.id')
            ->select('services.id as id', 'services.is_custom as is_custom','services_translations.name as name','device_has_services.id as device_has_services_id')
            ->whereIn('services.id',$services_ids)
            ->whereIn('device_has_services.device_id',$devices_ids)
            ->where('device_has_services.repair_order_id',$repair_order->id)
            ->where('services_translations.language_id',$company->language_id)
            ->get();
        return $repair_order->combineDevicesWithServices($devices,$services,$repair_order_has_devices,$device_has_services);
    }

    public function store($device,$repair_order_id):RepairOrderHasDevice{
      $this->defect_description = $device['defect_description'];
      $this->repair_order_id = $repair_order_id;
      $this->device_id = $device['device_id'];
      $this->save();
      return $this;
    }
}
