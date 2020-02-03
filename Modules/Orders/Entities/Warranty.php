<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $fillable = ['name','days_number','is_active','company_id','is_default'];

    public function store($request){
      $company = auth('api')->user()->getCompany();
      $this->name = $request->name;
      $this->days_number = $request->days_number;
      $this->is_active = 1;
      $this->company_id = $company->id;
      $this->is_default = $request->is_default;
      $this->save();
      return $this;
    }

    public static function createDefaultForNewCompany($company_id){
      $warranty = new Warranty();
      $warranty->name = "Default Warranty";
      $warranty->days_number = 30;
      $warranty->is_active = 1;
      $warranty->company_id = $company_id;
      $warranty->is_default = 1;
      $warranty->save();
    }
}
