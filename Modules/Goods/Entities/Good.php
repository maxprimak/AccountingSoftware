<?php

namespace Modules\Goods\Entities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Warehouses\Entities\WarehouseHasGood;
use Modules\Goods\Entities\GoodHasPrices;
use Modules\Warehouses\Entities\Warehouse;



class Good extends Model
{
    protected $fillable = ['name','brand_id','model_id',
    'submodel_id','part_id','color_id'];


    public function store(FormRequest $request): Good{

      $this->part_id = $request->part_id;
      $this->brand_id = $request->brand_id;
      $this->model_id = $request->model_id;
      $this->submodel_id = $request->submodel_id;
      $this->color_id = $request->color_id;
      $this->save();

      // ADD THIS GOOD TO BRANCH
      $this->addToBranch($request);
      return $this;
    }

    public function check_if_exists($request){
      $existing_good = Good::where([['brand_id','=', $request->brand_id],
                                    ['color_id','=', $request->color_id],['model_id','=', $request->model_id],
                                    ['submodel_id','=', $request->submodel_id],['part_id','=', $request->part_id]
                                    ])->first();
      return $existing_good;
    }

    public function edit(FormRequest $request): Good{
      $this->part_id = $request->part_id;
      $this->color_id = $request->color_id;
      $this->save();

      $warehouse_has_good = WarehouseHasGood::find($request->warehouse_has_good_id);
      $warehouse = Warehouse::find($warehouse_has_good->warehouse_id);
      $good_has_prices = GoodHasPrices::where('good_id',$this->id)->where('branch_id',$warehouse->getBranchId())->first();
      $warehouse_has_good->edit($request);
      $good_has_prices->edit($request);
      return $this;
    }

    public function addToBranch(FormRequest $request){
      $request->good_id = $this->id;
      $request->branch_id = $this->getBranchIdOfWarehouse($request);

      $warehouse_has_good = new WarehouseHasGood();
      $warehouse_has_good = $warehouse_has_good->store($request);
      
      $good_has_prices = new GoodHasPrices();
      $good_has_prices = $good_has_prices->store($request);
      return $this;
    }

    public function getBranchIdOfWarehouse(FormRequest $request){
      if(!is_null($request->warehouse_id)){
        $branch_id = Warehouse::find($request->warehouse_id)->getBranchId();
      }else if(!is_null($request->warehouse_has_good_id)){
        $warehouse_has_good = WarehouseHasGood::find($request->warehouse_has_good_id);
        $branch_id = Warehouse::find($warehouse_has_good->warehouse_id)->getBranchId();
      }
      return $branch_id;
    }

    public function checkIfExistsOnWarehouse(FormRequest $request){
      $existing_goods_ids = Good::where([['brand_id','=', $request->brand_id],
                                    ['color_id','=', $request->color_id],['model_id','=', $request->model_id],
                                    ['submodel_id','=', $request->submodel_id],['part_id','=', $request->part_id]
                                    ])->pluck('id')->toArray();

      $exists = WarehouseHasGood::whereIn('good_id',$existing_goods_ids)->where('warehouse_id',$request->warehouse_id)->exists();
      return $exists;
    }

    public function combineGoodsWithPrices($goods_has_prices,$goods){
      $result_of_goods = array();
      foreach ($goods_has_prices as $good_has_prices) {
        foreach ($goods as $good) {
          if($good->id == $good_has_prices->good_id){
            $warehouse_has_good_id = $good->warehouse_has_good_id;
            $good = (array) $good;
            $good['retail_price'] = $good_has_prices->retail_price;
            $good['wholesale_price'] = $good_has_prices->wholesale_price;
            $good['warehouse_name'] = WarehouseHasGood::find($warehouse_has_good_id)->getWarehouseName();
            array_push($result_of_goods,$good);
          }
        }
      }
      return $result_of_goods;
    }
}
