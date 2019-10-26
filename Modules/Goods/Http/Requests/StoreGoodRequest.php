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
          'branch_id' => 'required|numeric|exists:branches,id',
          'brand_id' => 'required | numeric |exists:brands,id',
          'model_id' => 'required | numeric |exists:models,id',
          'submodel_id' => 'required | numeric |exists:submodels,id',
          'part_id' => 'required | numeric |exists:parts,id',
          'amount' => 'required',
          'color_id' => 'required | numeric |exists:colors,id',
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
