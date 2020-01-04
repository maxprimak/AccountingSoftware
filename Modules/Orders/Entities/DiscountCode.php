<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $fillable = ['name','percent_amount','is_active','company_id'];

    public function store($request){
      $company = auth('api')->user()->getCompany();
      $this->name = $request->name;
      $this->percent_amount = $request->percent_amount;
      $this->company_id = $company->id;
      $this->save();
      return $this;
    }
}
