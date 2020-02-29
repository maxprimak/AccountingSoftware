<?php

namespace Modules\Suppliers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'delivery_date' => 'required|date',
            'order_nr' => 'required',
            'comment' => 'nullable',
            'goods' => 'required|array|min:1',
            'goods.*.good_id' => 'required|exists:goods,id',
            'goods.*.retail_price' => 'nullable|min:1',
            'goods.*.amount' => 'required|min:1',
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
