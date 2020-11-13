<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Companies\Transformers\CompanyResource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $userPart = [];
        if ($this->user){
            $userPart = [
                'company' => $this->user->company,
                'orders_left' => $this->user->company->getOrdersLeft(),
                'current_plan' => $this->user->company->getStripePlanName(),
            ];
        }
        return [
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'id' => $this->id,
            'is_active' => $this->is_active,
            'username' => $this->username,
            $this->mergeWhen (auth('api')->user()->user, $userPart),
//            'comapny' => new CompanyResource($this->user->company)
//            'person' => new PersonResource($this->user)
        ];
    }
}
