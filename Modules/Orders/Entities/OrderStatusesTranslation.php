<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderStatusesTranslation extends Model
{
    protected $fillable = ['name','order_status_id','language_id'];

    public function store(Request $request): OrderStatusesTranslation{
      $this->name = $request->name;
      $this->order_status_id = $request->order_status_id;
      $this->language_id = $request->language_id;
      $this->save();
      return $this;
    }

    /**
     * @return array
     */
    public static function getOrderStatusTranslation($status_id): OrderStatusesTranslation
    {
        $company = auth('api')->user()->getCompany();
        $status_translation = self::where('order_status_id',$status_id)->where('language_id',$company->language_id)->firstOrFail();
        return $status_translation;
    }


}
