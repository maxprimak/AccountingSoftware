<?php

namespace Modules\Customers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MarketingChannel extends Model
{
    protected $fillable = [];

    public function store(Request $request): MarketingChannel
    {
        $this->name = $request->name;
        $this->save();
        return $this;
    }
}
