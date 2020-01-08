<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RepairOrderHasDevice extends Model
{
    protected $fillable = [];

    public function store($device,$repair_order_id):RepairOrderHasDevice{
      $this->defect_description = $device['defect_description'];
      $this->repair_order_id = $repair_order_id;
      $this->device_id = $device['device_id'];
      $this->save();
      return $this;
    }
}
