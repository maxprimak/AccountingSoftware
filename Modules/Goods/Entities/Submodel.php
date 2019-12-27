<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\CompanyHasSubmodel;

class Submodel extends Model
{
    protected $fillable = ['model_id','name'];

    public function store($request){
      $this->model_id = $request->model_id;
      $this->name = $request->name;
      $this->is_custom = 1;
      $this->save();
      $this->addToCompany($request);
      return $this;
    }

    public function getName(){

      $submodel_name = $this->name;
      $model = Models::find($this->model_id);
      $model_name = $model->name;
      $brand = Brand::find($model->brand_id);

      return $brand->name . " " .$model_name . " " . $submodel_name;

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

    public function checkIfExistsInCompany(){
      $company = auth('api')->user()->getCompany();
      return CompanyHasSubmodel::where('company_id',$company->id)->where('submodel_id',$this->id)->exists();
    }

    public function addToCompany($request){
      $company = auth('api')->user()->getCompany();
      $request->company_id = $company->id;
      $request->submodel_id = $this->id;
      $company_has_submodel = new CompanyHasSubmodel();
      $company_has_submodel = $company_has_submodel->store($request);
      return $company_has_submodel;
    }
}
