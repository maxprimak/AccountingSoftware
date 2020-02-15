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
            'country_id' => 'required|exists:countries,id',
            'city_name' => 'required|exists:cities,name,country_id,'.$this->input('country_id'),
        ];
    }

    public function messages()
    {
        return [
            'currency_id.required' => 'currency is required',
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
