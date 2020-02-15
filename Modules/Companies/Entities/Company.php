<?php

namespace Modules\Companies\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Http\Requests\StoreCompanyRequest;
use Modules\Companies\Http\Requests\UpdateCompanyRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Companies\Entities\Branch;
use Modules\Warehouses\Entities\Warehouse;
use Modules\Companies\Entities\Address;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\SalesOrder;

class Company extends Model
{
    protected $fillable = ['name', 'phone', 'address'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    public function getBranchesIdsOfCompany(){
      $branches_ids = Branch::where('company_id',$this->id)->pluck('id');
      return $branches_ids;
    }

    public function getWarehousesIdsOfCompany(){
      $branches_ids = $this->getBranchesIdsOfCompany();
      $warehouses_ids = Warehouse::whereIn('branch_id',$branches_ids)->pluck('id');
      return $warehouses_ids;
    }

    public function getCurency(){
      return Currency::find($this->currency_id);
    }

    public function store(FormRequest $request){
        $this->currency_id = $request->currency_id;
        $this->name = $request->name;
        $this->phone = $request->phone;
        $this->tax = $request->tax;

        $address = new Address();
        $address->store($request);

        $this->address_id = $address->id;
        $this->save();

        return $this;
    }

    public function storeUpdated(FormRequest $request){
        $this->currency_id = $request->currency_id;
        $this->name = $request->name;
        $this->phone = $request->phone;
        $this->tax = $request->tax;

        $address = Address::find($this->address_id);
        $address->store($request);

        $this->address_id = $address->id;
        $this->save();

        return $this;
    }

    public function getOrderIds(){

      $branch_ids = $this->getBranchesIdsOfCompany();
      $order_ids = Order::whereIn('branch_id', $branch_ids)->pluck('id')->toArray();

      return $order_ids;

    }

    public function getRepairOrders(){

      $order_ids = $this->getOrderIds();
      $repair_orders = RepairOrder::whereIn('order_id', $order_ids)->get();

      return $repair_orders;

    }

    public function getSalesOrders(){

      $order_ids = $this->getOrderIds();
      $sales_orders = SalesOrder::whereIn('order_id', $order_ids)->get();

      return $sales_orders;

    }

    public function getWarehousesIds(){
      $branch_ids = $this->getBranchesIdsOfCompany();
      $warehouses_ids = Warehouse::whereIn('branch_id', $branch_ids)->pluck('id')->toArray();

      return $warehouses_ids;
    }

    public function getCurrency(){
        $currency = Currency::find($this->currency_id);
        return $currency;
    }

}
