<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;

class ReworkOrderHasWarrantyCase extends Model
{
    protected $fillable = [];

    public function store($device, $rework_order_id) : ReworkOrderHasWarrantyCase
    {
        $this->rework_order_id = $rework_order_id;
        $this->order_has_device_id = $device['order_has_device_id'];
        $this->save();
        return $this;
    }
}
