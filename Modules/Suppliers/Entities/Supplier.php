<?php

namespace Modules\Suppliers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Notifications\Notifiable;
use Modules\Companies\Entities\Address;
use Modules\Companies\Entities\City;
use Modules\Companies\Entities\Country;

class Supplier extends Model
{
    protected $fillable = [];

    use Notifiable;

    public function routeNotificationForWhatsApp()
    {
        return $this->phone;   
    }

    public function addAddressInfo(){
        $address_id = $this->getAddressId();
        $address = Address::find($address_id);
        $this->street_name = $address->street_name;
        $this->postcode = $address->postcode;
        $this->house_number = $address->house_number;
        $city = City::find($address->city_id);
        $country = Country::find($city->country_id);
        $this->city_id = $city->id;
        $this->country_id = $country->id;
        $this->city_name = $city->name;
        $this->country_name = $country->name;
        return $this;
    }

    public function store(FormRequest $request){

        $this->updateMainInfo($request);
        $this->save();
        $this->storeAddress($request);

    }

    public function edit(FormRequest $request){

        $this->updateMainInfo($request);
        $this->updateAddress($request);
        $this->save();

    }

    public function removeFromDB(){
        SupplierHasAddress::where('supplier_id', $this->id)->delete();
        $this->delete();
    }

    private function updateMainInfo($request){
        $this->name = $request->name;
        $this->phone = $request->phone;
        $this->email = $request->email;
        $this->comment = $request->comment;
    }

    private function storeAddress($request){
        $address = new Address();
        $address = $this->saveAddress($address, $request);
        $this->attachAddress($address);
    }

    private function updateAddress($request){

        $address = Address::find($this->getAddressId());
        $this->saveAddress($address, $request);

    }

    private function attachAddress($address){
        $has_address = new SupplierHasAddress();
        $has_address->address_id = $address->id;
        $has_address->supplier_id = $this->id;
        $has_address->save();
    }  

    private function saveAddress($address, $request){
        $city = City::firstOrCreate([
            'name' => $request->city_name,
            'country_id' => $request->country_id,
        ]);
        $address->city_id = $city->id;
        $address->street_name = $request->street_name;
        $address->house_number = $request->house_number;
        $address->postcode = $request->postcode;
        $address->save();
        return $address;
    }

    private function getAddressId(){
        return SupplierHasAddress::where('supplier_id', $this->id)->first()->address_id;
    }
}
