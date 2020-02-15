<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Payment extends Model
{
    protected $fillable = [];

    public function store(Request $request): Payment{
        $company = auth('api')->user()->getCompany();
        $this->amount = $request->amount;
        $this->repair_order_id = $request->repair_order_id;
        $this->payment_type_id = $request->payment_type_id;
        $this->currency_id = $company->currency_id;
        $this->save();
        return $this;
    }
}
