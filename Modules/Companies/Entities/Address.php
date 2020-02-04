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

    public static function makeCopy($address){
      $new_address = new Address();
      $new_address->street_name = $address->street_name;
      $new_address->postcode = $address->postcode;
      $new_address->house_number = $address->house_number;
      $new_address->city_id = $address->city_id;
      $new_address->save();

      return $new_address;
    }
}
