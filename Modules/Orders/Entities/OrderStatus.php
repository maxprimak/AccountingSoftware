<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Orders\Entities\OrderStatusesTranslation;

class OrderStatus extends Model
{
    protected $fillable = [];

    public function store(Request $request): OrderStatusesTranslation{
      $this->hex_code = $request->hex_code;
      $this->save();

      $request->order_status_id = $this->id;
      $order_status_translation = new OrderStatusesTranslation();
      $order_status_translation = $order_status_translation->store($request);
      return $order_status_translation;
    }

    public function getTranslatedName(){

      return OrderStatusesTranslation::where('order_status_id', $this->id)
                                      ->where('language_id', 1)
                                      ->first()->name;

    }
}
