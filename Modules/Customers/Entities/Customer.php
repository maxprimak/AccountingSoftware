<?php

namespace Modules\Customers\Entities;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = ['person_id','email','stars_number','type_id','company_id','created_by'];
  protected $appends = ['branch_id'];

  public function __construct(array $attributes = array()){
      parent::__construct($attributes);
  }

  public function store($request){
      // foreach ($request as $key => $value) {
      //   $this->$key = $request[$value];
      // }
      $this->person_id = $request['person_id'];
      $this->email = $request['email'];
      $this->type_id = $request['type_id'];
      $this->company_id = $request['company_id'];
      $this->created_by = $request['created_by'];

      $this->save();

      return $this;
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

}
