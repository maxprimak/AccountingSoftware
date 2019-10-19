<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = ['name'];

    public function store($request){
      $this->name = $request->name;
      $this->save();
      
      return $this;
    }
}
