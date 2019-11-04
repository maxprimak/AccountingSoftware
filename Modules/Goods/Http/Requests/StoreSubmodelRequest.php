<?php

namespace Modules\Goods\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmodelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'model_id' => 'required|numeric|exists:models,id',
          'name' => 'required',
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
