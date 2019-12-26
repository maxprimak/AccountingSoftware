<?php

namespace Modules\Devices\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'submodel_id' => 'required|exists:submodels,id',
            'color_id' => 'required|exists:colors,id',
            'serial_nr' => 'required|unique:devices,serial_nr'
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
