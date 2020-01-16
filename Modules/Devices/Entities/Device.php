<?php

namespace Modules\Devices\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Devices\Entities\CustomerHasDevice;
use Modules\Orders\Entities\RepairOrderHasDevice;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\OrderStatus;

class Device extends Model
{
    protected $fillable = [];

    public function store(FormRequest $request, $customer_id){

        $this->submodel_id = $request->submodel_id;
        $this->color_id = $request->color_id;
        $this->serial_nr = $request->serial_nr;
        $this->condition = $request->condition;
        $this->save();

        $customer_has_device = new CustomerHasDevice();
        $customer_has_device->store($customer_id, $this->id);

    }

    public function storeUpdated(FormRequest $request){

        $this->submodel_id = $request->submodel_id;
        $this->color_id = $request->color_id;
        $this->serial_nr = $request->serial_nr;
        $this->condition = $request->condition;
        $this->save();

    }

    public function getStatus(){

        if(RepairOrderHasDevice::where('device_id')->exists()){

            $query = RepairOrderHasDevice::where('device_id')->orderBy('created_at', 'DESC')->first();
            $query_order = RepairOrder::find($query->repair_order_id);
            $status = OrderStatus::find($query_order->status_id);

            $has_device = array();
            $has_device['name'] = $status->getTranslatedName();
            $has_device['hexcode'] = $status->hex_code;
            $has_device['last_request'] = $query->created_at;

            return $has_device;

        }else{
            
            $has_device = array();
            $has_device['name'] = "None";
            $has_device['hexcode'] = "#CCCCCC";
            $has_device['last_request'] = "None";

            return $has_device;

        }

    }

}
