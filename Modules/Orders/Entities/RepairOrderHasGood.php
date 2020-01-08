<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;

class RepairOrderHasGood extends Model
{
    protected $fillable = [];

    public function store($device,$repair_order_id):RepairOrderHasGood{
      foreach ($device['warehouse_has_good'] as $warehouse_has_good) {
        $this->repair_order_id = $repair_order_id;
        $this->warehouse_has_good_id = $warehouse_has_good['id'];
        $this->is_used = 0;
        $this->amount = $warehouse_has_good['amount'];
        $this->device_id = $device['device_id'];
        $this->save();
      }
      return $this;
    }
}
