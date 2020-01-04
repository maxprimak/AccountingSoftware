<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $fillable = ['name','days_number','is_active','company_id','is_default'];

    public function store($request){
      $this->name = $request->name;
      $this->days_number = $request->days_number;
      $this->is_active = $request->is_active;
      $this->company_id = $request->company_id;
      $this->is_default = $request->is_default;
      $this->save();
      return $this;
    }
}
