<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $fillable = ['brand_id','name'];

    public function store($request){
      $this->brand_id = $request->brand_id;
      $this->name = $request->name;
      $this->logo = $request->logo;
      $this->save();
    }
}
