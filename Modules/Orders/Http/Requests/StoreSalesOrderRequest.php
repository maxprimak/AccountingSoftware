<?php

namespace Modules\Orders\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'accept_date' => 'required|date|before:tomorrow',
            'price' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
            'article_description' => 'required|max:190',
            'payment_type_id' => 'required|exists:payment_types,id',
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
