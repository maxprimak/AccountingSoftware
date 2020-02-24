<?php

namespace Modules\Suppliers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Orders\Entities\Order;

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
}
