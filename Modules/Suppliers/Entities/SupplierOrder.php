<?php

namespace Modules\Suppliers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\Companies\Entities\Branch;
use Modules\Goods\Entities\Good;
use Modules\Goods\Entities\GoodHasPrices;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\PaymentStatuses;
use Modules\Suppliers\Http\Requests\AddGoodRequest;
use Modules\Warehouses\Entities\WarehouseHasGood;

class SupplierOrder extends Model
{
    protected $fillable = [];

    protected $table = 'orders_to_suppliers';

    public function store(Request $request): SupplierOrder
    {
        $price = $this->calculate_price($request);
        $request->price = $price;

        $order = new Order();
        $order = $order->store($request);
        $request->order_id = $order->id;
        $request->orders_to_supplier_statuses_id = SupplierOrdersStatuses::getPendingStatus()->id;

        $supplier_order = $this->saveSupplierOrder($request);

        $request->supplier_order_id = $supplier_order->id;

        SupplierOrderHasGood::saveGoodsToSupplierOrder($request);

        return $supplier_order;
    }

    public function addInfoForIndex(){
        $this->branch_name = $this->getBranchName();
        $this->goods_description = $this->getGoodsDescription();
        $this->price = $this->getPrice();
        $this->payment_status_name = PaymentStatuses::getPaymentStatusWithTranslation($this->payment_status_id)->name;
        $this->supplier_name = $this->getSupplierName();
        $this->status_name = $this->getStatus()->name;
        $this->status_hexcode = $this->getStatus()->hex_code;
        $this->currency_id = auth('api')->user()->getCompany()->getCurrency()->id;
        $this->currency_name = auth('api')->user()->getCompany()->getCurrency()->name;
        $this->currency_symbol = auth('api')->user()->getCompany()->getCurrency()->symbol;


        return $this;
    }

    public function edit($request){
        $price = $this->calculate_price($request);
        $order = $this->getOrder();
        $order->price = $price;
        $order->save();
        $this->updateSupplierOrder($request);
        $this->updateGoods($request);

        return $this;
    }

    private function updateGoods($request){
        $good_ids = array();
        foreach($request->goods as $good){
            array_push($good_ids, $good['good_id']);
        }
        SupplierOrderHasGood::where('orders_to_supplier_id', $this->id)->whereNotIn('good_id', $good_ids)->delete();

        foreach($request->goods as $good){
           $has_good = SupplierOrderHasGood::firstOrNew([
            'orders_to_supplier_id' => $this->id,
            'good_id' => $good['good_id'],
           ]);
           $has_good->amount = $good['amount'];
           $has_good->save();
           GoodHasPrices::updateRetailPrice($good,$this->getOrder()->branch_id,$request->supplier_id);
        }
        
    }

    private function getStatus(){
        return SupplierOrdersStatuses::find($this->orders_to_supplier_statuses_id);
    }

    private function getSupplierName(){
        $supplier = $this->getSupplier();
        return $supplier->name;
    }

    private function getSupplier(){
        return Supplier::find($this->supplier_id);
    }

    public function getPrice(){
        $order = $this->getOrder();
        
        return $order->price;
    }

    public function removeFromDB(){
        SupplierOrderHasGood::where('orders_to_supplier_id', $this->id)->delete();
        $this->delete();
        Order::where('id', $this->order_id)->delete();
    }

    private function getGoodsDescription(){
        $has_good_query = SupplierOrderHasGood::where('orders_to_supplier_id', $this->id);
        $amount = $has_good_query->count();
        $good_ids = $has_good_query->pluck('good_id')->toArray();
        $first_item = Good::whereIn('id', $good_ids)->first();
        $alternative_string = $first_item->getName() . " +" . strval($amount-1); 
        $result = ($amount < 2) ? $first_item->getName() : $alternative_string; 

        return $result;
    }

    private function getBranchName(){
        $order = $this->getOrder();
        $branch = Branch::find($order->branch_id);

        return $branch->name;
    }

    public function getOrder(){
        return Order::find($this->order_id);
    }

