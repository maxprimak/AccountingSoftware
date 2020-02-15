<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ReworkOrders extends Model
{
    protected $fillable = [];

    public function store(Request $request): ReworkOrders{
      $this->repair_order_id = $request->repair_order_id;
      $this->order_type_id = $request->order_type_id;
      $this->save();
      return $this;
    }
}
