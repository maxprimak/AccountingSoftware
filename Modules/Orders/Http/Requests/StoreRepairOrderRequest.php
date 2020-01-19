<?php

namespace Modules\Orders\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepairOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $accept_date = $this->accept_date;
      $accept_date = str_replace('-', '/', $accept_date);
      $yesterday = date('Y-m-d',strtotime($accept_date . "-1 days"));
      $amount_of_devices = sizeof($this->devices);
      $amount_of_services = 0;
      foreach ($this->devices as $device){
          $amount_of_services += sizeof( $device['services_id']);
      }
      if($amount_of_devices == 0){
          return ['devices' => 'size:1'];
      }
      if($amount_of_devices > $amount_of_services){
          return ['amount of services should be more or equal:' => 'size:'.$amount_of_devices];
      }
        return [
            'order_type_id' => 'required|exists:order_types,id',
            'accept_date' => 'required|date|before:tomorrow',
            'branch_id' => 'required|exists:branches,id',
            'order_nr' => 'required|max:190',
            'customer_id' => 'required|exists:customers,id',
            'devices' => 'required',
            'price' => 'required|numeric',
            'warranty_id' => 'required|exists:warranties,id',
            'discount_code_id' => 'required|exists:discount_codes,id',
//            'order_has_device_id' => 'sometimes|exists:repair_order_has_devices,id:',
            'deadline' => 'nullable|date|after:'.$yesterday,
            'comment' => 'nullable|max:190',
            'prepay_sum' => 'nullable|numeric|max:'. $this->price
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
