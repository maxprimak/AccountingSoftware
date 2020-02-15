<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class CompanyHasSubmodel extends Model
{
    protected $fillable = ['company_id','submodel_id'];

    public function store($request): CompanyHasSubmodel{
      $this->company_id = $request->company_id;
      $this->submodel_id = $request->submodel_id;
      $this->save();
      return $this;
    }
}
