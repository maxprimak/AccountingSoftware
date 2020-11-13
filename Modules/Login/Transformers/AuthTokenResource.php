<?php

namespace Modules\Login\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class AuthTokenResource extends Resource
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
            'access_token' => $this->accessToken,
            'token_type' => 'Bearer',
            'expires_in' => Carbon::parse(
                $this->token->expires_at
            )->toDateTimeString()
        ];
    }
}
