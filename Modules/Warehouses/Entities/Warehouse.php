<?php

namespace Modules\Warehouses\Entities;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['branch_id','name'];

    public function store($request): Warehouse{
      $this->branch_id = $request->branch_id;
      $this->name = $request->name;
      $this->save();
      return $this;
    }

    public function storeUpdate($request): Warehouse{
      $this->name = $request->name;
      $this->save();
      return $this;
    }

    public function getBranchId(): int{
      return $this->branch_id;
    }
}
