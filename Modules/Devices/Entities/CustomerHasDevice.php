<?php

namespace Modules\Devices\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomerHasDevice extends Model
{
    protected $fillable = [];

    public function store($customer_id, $device_id){

        $this->customer_id = $customer_id;
        $this->device_id = $device_id;
        $this->save();
        
    }
}
