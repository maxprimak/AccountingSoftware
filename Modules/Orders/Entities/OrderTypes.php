<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\OrderTypesTranslations;

class OrderTypes extends Model
{
    protected $fillable = [];

    public static function getOrderTypeWithTranslation($repair_order)
    {
        $company = auth('api')->user()->getCompany();
        $order_type = self::findOrFail($repair_order->order_type_id);
        $order_type->name = OrderTypesTranslations::where('order_type_id',$order_type->id)->where('language_id',$company->language_id)->firstOrFail()->name;
        return $order_type;
    }

    public function store($request): OrderTypesTranslations{
      $this->save();
      $request->order_type_id = $this->id;
      $order_type_translation = new OrderTypesTranslations();
      $order_type_translation = $order_type_translation->store($request);
      return $order_type_translation;
    }

    public function isRework(){
        return $this->id == 3;
    }

    public function getTranslatedName($language_id){
        return OrderTypesTranslations::where('order_type_id', $this->id)->where('language_id', $language_id)->first()->name;
    }
}
