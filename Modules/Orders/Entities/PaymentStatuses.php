<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Orders\Entities\PaymentStatusesTranslations;

class PaymentStatuses extends Model
{
    protected $fillable = [];

    public static function getPaymentStatusWithTranslation($payment_status_id)
    {
        $company = auth('api')->user()->getCompany();
        $payment_status = self::findOrFail($payment_status_id);
        $payment_status->name = PaymentStatusesTranslations::where('payment_status_id',$payment_status->id)->where('language_id',$company->language_id)->firstOrFail()->name;
        return $payment_status;
    }

    public static function getPaidStatus() : PaymentStatuses
    {
        $paid = self::getPaymentStatusWithTranslation(1);
        return $paid;
    }

    public function store(Request $request): PaymentStatusesTranslations{
      $this->save();
      $request->payment_status_id = $this->id;
      $payment_status_translation = new PaymentStatusesTranslations();
      $payment_status_translation = $payment_status_translation->store($request);
      return $payment_status_translation;
    }
}
