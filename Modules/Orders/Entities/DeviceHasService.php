<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;

class DeviceHasService extends Model
{
    protected $fillable = [];

    public function store($device,$repair_order_id):DeviceHasService{
      foreach ($device['services_id'] as $service_id) {
        $this->device_id = $device['device_id'];
        $this->service_id = $service_id;
        $this->repair_order_id = $repair_order_id;
        $this->is_completed = 0;
        $this->save();
      }
      return $this;
    }
}
