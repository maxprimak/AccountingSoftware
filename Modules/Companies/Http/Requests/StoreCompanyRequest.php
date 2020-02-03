<?php

namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currency_id' => 'required|exists:currencies,id',
            'name' => 'required | unique:companies',
            'phone' => 'required',
            'tax' => 'required|numeric|min:1|max:100',
            'house_number' => 'required|max:190',
            'postcode' => 'required|max:190',
            'street_name' => 'required|max:190',
            'city_id' => 'required|exists:cities,id'
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
