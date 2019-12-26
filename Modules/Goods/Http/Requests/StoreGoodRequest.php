<?php

namespace Modules\Goods\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreGoodRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'brand_id' => 'required | numeric |exists:brands,id',
          'model_id' => 'required | numeric |exists:models,id',
          'submodel_id' => 'required | numeric |exists:submodels,id',
          'warehouse_id => required |exists:warehouses,id',
          'amount' => 'required | numeric |min:1',
          'part_id' => 'required | numeric |exists:parts,id',
          'color_id' => 'required | numeric |exists:colors,id',
          'vendor_code' => 'nullable',
          'retail_price ' => ' nullable',
          'wholesale_price' => 'nullable'
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
