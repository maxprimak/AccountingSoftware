<?php

namespace Modules\Goods\Entities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Warehouses\Entities\WarehouseHasGood;
use Modules\Goods\Entities\GoodHasPrices;
use Modules\Suppliers\Entities\SupplierOrderHasGood;
use Modules\Warehouses\Entities\Warehouse;



class Good extends Model
{
    protected $fillable = ['name','brand_id','model_id',
    'submodel_id','part_id','color_id'];

    public static function findCopyInWarehouse($good_id,$warehouse_id){
      $goods_ids = WarehouseHasGood::where('warehouse_id', $warehouse_id)->pluck('good_id')->toArray();
      $good_to_compare = Good::find($good_id);
      return Good::whereIn('id', $goods_ids)
                  ->where('part_id', $good_to_compare->part_id)
                  ->where('submodel_id', $good_to_compare->submodel_id)
                  ->where('color_id', $good_to_compare->color_id)
                  ->first();
    }

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

    public function getName(){
      $language_id = auth('api')->user()->getCompany()->language_id;
      $part_name =  Part::find($this->part_id)->getTranslatedName($language_id);
      $submodel_name = Submodel::find($this->submodel_id)->getName();
      $result = $part_name. " " . $submodel_name;

      return $result;
    }

    public function addInfoForSupplierOrder($supplier_order){
      $this->part_name = $this->getPartName();
      $this->brand_name = $this->getBrand()->name;
      $this->type_name = $this->getType()->name;
      $this->model_name = $this->getModel()->name;
      $this->color_name = $this->getColor()->name;
      $this->color_hexcode = $this->getColor()->hex_code;
      $this->supplier_price = $this->getSupplierPrice($supplier_order);
      $this->in_stock = $this->getInStockAmount($supplier_order);
      $this->amount = $this->getAmount($supplier_order);
      $this->warehouse_id = $this->getWarehouse($supplier_order)->id;
    }

    private function getSupplierPrice($supplier_order){
      $has_prices = GoodHasPrices::where('good_id', $this->id)
                                  ->where('supplier_id', $supplier_order->supplier_id)
                                  ->orWhere('supplier_id', null)
                                  ->first();
      return ($has_prices->retail_price == null) ? 0 : $has_prices->retail_price;
    }

    private function getWarehouse($order){
      $branch_id = $order->getOrder()->branch_id;
      $warehouse_id = Warehouse::where('branch_id', $branch_id)->first()->id;
      return Warehouse::find($warehouse_id);
    }

    private function getAmount($order){
      $has_goods = SupplierOrderHasGood::where('orders_to_supplier_id', $order->id)->where('good_id', $this->id)->first();
      return $has_goods->amount;
    }

    private function getInStockAmount($order){
      $warehouse_id = $this->getWarehouse($order)->id;
      $warehouse_has_good = WarehouseHasGood::where('good_id', $this->id)->where('warehouse_id', $warehouse_id)->first();
      return ($warehouse_has_good == null) ? 0 : $warehouse_has_good->amount;
    }

    private function getColor(){
      return Color::find($this->color_id);
    }

    private function getModel(){
      return Submodel::find($this->submodel_id);
    }

    private function getType(){
      return Models::find($this->model_id);
    }

    private function getBrand(){
      return Brand::find($this->brand_id);
    }

    private function getPartName(){
      $part = $this->getPart();
      $language_id = auth('api')->user()->getCompany()->language_id;

      return $part->getTranslatedName($language_id);
    }

    private function getPart(){
      return Part::find($this->part_id);
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
      $goods_without_price = array();

      foreach ($goods as $good){
          $good = (array) $good;
          $good['warehouse_name'] = WarehouseHasGood::find($good['warehouse_has_good_id'])->getWarehouseName();
          array_push($goods_without_price,$good);
      }


      foreach ($goods_without_price as $good) {
        $good['price'] = array();
        foreach ($goods_has_prices as $good_has_prices) {
          if($good['id'] == $good_has_prices->good_id){
            $price = array();
            $price['supplier_id'] =  $good_has_prices->supplier_id;
            $price['retail_price'] = $good_has_prices->retail_price;
            $price['wholesale_price'] = $good_has_prices->wholesale_price;
            array_push ($good['price'],$price);
          }
        }
        array_push($result_of_goods,$good);
      }
      return $result_of_goods;
    }

    public function makeCopy(FormRequest $request,$good_id)
    {
        $good_for_copy = self::find($good_id);

        $request->part_id = $good_for_copy->part_id;
        $request->brand_id = $good_for_copy->brand_id;
        $request->model_id = $good_for_copy->model_id;
        $request->submodel_id = $good_for_copy->submodel_id;
        $request->color_id = $good_for_copy->color_id;

        $good = new Good();
        $good = $good->store($request);
        return $good;
    }

    public function getWarehouseHasGood($warehouse_id){
        $warehouse_has_good = WarehouseHasGood::where('good_id',$this->id)
                                                ->where('warehouse_id',$warehouse_id)
                                                ->firstOrFail();

        return $warehouse_has_good;
    }
}
