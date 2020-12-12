<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Companies\Transformers\CompanyResource;

class UserResource extends JsonResource
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
                'company' => new CompanyResource($this->user->company),
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
            'is_registered' => $this->isRegistered() ? 1 : 0,
            $this->mergeWhen (auth('api')->user()->user, $userPart)
        ];
    }
}
