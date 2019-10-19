<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class Submodel extends Model
{
    protected $fillable = ['model_id','name'];

    public function store($request){
      $this->model_id = $request->model_id;
      $this->name = $request->name;
      $this->save();
    }
}
