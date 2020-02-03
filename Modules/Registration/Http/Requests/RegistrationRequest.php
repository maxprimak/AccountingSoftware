<?php

namespace Modules\Registration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegistrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:190',
            'phone' => 'required|max:190',
            'company_name' => 'required|max:190|unique:companies,name',
            'company_phone' => 'required|max:190',
            'company_tax' => 'required|numeric|min:0|max:100',
            'currency_id' => 'required|exists:currencies,id',
            'house_number' => 'required|max:190',
            'street_name' => 'required|max:190',
            'postcode' => 'required|max:190',  
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
