<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Model;

class ServiceHasPart extends Model
{
    protected $fillable = [];

    public function store($part, $service_id){

        $this->part_id = $part->id;
        $this->service_id = $service_id;
        $this->save();

    }

}
