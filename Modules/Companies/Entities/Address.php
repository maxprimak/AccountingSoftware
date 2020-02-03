<?php

namespace Modules\Companies\Entities;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [];

    public function store($request){

        $this->street_name = $request->street_name;
        $this->postcode = $request->postcode;
        $this->street_name = $request->street_name;
        $this->house_number = $request->house_number;
        $this->city_id = $request->city_id;
        $this->save();
  
      }
}
