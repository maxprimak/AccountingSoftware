<?php

namespace Modules\Devices\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Devices\Entities\CustomerHasDevice;

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

}
