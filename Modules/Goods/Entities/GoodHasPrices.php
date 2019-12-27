<?php

namespace Modules\Goods\Entities;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\BranchHasGood;

class GoodHasPrices extends Model
{
    protected $fillable = ['good_id','branch_id','supplier_id','retail_price','wholesale_price'];

    public function store(FormRequest $request){
      $this->good_id = $request->good_id;
      $this->branch_id = $request->branch_id;
      $this->supplier_id = $request->supplier_id;
      $this->retail_price = $request->retail_price;
      $this->wholesale_price = $request->wholesale_price;
      $this->save();
      return $this;
    }

    public function edit(FormRequest $request){
      $this->retail_price = $request->retail_price;
      $this->wholesale_price = $request->wholesale_price;
      $this->save();
      return $this;
    }
}
