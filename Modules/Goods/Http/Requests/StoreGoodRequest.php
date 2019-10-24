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
          'branch_id' => 'required | numeric',
          'brand_id' => 'required | numeric',
          'model_id' => 'required | numeric',
          'submodel_id' => 'required | numeric',
          'part_id' => 'required | numeric',
          'amount' => 'required',
          'color_id' => 'required | numeric',
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
