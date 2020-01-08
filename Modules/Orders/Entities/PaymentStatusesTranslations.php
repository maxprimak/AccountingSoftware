<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PaymentStatusesTranslations extends Model
{
    protected $fillable = [];

    public function store(Request $request): PaymentStatusesTranslations{
      $this->name = $request->name;
      $this->payment_status_id = $request->payment_status_id;
      $this->language_id = $request->language_id;
      $this->save();
      return $this;
    }
}
