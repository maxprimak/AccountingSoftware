<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Orders\Entities\PaymentStatusesTranslations;

class PaymentStatuses extends Model
{
    protected $fillable = [];

    public static function getPaymentStatusWithTranslation($repair_order)
    {
        $company = auth('api')->user()->getCompany();
        $payment_status = self::findOrFail($repair_order->payment_status_id);
        $payment_status->name = PaymentStatusesTranslations::where('payment_status_id',$payment_status->id)->where('language_id',$company->language_id)->firstOrFail()->name;
        return $payment_status;
    }

    public function store(Request $request): PaymentStatusesTranslations{
      $this->save();
      $request->payment_status_id = $this->id;
      $payment_status_translation = new PaymentStatusesTranslations();
      $payment_status_translation = $payment_status_translation->store($request);
      return $payment_status_translation;
    }
}
