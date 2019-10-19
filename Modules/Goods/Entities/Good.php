<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = ['name','branch_id','brand_id','model_id',
    'submodel_id','part_id','color_id','amount','price'];


    public function store($request){

      $this->part_id = $request->part_id;
      $this->branch_id = $request->branch_id;
      $this->brand_id = $request->brand_id;
      $this->model_id = $request->model_id;
      $this->submodel_id = $request->submodel_id;
      $this->color_id = $request->color_id;
      $this->amount = $request->amount;
      $this->price = $request->price;
      $this->save();

      return $this;
    }
}
