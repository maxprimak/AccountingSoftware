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
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'required|unique:people,phone',
            'stars_number' => 'numeric',
            'customer_type_id' => 'required | numeric',
            'branch_id' => 'required',
            'marketing_channel_id' => 'nullable|exists:marketing_channels,id',
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
