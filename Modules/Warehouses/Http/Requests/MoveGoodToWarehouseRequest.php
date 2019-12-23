<?php

namespace Modules\Warehouses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class moveGoodToWarehouseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'warehouse_id' => 'required | numeric |exists:warehouses,id',
          'stock_amount' => 'required |numeric |',
          'amount' => 'required|numeric|max:'. $this->stock_amount
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
