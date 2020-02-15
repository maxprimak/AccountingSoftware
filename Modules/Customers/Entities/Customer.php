<?php

namespace Modules\Customers\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\People;

class Customer extends Model
{
  protected $fillable = ['person_id','email','stars_number','type_id','company_id','created_by'];

  public function __construct(array $attributes = array()){
      parent::__construct($attributes);
  }

  public function store($request){
      $this->person_id = $request['person_id'];
      $this->email = $request['email'];
      $this->type_id = $request['type_id'];
      $this->company_id = $request['company_id'];
      $this->created_by = $request['created_by'];

      $this->save();

      return $this;
  }

  public function storeFromOrder($name, $phone, $company_id){

    $person = new People();
    $person->name = $name;
    $person->phone = $phone;
    $person->save();

    $this->person_id = $person->id;
    $this->type_id = 1;
    $this->company_id = $company_id;
    $this->created_by = auth('api')->id();

    $this->save();

    return $this;

  }

  public function updateFromOrder($name, $phone, $id){

    $customer = Customer::find($id);

    $person = People::find($customer->person_id);
    $person->name = $name;
    $person->phone = $phone;
    $person->save();

    return $customer;

  }

  public function storeUpdated($request){

      $this->email = $request->email;
      $this->stars_number = $request->stars_number;
      $this->type_id = $request->type_id;
      $this->save();

      return $this;
  }

  public function saveStarsNumber($request){
      $this->stars_number = $request->stars_number;
      $this->save();
      
      return $this;
  }

  public function getPerson(){
    return People::find($this->person_id);
  }

}
