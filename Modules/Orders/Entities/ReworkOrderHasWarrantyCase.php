<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\RepairOrderHasDevice;

class ReworkOrderHasWarrantyCase extends Model
{
    protected $fillable = [];

    public function store($device, $rework_order_id) : ReworkOrderHasWarrantyCase
    {
        $this->rework_order_id = $rework_order_id;
        $rep_order_has_device = RepairOrderHasDevice::where('repair_order_id', $device['warranty_case_order_id'])
                                ->where('device_id', $device['id'])->firstOrFail();
        $this->order_has_device_id = $rep_order_has_device->id;
        $this->save();
        return $this;
    }
}
