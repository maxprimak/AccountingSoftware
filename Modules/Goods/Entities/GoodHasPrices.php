<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class GoodHasPrices extends Model
{
    protected $fillable = ['branch_has_good_id','supplier_id','retail_price','wholesale_price'];

    public function store($request){
      $this->branch_has_good_id = $request->branch_has_good_id;
      $this->supplier_id = $request->supplier_id;
      $this->retail_price = $request->retail_price;
      $this->wholesale_price = $request->wholesale_price;
      $this->save();
      return $this;
    }

    public function updateBranchHasGood($branch_has_good_id){
      $this->branch_has_good_id = $branch_has_good_id;
      $this->save();
      return $this;
    }
}
