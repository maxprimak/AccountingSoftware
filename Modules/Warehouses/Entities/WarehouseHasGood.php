<?php

namespace Modules\Warehouses\Entities;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Warehouses\Entities\WarehouseHasGood;
use Modules\Goods\Entities\Good;

class WarehouseHasGood extends Model
{
    protected $fillable = ['good_id','warehouse_id','location_in_warehouse_id','amount','vendor_code'];

    public function checkIfExistsOnWarehouse($request){
      $existing_warehouse_has_good = $this::where([['good_id','=', $request->good_id],
                                                  ['warehouse_id','=', $request->warehouse_id]])->first();

      return $existing_warehouse_has_good;
    }

    public function store(FormRequest $request){
      // $existing_warehouse_has_good = $this->checkIfExistsOnWarehouse($request);
      //
      // if($existing_warehouse_has_good){
      //   return $existing_warehouse_has_good;
      // }

      $this->good_id = $request->good_id;
      $this->warehouse_id = $request->warehouse_id;
      //$this->location_in_warehouse_id = $request->location_in_warehouse_id;
      $this->amount = $request->amount;
      $this->vendor_code = $request->vendor_code;
      $this->save();
      return $this;
    }

    public function edit(FormRequest $request){
      $this->amount = $request->amount;
      $this->vendor_code = $request->vendor_code;
      $this->save();
      return $this;
    }

    public function moveToAnotherWarehouse($request){
      $existing_good = Good::find($this->good_id);
      $good_ids = Good::where([
      ['part_id',$existing_good->part_id],
      ['brand_id',$existing_good->brand_id],['model_id',$existing_good->model_id],
      ['submodel_id',$existing_good->submodel_id],['color_id',$existing_good->color_id]
      ])->pluck('id')->toArray();

      $existing_good_in_target_warehouse = WarehouseHasGood::whereIn('good_id',$good_ids)->where('warehouse_id', $request->warehouse_id)->first();
      if($existing_good_in_target_warehouse){
        $existing_good_in_target_warehouse->amount += $request->amount;
        $existing_good_in_target_warehouse->save();
      }else{
        $request->part_id = $existing_good->part_id;
        $request->brand_id = $existing_good->brand_id;
        $request->model_id = $existing_good->model_id;
        $request->submodel_id = $existing_good->submodel_id;
        $request->color_id = $existing_good->color_id;
        $request->vendor_code = $this->vendor_code;

        $good = new Good();
        $good->store($request);
      }
      $this->amount -= $request->amount;
      $this->save();

      return $this;
    }
}
