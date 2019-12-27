<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['name'];

    public function store($request){
      $this->name = $request->name;
      $this->hex_code = $request->hex_code;
      $this->save();
      return $this;
    }
}
