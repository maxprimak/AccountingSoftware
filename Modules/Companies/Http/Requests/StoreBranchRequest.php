<?php

namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Modules\Companies\Rules\SubscriptionRuleBranches;

class StoreBranchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', new SubscriptionRuleBranches],
            'color' => ['required', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
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
