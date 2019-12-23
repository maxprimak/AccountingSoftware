<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Warehouses\Entities\WarehouseHasGood;
use Modules\Goods\Entities\BranchHasGood;
use Modules\Goods\Entities\GoodHasPrices;
use Modules\Warehouses\Entities\Warehouse;



class Good extends Model
{
    protected $fillable = ['name','brand_id','model_id',
    'submodel_id','part_id','color_id'];


    public function store($request): Good{

      $this->part_id = $request->part_id;
      $this->brand_id = $request->brand_id;
      $this->model_id = $request->model_id;
      $this->submodel_id = $request->submodel_id;
      $this->color_id = $request->color_id;
      $this->save();

      // ADD THIS GOOD TO BRANCH
      $request->good_id = $this->id;
      $request->branch_id = Warehouse::find($request->warehouse_id)->getBranchId();
      $branch_has_good = new BranchHasGood();
      $branch_has_good = $branch_has_good->store($request);

      $warehouse_has_good = new WarehouseHasGood();
      $warehouse_has_good->store($request);

      $request->branch_has_good_id = $branch_has_good->id;
      $good_has_prices = new GoodHasPrices();
      $good_has_prices = $good_has_prices->store($request);
      return $this;
    }

    public function check_if_exists($request){
      $existing_good = Good::where([['brand_id','=', $request->brand_id],
                                    ['color_id','=', $request->color_id],['model_id','=', $request->model_id],
                                    ['submodel_id','=', $request->submodel_id],['part_id','=', $request->part_id]
                                    ])->first();
      return $existing_good;
    }

    public function edit($request): Good{
      // ADD THIS GOOD TO BRANCH
      $warehouse_has_good = WarehouseHasGood::find($request->warehouse_has_good_id);
      $warehouse_has_good->storeUpdate($this->id);

      $branch_id = Warehouse::find($warehouse_has_good->warehouse_id)->getBranchId();

      $branch_has_good = BranchHasGood::find($branch_id);
      $good_has_prices = GoodHasPrices::where('branch_has_good_id',$branch_has_good->id)->first();


      $branch_has_good = $branch_has_good->storeUpdate($this->id);
      $good_has_prices = $good_has_prices->updateBranchHasGood($branch_has_good->id);

      return $this;
    }
}