    private function calculate_price(Request $request)
    {
        $price = 0;
        foreach($request->goods as $good){
            if(isset($good['retail_price'])){
                $price += $good['retail_price'] * $good['amount'];
            }
        }
        return $price;
    }

    private function saveSupplierOrder(Request $request): SupplierOrder
    {
        $this->payment_status_id = 3;
        $this->supplier_id = $request->supplier_id;
        $this->delivery_date = $request->delivery_date;
        $this->orders_to_supplier_statuses_id = $request->orders_to_supplier_statuses_id;
        $this->order_nr = $request->order_nr;
        $this->order_id = $request->order_id;
        $this->comment = $request->comment;
        $this->accepted_by = auth('api')->user()->getEmployee()->id;

        $this->save();

        return $this;
    }

    private function updateSupplierOrder(Request $request): SupplierOrder
    {
        $this->payment_status_id = $request->payment_status_id;
        $this->supplier_id = $request->supplier_id;
        $this->delivery_date = $request->delivery_date;
        $this->orders_to_supplier_statuses_id = $request->orders_to_supplier_statuses_id;
        $this->order_nr = $request->order_nr;
        $this->comment = $request->comment;

        $this->save();

        return $this;
    }

    public function addGoodsToStock(FormRequest $request)
    {
        if(is_null($request->goods)){
           $goods_ids =  SupplierOrderHasGood::where('orders_to_supplier_id',$this->id)->pluck('good_id');
           $supplier_order_goods =  SupplierOrderHasGood::where('orders_to_supplier_id',$this->id)->get();
           $warehouse_has_goods = WarehouseHasGood::whereIn('good_id',$goods_ids)
                                                    ->get();

           foreach ($goods_ids as $good_id){
               if(!$this->goodHasCopyInRequestedWarehouse($good_id, $request->branch_id)){
               $filtered_warehouse_has_goods = $warehouse_has_goods->filter(function ($value,$key) use ($good_id){
                    return $value->good_id == $good_id;
               });



               if(!$filtered_warehouse_has_goods->contains('warehouse_id',$request->branch_id)) {
                   $request->warehouse_id = $request->branch_id;
                   $request->amount = 0;
                   $request->supplier_id = $this->supplier_id;
                   $good_has_price = GoodHasPrices::where('good_id',$good_id)
                       ->where('supplier_id',$this->supplier_id)
                       ->orWhere('supplier_id',null)
                       ->first();
                       
                   $request->retail_price = $good_has_price->retail_price;

                   $new_good = new Good();
                   $new_good = $new_good->makeCopy($request,$good_id);
                   $new_warehouse_has_good = $new_good->getWarehouseHasGood($request->branch_id);
                   $warehouse_has_goods->push($new_warehouse_has_good);

                   $supplier_order_goods = $supplier_order_goods->filter(function ($value,$key) use ($good_id,$new_good) {
                         if($value->good_id == $good_id){
                             return $value->good_id = $new_good->id;
                         }else{
                             return $value;
                         }
                   });
               }
            }
           }

           foreach ($supplier_order_goods as $supplier_order_good){
                foreach ($warehouse_has_goods as $warehouse_has_good){
                    if($warehouse_has_good->good_id == $supplier_order_good->good_id){
                        $warehouse_has_good->amount += $supplier_order_good->amount;
                        $warehouse_has_good->save();
                    }
                }
            }
        }
    }

    private function goodHasCopyInRequestedWarehouse($good_id, $warehouse_id){
        $goods_ids = WarehouseHasGood::where('warehouse_id', $warehouse_id)->pluck('good_id')->toArray();
        $good_to_compare = Good::find($good_id);
        return Good::whereIn('id', $goods_ids)
                    ->where('part_id', $good_to_compare->part_id)
                    ->where('submodel_id', $good_to_compare->submodel_id)
                    ->where('color_id', $good_to_compare->color_id)
                    ->exists();
    }

    public function setStatusToReceived(){
        $this->orders_to_supplier_statuses_id = SupplierOrdersStatuses::getReceivedStatus()->id;
        $this->save();
    }

    public function changePaymentStatus(){
        $this->payment_status_id = PaymentStatuses::getPaidStatus()->id;
        $this->save();
    }

}
