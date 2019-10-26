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
            'accept_date' => 'required|date|before:tomorrow',
            'price' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
            'order_nr' => 'required|max:190',
            'customer_name' => 'required|max:50',
            'customer_phone' => 'required|max:50',
            'defect_description' => 'required|max:190',
            'comment' => 'max:190',
            'prepay_sum' => 'required|numeric|max:'. $this->price,
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
