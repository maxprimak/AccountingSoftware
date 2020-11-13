<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ReworkOrders extends Model
{
    public function reworkOrderHasWarrantyCases () {
        return $this->belongsToMany (ReworkOrderHasWarrantyCase::class);
    }

    protected $fillable = [];

    public static function boot() {
        parent::boot();

        static::deleting(function($rework_order) {
            $rework_order->reworkOrderHasWarrantyCases->delete();

        });
    }

    public function store(Request $request): ReworkOrders{
      $this->repair_order_id = $request->repair_order_id;
      $this->order_type_id = $request->order_type_id;
      $this->save();
      return $this;
    }
}
