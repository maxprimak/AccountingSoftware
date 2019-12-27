<?php

namespace Modules\Warehouses\Entities;

use Illuminate\Database\Eloquent\Model;

class WarehouseHasGood extends Model
{
    protected $fillable = ['good_id','warehouse_id','location_in_warehouse_id','amount','vendor_code'];

    public function checkIfExistsOnWarehouse($request){
      $existing_warehouse_has_good = $this::where([['good_id','=', $request->good_id],
                                                  ['warehouse_id','=', $request->warehouse_id]])->first();

      return $existing_warehouse_has_good;
    }
    public function store($request){
      $existing_warehouse_has_good = $this->checkIfExistsOnWarehouse($request);

      if($existing_warehouse_has_good){
        return $existing_warehouse_has_good;
      }

      $this->good_id = $request->good_id;
      $this->warehouse_id = $request->warehouse_id;
      //$this->location_in_warehouse_id = $request->location_in_warehouse_id;
      $this->amount = $request->amount;
      $this->vendor_code = $request->vendor_code;
      $this->save();
      return $this;
    }

    public function edit($request){
      $this->amount = $request->amount;
      $this->vendor_code = $request->vendor_code;
      $this->save();
      return $this;
    }

    public function storeUpdate($request){
      $this->good_id = $request->good_id;
      $this->save();
      $this->edit($request);
      return $this;
    }

    public function moveToAnotherWarehouse($request){
      $existing_warehouse_has_good = WarehouseHasGood::where('good_id',$this->good_id)->where('warehouse_id', $request->warehouse_id)->first();
      if(!$existing_warehouse_has_good){
        $new_warehouse_has_good = new WarehouseHasGood();
        $new_warehouse_has_good->good_id = $this->good_id;
        $new_warehouse_has_good->warehouse_id = $request->warehouse_id;
        $new_warehouse_has_good->amount = $request->amount;
        $new_warehouse_has_good->vendor_code = $this->vendor_code;
        $new_warehouse_has_good->save();
      }else{
        $existing_warehouse_has_good->amount += $request->amount;
        $existing_warehouse_has_good->save();
      }
      $this->amount -= $request->amount;
      $this->save();
      return $this;
    }
}
