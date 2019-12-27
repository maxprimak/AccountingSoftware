<?php

namespace Modules\Goods\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoodRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          // 'part_id ' => 'required |exists:parts,id',
          // 'color_id '=>' required |exists:colors,id',
          // 'warehouse_has_good_id '=>' required |exists:warehouse_has_goods,id',
          // 'vendor_code '=>' nullable',
          // 'amount '=>' required|numeric| max:490 |min:1',
          // 'retail_price '=>' nullable',
          // 'wholesale_price '=>' nullable'
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
