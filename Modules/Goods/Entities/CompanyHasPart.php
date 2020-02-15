<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class CompanyHasPart extends Model
{
    protected $fillable = ['company_id','part_id'];

    public function store($request): CompanyHasPart{
      $this->company_id = $request->company_id;
      $this->part_id = $request->part_id;
      $this->save();
      return $this;
    }
}
