<?php

namespace Modules\Customers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|unique:people,phone',
            'stars_number' => 'double',
            'customer_type_id' => 'required|numeric',
            'branch_id' => 'required',
            'user_id' => 'required|numeric',
        ];
    }

     /**
     * Listener on validation fails.
     *
     * @return array
     */
    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'error' => $validator->errors()->all()[0],
    //         'message' => $validator->errors()->all()[0]
    //     ]));
    // }

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
