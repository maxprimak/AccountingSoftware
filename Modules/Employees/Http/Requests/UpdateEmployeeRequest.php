<?php

namespace Modules\Employees\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Modules\Employees\Entities\Employee;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        $employee = null;

        if($this->route('employee_id'))
        {
            $employee = Employee::join('users', 'users.id', '=', 'employees.user_id')
                                ->select('users.login_id', 'users.person_id')
                                ->find($this->route('employee_id'));
        }

        return [
            'name' => 'required',
            'username' => 'required|min:6|unique:logins,username,' . $employee->login_id,
            'password' => 'nullable|min:8',
            'email' => 'required|email|unique:logins,email,' . $employee->login_id,
            'phone' => 'required|unique:people,phone,' . $employee->person_id,
            'role_id' => 'required',
            'branch_id' => 'required',
            'is_active' => 'required',
        ];
    }

     /**
     * Listener on validation fails.
     *
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        // dd($employee_id);
        // dd($this->route('login_id'));
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
