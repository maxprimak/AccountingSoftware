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
use Modules\Users\Entities\User;
use Modules\Employees\Entities\Employee;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\SalesOrder;
use Laravel\Cashier\Billable;
use Carbon\Carbon;

class Company extends Model
{ 

    use Billable;

    protected $fillable = ['name', 'phone', 'address'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    public function getBranchesIdsOfCompany(){
      $branches_ids = Branch::where('company_id',$this->id)->pluck('id');
      return $branches_ids;
    }

    public function getBranchesNumber(){
      $result = sizeof($this->getBranchesIdsOfCompany()->toArray());
      return $result;
    }

    public function getEmployeesNumber(){
      $user_ids = User::where('company_id', $this->id)->pluck('id')->toArray();
      $result = Employee::whereIn('user_id', $user_ids)->get()->count();

      return $result;
    }

    public function getLanguage(){
      $languages = [
        1 => "en",
        2 => "de"
      ];

      return $languages[$this->language_id];
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
        $this->language_id = $request->language_id;

        $address = Address::find($this->address_id);
        $address->store($request);

        $this->address_id = $address->id;
        $this->save();

        return $this;
    }

    public function getRepairOrdersThisMonthNumber(){
      $order_ids = Order::whereIn('branch_id', $this->getBranchesIdsOfCompany())->pluck('id')->toArray();

      $result = RepairOrder::whereIn('order_id', $order_ids)
                            ->whereDate('created_at', '>=', Carbon::now()->startOfMonth())
                            ->whereDate('created_at', '<=', Carbon::now()->endOfMonth())
                            ->get()->count();           

      return $result;
    }

    public function getPlanExpirationDate(){
      return date('d.m.Y', $this->subscription(env('STANDARD_SUBSCRIPTION_NAME'))->asStripeSubscription()->current_period_end);
    }

    public function getStripePlanName(){
      if($this->subscribedToPlan(env('ENTERPRISE_PLAN_STRIPE_ID'), env('STANDARD_SUBSCRIPTION_NAME'))){
        return "enterprise";
      }
    elseif($this->subscribedToPlan(env('PRO_PLAN_STRIPE_ID'), env('STANDARD_SUBSCRIPTION_NAME'))){
        return "pro";
      } 
    elseif($this->subscribedToPlan(env('STARTUP_PLAN_STRIPE_ID'), env('STANDARD_SUBSCRIPTION_NAME'))){
        return "startup";
    }
    elseif($this->subscribedToPlan(env('FREE_PLAN_STRIPE_ID'), env('STANDARD_SUBSCRIPTION_NAME'))){
      return "free";
    }
    else{
      return "none";
    }
    }

    public function subscribeToFreePlan(){
      $this->newSubscription(env('STANDARD_SUBSCRIPTION_NAME'), env('FREE_PLAN_STRIPE_ID'))->create();
    }

    public function changeSubscription($plan_id, $payment_method){
      if($plan_id != env('PRO_PLAN_STRIPE_ID')){
        $this->removeExtraBranchesSubscription();
      }
      $this->subscription(env('STANDARD_SUBSCRIPTION_NAME'))->swap($plan_id);
    }

    public function hasExtraBranches(){
      return $this->subscribed(env('EXTRA_BRANCHES_SUBSCRIPTION_NAME')) 
              && !$this->subscription(env('EXTRA_BRANCHES_SUBSCRIPTION_NAME'))->cancelled();
    }

    public function getExtraBranchesAmount(){
      if($this->hasExtraBranches()){
        return $this->subscription(env('EXTRA_BRANCHES_SUBSCRIPTION_NAME'))->quantity;
      }
      return 0;
    }

    public function removeExtraBranchesSubscription(){
      if($this->hasExtraBranches()){
        $this->subscription(env('EXTRA_BRANCHES_SUBSCRIPTION_NAME'))->cancel();
      }
    }

    public function updateExtraBranchesAmount($amount){
      if($this->hasExtraBranches()){
        $this->subscription(env('EXTRA_BRANCHES_SUBSCRIPTION_NAME'))->updateQuantity($amount);
      }
    }

    public function addExtraBranchesSubscription($amount){
      if(!$this->hasExtraBranches()){
        $this->newSubscription(env('EXTRA_BRANCHES_SUBSCRIPTION_NAME'), env('EXTRA_BRANCH_PLAN_STRIPE_ID'))
        ->quantity($amount)->create();
      }
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
