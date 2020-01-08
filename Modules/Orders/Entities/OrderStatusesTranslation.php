<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderStatusesTranslation extends Model
{
    protected $fillable = [];

    public function store(Request $request): OrderStatusesTranslation{
      $this->name = $request->name;
      $this->order_status_id = $request->order_status_id;
      $this->language_id = $request->language_id;
      $this->save();
      return $this;
    }
}
