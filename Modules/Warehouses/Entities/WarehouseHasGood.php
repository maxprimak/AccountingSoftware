<?php

namespace Modules\Warehouses\Entities;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Modules\Barcodes\Entities\Barcode;
use Modules\Companies\Entities\Branch;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Color;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Submodel;
use Modules\Goods\Entities\Part;
use Modules\Goods\Entities\Good;
use Modules\Orders\Entities\RepairOrderHasGood;
use Modules\Warehouses\Entities\Warehouse;
use Exception;
use Modules\Services\Entities\Language;

class WarehouseHasGood extends Model
{
    use Searchable;

    protected $fillable = ['good_id','warehouse_id','location_in_warehouse_id','amount','vendor_code'];

    public function checkIfExistsOnWarehouse($request){
      $existing_warehouse_has_good = $this::where([['good_id','=', $request->good_id],
                                                  ['warehouse_id','=', $request->warehouse_id]])->first();

      return $existing_warehouse_has_good;
    }

    public function store(FormRequest $request){
      $this->good_id = $request->good_id;
      $this->warehouse_id = $request->warehouse_id;
      //$this->location_in_warehouse_id = $request->location_in_warehouse_id;
      $this->amount = $request->amount;
      $this->vendor_code = $request->vendor_code;
      if($request->barcode_id) {
          $this->barcode_id = $request->barcode_id;
          $this->barcode_value = Barcode::findOrFail($request->barcode_id)->value;
      }
      $this->save();
      return $this;
    }

    public function edit(FormRequest $request){
      $this->amount = $request->amount;
      $this->vendor_code = $request->vendor_code;
      $this->save();
      return $this;
    }

    public function use($amount, $repair_order_id, $device_id){

          $has_good = RepairOrderHasGood::where('warehouse_has_good_id', $this->id)
          ->where('repair_order_id', $repair_order_id)->where('device_id',$device_id)->first();

          $amount = ($has_good->is_used == 0) ? $amount : $amount - $has_good->amount;

          if($amount >= 0 && $amount <= $this->amount){

            if($has_good->is_used == 0){
              $has_good->amount = $amount;
              $has_good->is_used = 1;
            }
            else{
              $has_good->amount += $amount;
            }
            $has_good->save();

          }else{
             throw new \Exception('given amount is invalid for good id '. $this->good_id);
          }

          $this->amount -= $amount;

          $this->save();

    }

    public function getWarehouseName(){
      $warehouse = Warehouse::find($this->warehouse_id);
      return $warehouse->name;
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
        $submodel = Submodel::find($good->submodel_id);
        $brand = Brand::find($good->brand_id);
        $model = Models::find($good->model_id);

        $result_good = array();
        $result_good['id'] = $good->id;
        $result_good['branch_name'] = $warehouse->name;
        $result_good['color_name'] = $color->name;
        $result_good['color_hex_code'] = $color->hex_code;
        $result_good['part_name'] = $part->getTranslatedName(Language::getMyLanguageId());
        $result_good['brand_name'] = $brand->name;
        $result_good['model_name'] = $model->name;
        $result_good['submodel_name'] = $submodel->name;
        $result_good['name'] = $brand->name . ' ' . $submodel->name;
        $result_good['warehouse_has_good_id'] = $this->id;
        $result_good['amount_in_warehouse'] = $this->amount;
        return $result_good;
    }

    public function barcode(){
        return $this->belongsTo (Barcode::class);
    }

    public function warehouse(){
        return $this->belongsTo (Warehouse::class);
    }

    public function goods() {
        return $this->hasMany (Good::class, 'id', 'good_id');
    }
}
