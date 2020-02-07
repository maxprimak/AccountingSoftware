<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customers\Entities\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Branch;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Submodel;
use Modules\Orders\Entities\OrderStatus;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\RepairOrderHasGood;
use Modules\Orders\Entities\RepairOrderHasDevice;
use Modules\Orders\Entities\DeviceHasService;
use Modules\Orders\Entities\PayOrders;
use Modules\Orders\Entities\WarrantyOrders;
use Modules\Orders\Entities\ReworkOrders;
use Illuminate\Http\Request;


class RepairOrder extends Model
{
    protected $fillable = [];

    public function store(FormRequest $request, $order_id): RepairOrder{
        $this->order_id = $order_id;
        $this->order_nr = $request->order_nr;
        $this->customer_id = $request->customer_id;
        $this->deadline = $request->deadline;
        $this->comment = $request->comment;
        $this->is_completed = 0;
        $this->status_id = 1;
        $this->payment_status_id = $request->payment_status_id;
        $this->warranty_id = $request->warranty_id;
        $this->discount_code_id = $request->discount_code_id;
        $this->prepay_sum = $request->prepay_sum;
        $this->order_type_id = $request->order_type_id;
        $this->save();

        $request->repair_order_id = $this->id;
        $this->storeTypeOfOrder($request);
        $this->storeRepairOrderHasDevice($request);
        $this->storeRepairOrderHasGood($request);
        $this->storeDevicesHasService($request);
        return $this;
    }

    public function storeUpdated(FormRequest $request, $id){

        $repair_order = RepairOrder::find($id);
        $request = $repair_order->setPaymentStatus($request);
        $repair_order->order_nr = $request->order_nr;
        $repair_order->comment = $request->comment;
        $repair_order->update();

        return $repair_order;

    }

    public function setPaymentStatus(Request $request): Request{
      if(!$request->prepay_sum || $request->prepay_sum == 0){
          $request->prepay_sum = 0;
          $request->payment_status_id = 3;
      }
      if($request->price > $request->prepay_sum && $request->prepay_sum != 0){
          $request->payment_status_id = 2;
      }else if($request->price == $request->prepay_sum && $request->prepay_sum != 0){
          $request->payment_status_id = 1;
      }
      return $request;
    }

    public function updateWarranty($warranty_id){

      $this->warranty_id = $warranty_id;
      $this->save();

    }

    public function updateDiscountCode($discount_code_id){

      $this->discount_code_id = $discount_code_id;
      $this->save();

    }

    public function updateDeadline($deadline){

      $this->deadline = $deadline;
      $this->save();

    }

    public function storeTypeOfOrder(Request $request){
      if($request->order_type_id == 1){
        $order_type = new PayOrders();
        $order_type = $order_type->store($request);
      }elseif($request->order_type_id == 2){
        $order_type = new WarrantyOrders();
        $order_type = $order_type->store($request);
      }else {
        $order_type = new ReworkOrders();
        $order_type = $order_type->store($request);
          foreach ($request->devices as $device) {
              $rework_order_has_warranty_case = new ReworkOrderHasWarrantyCase();
              $rework_order_has_warranty_case->store($device,$order_type->id);
          }
      }
      return $order_type;
    }

    public function storeRepairOrderHasDevice(Request $request){
      foreach ($request->devices as $device) {
        $repair_order_has_device = new RepairOrderHasDevice();
        $repair_order_has_device->store($device,$this->id);
      }
    }

    public function storeRepairOrderHasGood(Request $request){
      foreach ($request->devices as $device) {
          foreach ($device['warehouse_has_good'] as $warehouse_has_good){
              $repair_order_has_good = new RepairOrderHasGood();
              $repair_order_has_good->store($warehouse_has_good,$this->id,$device['device_id']);
          }
      }
    }

    public function storeDevicesHasService(Request $request){
      foreach ($request->devices as $device) {
          $this->storeDeviceHasService($device);
      }
    }

    public function storeDeviceHasService($device){
        foreach ($device['services_id'] as $service_id) {
            $device_has_service = new DeviceHasService();
            $device_has_service->store($device,$service_id,$this->id);
        }
    }


    public function combineDevicesWithServices($devices,$services,$repair_order_has_devices,$device_has_services){
      $services = $services->unique('id');
      $result_of_devices = array();
      foreach ($devices as $device) {
          $submodel = Submodel::find($device->submodel_id);
        $array_of_device = array();
        $array_of_device['id'] = $device->id;
        $array_of_device['submodel_name'] = $submodel->name;
        $array_of_device['color_id'] = $device->color_id;
        $array_of_device['serial_nr'] = $device->serial_nr;
        $array_of_device['status_name'] = $device->getStatus()['name'];
        $array_of_device['status_hexcode'] = $device->getStatus()['hexcode'];
        $array_of_device['last_request'] = $device->getStatus()['last_request'];
        foreach ($repair_order_has_devices as $repair_order_has_device) {
          if($array_of_device['id'] == $repair_order_has_device->device_id){
            $array_of_device['defect_description'] = $repair_order_has_device->defect_description;
          }
        }

        $array_of_device['services'] = array();
        foreach ($device_has_services as $device_has_service) {
          foreach ($services as $service) {
            $service = (array) $service;
            if(($device_has_service->device_id == $array_of_device['id']) && ($device_has_service->service_id == $service['id'])
              && ($device_has_service->repair_order_id == $this->id)){
              $service['is_completed'] = $device_has_service->is_completed;
              array_push($array_of_device['services'],$service);
            }
          }
        }
        array_push($result_of_devices,$array_of_device);
      }
      return $result_of_devices;
    }

    public function updateStatus(Request $request): RepairOrder{
        $this->status_id = $request->status_id;
        $this->save();
        return $this;
    }

    public function complete(): RepairOrder{
        $this->is_completed = 1;
        $this->save();
        return $this;
    }

    public function changePaymentStatus(Payment $payment): RepairOrder{
        $rest_of_payment = $this->getRestOfPayment($payment);
        if($rest_of_payment <= 0){
          $this->payment_status_id = 1;
        } 
        if($rest_of_payment > 0){
          $this->payment_status_id = 2;
          $this->prepay_sum += $payment->amount;
        } 
        $this->save();
        return $this;
    }

    private function getOrder()
    {
        return Order::findOrFail($this->order_id);
    }

    private function getRestOfPayment(Payment $payment)
    {
        $order = $this->getOrder();
        $rest_of_payment = $order->price - ($this->prepay_sum + $payment->amount);
        return $rest_of_payment;
    }
}
