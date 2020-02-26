<?php

namespace Modules\Suppliers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Goods\Entities\Good;

class SupplierOrderHasGood extends Model
{
    protected $fillable = ['orders_to_supplier_id', 'good_id'];

    protected $table = 'orders_to_supplier_has_goods';

    public static function saveGoodsToSupplierOrder(Request $request)
    {
        if($request->has('goods') && $request->goods != []){

            $supplier_order_has_goods = array();
            $goods_ids = array();
            $is_not_for_delete = array();
            $supplier_order_id = $request->supplier_order_id;

            foreach($request->goods as $good){
                array_push($is_not_for_delete, $good['good_id']);
            }

            SupplierOrderHasGood::where('orders_to_supplier_id', $supplier_order_id)
                ->whereNotIn('good_id', $is_not_for_delete)
                ->delete();

            foreach ($request->goods as $good){
                if(!SupplierOrderHasGood::where('orders_to_supplier_id', $supplier_order_id)
                    ->where('good_id', $good['good_id'])->exists()){
                    $supplier_order_has_good = new SupplierOrderHasGood();
                    $supplier_order_has_good->store($good,$request->supplier_order_id);

                    array_push($supplier_order_has_goods,$supplier_order_has_good);
                    array_push($goods_ids,$good['good_id']);
                }
            }
//            $goods = Good::whereIn('id',$goods_ids)->get();
////            $goods = array();
////            foreach ($warehouse_has_goods as $warehouse_has_good){
////                $good = $warehouse_has_good->getGoodForDevice();
////                $good['warehouse_name'] = $warehouse_has_good->getWarehouseName();
////                array_push($goods,$good);
////            }
////            $repair_order_has_good = new RepairOrderHasGood();
////            $result_goods = $repair_order_has_good->combineGoodsRepairOrderHasGood($repair_order_has_goods,$goods);
////
////            return response()->json($result_goods);
        }else{
            SupplierOrderHasGood::where('orders_to_supplier_id', $request->supplier_order_id)->delete();
        }
    }

    private function store($good,$supplier_order_id): SupplierOrderHasGood
    {
        $this->orders_to_supplier_id = $supplier_order_id;
        $this->good_id = $good['good_id'];
        $this->amount = $good['amount'];
        $this->save();

        return $this;
    }

    public static function getGoodsForSupplierOrder($supplier_order)
    {
        $goods_ids = self::where('orders_to_supplier_id',$supplier_order->id)->pluck('good_id')->toArray();
        $supplier_orders_has_good = self::where('orders_to_supplier_id',$supplier_order->id)->first();
        $goods = Good::whereIn('id',$goods_ids)->get();

        if(sizeof($goods) > 0){
            foreach ($goods as $good){
                if($good->id == $supplier_orders_has_good['good_id']){
                    $good->amount = $supplier_orders_has_good->amount;
                }
            }
        }

        return $goods;
    }
}
