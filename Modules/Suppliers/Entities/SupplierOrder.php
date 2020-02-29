<?php

namespace Modules\Suppliers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Companies\Entities\Branch;
use Modules\Goods\Entities\Good;
use Modules\Goods\Entities\GoodHasPrices;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\PaymentStatuses;
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

        return $this;
    }

    public function edit($request){
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

    public function addGoodsToStock(Request $request)
    {
        if(is_null($request->goods)){
           $goods_ids =  SupplierOrderHasGood::where('orders_to_supplier_id',$this->id)->pluck('good_id');
           $supplier_order_goods =  SupplierOrderHasGood::where('orders_to_supplier_id',$this->id)->get();
           $warehouse_has_goods = WarehouseHasGood::whereIn('good_id',$goods_ids)
                                                    ->where('warehouse_id',$request->branch_id)
                                                    ->get();

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

    public function setStatusToReceived(){
        $this->orders_to_supplier_statuses_id = SupplierOrdersStatuses::getReceivedStatus()->id;
        $this->save();
    }

    public function changePaymentStatus(){
        $this->payment_status_id = PaymentStatuses::getPaidStatus()->id;
        $this->save();
    }

}
