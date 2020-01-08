<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\OrderTypesTranslations;

class OrderTypes extends Model
{
    protected $fillable = [];

    public function store($request): OrderTypesTranslations{
      $this->save();
      $request->order_type_id = $this->id;
      $order_type_translation = new OrderTypesTranslations();
      $order_type_translation = $order_type_translation->store($request);
      return $order_type_translation;
    }
}
