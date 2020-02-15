<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class CompanyHasModels extends Model
{
    protected $fillable = ['company_id','model_id'];

    public function store($company_id,$model_id): CompanyHasModels{
      $this->company_id = $company_id;
      $this->model_id = $model_id;
      $this->save();
      return $this;
    }
}
