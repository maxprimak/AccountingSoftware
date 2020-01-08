<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Orders\Entities\PaymentStatusesTranslations;

class PaymentStatuses extends Model
{
    protected $fillable = [];

    public function store(Request $request): PaymentStatusesTranslations{
      $this->save();
      $request->payment_status_id = $this->id;
      $payment_status_translation = new PaymentStatusesTranslations();
      $payment_status_translation = $payment_status_translation->store($request);
      return $payment_status_translation;
    }
}
