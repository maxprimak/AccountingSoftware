<?php

namespace Modules\Employees\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'new_full_name' => 'required',
            'new_username' => 'required|min:6|unique:logins,username',
            'new_password' => 'required|min:8',
            're_password' => 'required|same:new_password',
            'new_email' => 'required|email|unique:logins,email',
            'new_phone' => 'required|unique:people,phone',
            'role_id' => 'required',
            'branch_id' => 'required',
            'is_active' => 'required'
        ];
    }

     /**
     * Listener on validation fails.
     *
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()->all()[0],
            'message' => $validator->errors()->all()[0]
        ]));
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
