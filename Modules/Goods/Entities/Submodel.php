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

    public function getName(){

      $submodel_name = $this->name;
      $model = Models::find($this->model_id);
      $model_name = $model->name;

      return $model_name . " " . $submodel_name;

    }

    public function getBrandName(){

      $submodel_name = $this->name;
      $model = Models::find($this->model_id);
      $brand = Brand::find($model->brand_id);

      return $brand->name;

    }

    public function getModelName(){

      $submodel_name = $this->name;
      $model = Models::find($this->model_id);
      $model_name = $model->name;

      return $model_name;

    }

    public function getSubmodelName(){

      $submodel_name = $this->name;

      return $submodel_name;

    }
}
