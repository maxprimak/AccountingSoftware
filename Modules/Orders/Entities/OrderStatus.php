<?php

namespace Modules\Orders\Entities;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Orders\Entities\OrderStatusesTranslation;

class OrderStatus extends Model
{
    protected $fillable = [];

    public static function getOrderStatusWithTranslation($repair_order)
    {
        $order_status = self::findOrFail($repair_order->status_id);
        $order_status->name = OrderStatusesTranslation::getOrderStatusTranslation($repair_order->status_id)->name;
        return $order_status;
    }

    public static function getOrderStatusesWithTranslations()
    {
        $company = auth('api')->user()->getCompany();
        return DB::table('order_statuses')
            ->join('order_statuses_translations','order_statuses_translations.order_status_id', '=', 'order_statuses.id')
            ->select('order_statuses.id as id', 'order_statuses.hex_code as hex_code','order_statuses_translations.name as name')
            ->where('order_statuses_translations.language_id',$company->language_id)
            ->get();
    }

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
