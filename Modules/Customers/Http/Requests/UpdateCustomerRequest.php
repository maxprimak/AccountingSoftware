<?php

namespace Modules\Customers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Modules\Customers\Entities\Customer;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $customer = Customer::findOrFail($this->route('customer_id'));

        return [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|unique:people,phone,'. $customer->person_id,
            'type_id' => 'required|integer',
            'branch_id' => 'required',
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
