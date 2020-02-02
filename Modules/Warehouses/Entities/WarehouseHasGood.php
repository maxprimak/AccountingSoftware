<?php

namespace Modules\Warehouses\Entities;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Branch;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Color;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Part;
use Modules\Goods\Entities\Good;
use Exception;

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

    public function use($amount){

      $warehouse_amount = $this->amount;

      if($warehouse_amount >= $amount && $amount >= 0){
        $this->amount -= $amount;
      }
      else{
        throw new \Exception('Amount for warehouse_has_good with id ' . $this->id. ' is invalid');
      }

      $this->save();

    }

    public function moveToAnotherWarehouse($request){
      $existing_good = Good::find($this->good_id);
      $good_ids = Good::where([
      ['part_id',$existing_good->part_id],
      ['brand_id',$existing_good->brand_id],['model_id',$existing_good->model_id],
      ['submodel_id',$existing_good->submodel_id],['color_id',$existing_good->color_id]
      ])->pluck('id')->toArray();

      $existing_good_in_target_warehouse = $this::whereIn('good_id',$good_ids)->where('warehouse_id', $request->warehouse_id)->first();
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

    public function getGoodForDevice(){
        $warehouse = Warehouse::find($this->warehouse_id);
        $good = Good::find($this->good_id);
        $color = Color::find($good->color_id);
        $part = Part::find($good->part_id);
        $brand = Brand::find($good->brand_id);
        $model = Models::find($good->model_id);

        $result_good = array();
        $result_good['id'] = $good->id;
        $result_good['branch_name'] = $warehouse->name;
        $result_good['color_name'] = $color->name;
        $result_good['color_hex_code'] = $color->hex_code;
        $result_good['part_name'] = $part->getTranslatedName();
        $result_good['brand_name'] = $brand->name;
        $result_good['model_name'] = $model->name;
        $result_good['warehouse_has_good_id'] = $this->id;
        $result_good['amount_in_warehouse'] = $this->amount;
        return $result_good;
    }
}
