<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class CompanyHasBrands extends Model
{
    protected $fillable = ['company_id','brand_id'];

    public function store($company_id,$brand_id): CompanyHasBrands{
      $this->company_id = $company_id;
      $this->brand_id = $brand_id;
      $this->save();
      return $this;
    }
}
