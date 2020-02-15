<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;

class DeviceHasService extends Model
{
    protected $fillable = ['device_id', 'service_id', 'repair_order_id', 'is_completed'];

    public function store($device,$service_id,$repair_order_id):DeviceHasService{
      $this->device_id = $device['device_id'];
      $this->service_id = $service_id;
      $this->repair_order_id = $repair_order_id;
      $this->is_completed = 0;
      $this->save();
      return $this;
    }

    public function completeService(){
      $this->is_completed = 1;
      $this->save();
    }
}
