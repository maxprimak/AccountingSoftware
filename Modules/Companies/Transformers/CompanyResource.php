<?php

namespace Modules\Companies\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class CompanyResource extends Resource
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
            'name' => $this->name,
            'phone' => $this->phone,
            'tax' => $this->tax,
            'currency' => $this->getCurency(),
            'language' => $this->language,
            'address' => new AddressResource($this->address),
            'plan' => $this->getStripePlanName(),
            'extra_branches_paid' => $this->getExtraBranchesAmount(),
            'plan_expires_at' => $this->getPlanExpirationDate(),
        ];
    }
}
