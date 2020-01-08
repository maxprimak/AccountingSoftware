<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customers\Entities\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Branch;
use Modules\Orders\Entities\OrderStatus;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\RepairOrderHasDevice;
use Modules\Orders\Entities\RepairOrderHasGood;
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
        $this->storeDeviceHasService($request);
        return $this;
    }

    public function storeUpdated(FormRequest $request, $id){

        $repair_order = RepairOrder::find($id);

        $repair_order->order_nr = $request->order_nr;

        $customer = Customer::find($repair_order->customer_id);
        $customer->updateFromOrder($request->customer_name, $request->customer_phone, $customer->id);

        $repair_order->defect_description = $request->defect_description;
        $repair_order->comment = $request->comment;

        $status = OrderStatus::where('name', $request->status)->firstOrFail();

        $repair_order->status_id = $status->id;
        $repair_order->prepay_sum = $request->prepay_sum;
        $repair_order->located_in = Branch::where('name',$request->located_in)->firstOrFail()->id;

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

    public function storeTypeOfOrder(Request $request){
      if($request->order_type_id == 1){
        $order_type = new PayOrders();
      }elseif($request->order_type_id == 2){
        $order_type = new WarrantyOrders();
      }else {
        $order_type = new ReworkOrders();
      }
      $order_type = $order_type->store($request);
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
        $repair_order_has_good = new RepairOrderHasGood();
        $repair_order_has_good->store($device,$this->id);
      }
    }

    public function storeDeviceHasService(Request $request){
      foreach ($request->devices as $device) {
        foreach ($device['services_id'] as $service_id) {
          $repair_order_has_good = new DeviceHasService();
          $repair_order_has_good->store($device,$service_id,$this->id);
        }
      }
    }

    public function combineDevicesWithServices($devices,$services,$repair_order_has_devices,$device_has_services){
      $result_of_devices = array();
      foreach ($devices as $device) {
        $array_of_device = array();
        $array_of_device['id'] = $device->id;
        $array_of_device['submodel_id'] = $device->submodel_id;
        $array_of_device['color_id'] = $device->color_id;
        $array_of_device['serial_nr'] = $device->serial_nr;
        foreach ($repair_order_has_devices as $repair_order_has_device) {
          if($array_of_device['id'] == $repair_order_has_device->device_id){
            $array_of_device['defect_description'] = $repair_order_has_device->defect_description;
          }
        }
        foreach ($device_has_services as $device_has_service) {
          foreach ($services as $service) {
            $service = (array) $service;
            if($device_has_service->device_id == $array_of_device['id'] && $device_has_service->service_id == $service['id']){
              $array_of_device['services'] = array();
              $service['is_completed'] = $device_has_service->is_completed;
              array_push($array_of_device['services'],$service);
            }
          }
        }
        array_push($result_of_devices,$array_of_device);
      }
      return $result_of_devices;
    }

}
