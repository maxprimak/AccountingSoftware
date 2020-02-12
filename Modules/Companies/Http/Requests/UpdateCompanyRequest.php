<?php

namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateCompanyRequest extends FormRequest
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
            'name' => 'required | unique:companies,name,' . $this->route('company_id'),
            'phone' => 'required',
            'tax' => 'required|numeric|min:1|max:100',
            'house_number' => 'required|max:190',
            'postcode' => 'required|max:190',
            'street_name' => 'required|max:190',
            'country_id' => 'required|exists:countries,id',
            'city_name' => 'required|exists:cities,name,country_id,'.$this->input('country_id'),
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
