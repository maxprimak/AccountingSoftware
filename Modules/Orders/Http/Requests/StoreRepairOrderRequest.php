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
        return [
            'order_type_id' => 'required|exists:order_types,id',
            'accept_date' => 'required|date|before:tomorrow',
            'branch_id' => 'required|exists:branches,id',
            'order_nr' => 'required|max:190',
            'customer_id' => 'required|exists:customers,id',
            'price' => 'required|min:1',
            'warranty_id' => 'required|exists:warranties,id',
            'discount_code_id' => 'required|exists:discount_codes,id',
            'deadline' => 'nullable|date|after:yesterday',
            'comment' => 'nullable|max:190',
            'prepay_sum' => 'nullable|numeric|max:'.$this->price,
            'devices' => 'required|array',
            'devices.*.submodel_id' => 'required|exists:submodels,id',
            'devices.*.color_id' => 'required|exists:colors,id',
            'devices.*.serial_nr' => 'required|max:190',
            'devices.*.condition' => 'required|max:190',
            'devices.*.status_name' => 'required|max:190',
            'devices.*.status_hexcode' => 'required|max:190',
            'devices.*.last_request' => 'required',
            'devices.*.name' => 'required|max:190',
            'devices.*.brand_name' => 'required|max:190',
            'devices.*.model_name' => 'required|max:190',
            'devices.*.submodel_name' => 'required|max:190',
            'devices.*.color_hexcode' => 'required|exists:colors,hex_code',
            'devices.*.color_name' => 'required|exists:colors,name',
            'devices.*.services' => 'required|array',
            'devices.*.issue_description' => 'required|max:190',
            'devices.*.goods.*.id' => 'required|exists:goods,id',
            'devices.*.goods.*.brand_name' => 'required|max:190',
            'devices.*.goods.*.brand_id' => 'required|exists:brands,id',
            'devices.*.goods.*.model_name' => 'required|max:190',
            'devices.*.goods.*.model_id' => 'required|exists:models,id',
            'devices.*.goods.*.submodel_name' => 'required|max:190',
            'devices.*.goods.*.submodel_id' => 'required|exists:submodels,id',
            'devices.*.goods.*.part_name' => 'required|max:190',
            'devices.*.goods.*.part_id' => 'required|exists:parts,id',
            'devices.*.goods.*.color_name' => 'required|max:190|exists:colors,name',
            'devices.*.goods.*.color_id' => 'required|exists:colors,id',
            'devices.*.goods.*.color_hexcode' => 'required|exists:colors,hex_code',
            'devices.*.goods.*.warehouse_has_good_id' => 'required|exists:warehouse_has_goods,id',
            'devices.*.goods.*.vendor_code' => 'required|max:190',
            'devices.*.goods.*.amount' => 'required|numeric|min:1',
            'devices.*.goods.*.order_amount' => 'required|numeric|min:1|',
            'devices.*.goods.*.warehouse_name' => 'required|exists:warehouses,name',
            'devices.*.warehouse_has_good.*.id' => 'required',
            'devices.*.warehouse_has_good.*.amount' => 'required|min:1',
        ];
    }

    public function messages()
    {   
    return [
        'devices.required' => 'order does not contain any device',
        'devices.*.services.required' => 'some devices do not have any service',
        'devices.*.issue_description.required' => 'some devices do not have issue description'
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
