<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class BranchHasGood extends Model
{
    protected $fillable = ['good_id','branch_id'];

    public function store($request): BranchHasGood{
      $this->good_id = $request->good_id;
      $this->branch_id = $request->branch_id;
      $this->save();
      return $this;
    }

    public function storeUpdate($good_id): BranchHasGood{
      $this->good_id = $good_id;
      $this->save();
      return $this;
    }
}
