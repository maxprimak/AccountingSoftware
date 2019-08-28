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
            'currency_id' => 'required',
            'name' => 'required | unique:companies,name,' . $this->route('company_id'),
            'address' => 'required',
            'phone' => 'required'
        ];
    }


     /**
     * Listener on validation fails.
     *
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json($validator->errors()->all()[0]));

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
