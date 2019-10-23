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
            'name' => 'required',
            'username' => 'required|min:6|unique:logins,username',
            'password' => 'required|min:8',
            're_password' => 'required|same:password',
            'email' => 'required|email|unique:logins,email',
            'phone' => 'required|unique:people,phone',
            'role_id' => 'required',
            'branch_id' => 'required'
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
