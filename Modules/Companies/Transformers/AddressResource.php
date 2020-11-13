<?php

namespace Modules\Companies\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class AddressResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'house_number' => $this->house_number,
            'postcode' => $this->postcode,
            'street_name' => $this->street_name,
            'city' => new CityResource($this->city),
        ];
    }
}
