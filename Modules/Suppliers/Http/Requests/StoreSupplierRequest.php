<?php

namespace Modules\Suppliers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'email' => 'nullable|email:rfc,dns|max:190',
            'comment' => 'nullable|max:700',
            'country_id' => 'required|exists:countries,id',
            'city_name' => 'required|max:190',
            'street_name' => 'required|max:190',
            'house_number' => 'required|max:190',
            'postcode' => 'required|max:190',
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
