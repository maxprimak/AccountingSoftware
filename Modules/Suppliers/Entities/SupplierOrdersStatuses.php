<?php

namespace Modules\Suppliers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SupplierOrdersStatuses extends Model
{
    protected $fillable = [];

    protected $table = 'orders_to_supplier_statuses';

    public static function getPendingStatus()
    {
        $status_pending = self::find(1);
        return $status_pending;
    }

    public static function getReceivedStatus()
    {
        $status_received = self::find(3);
        return $status_received;
    }

    public function store(Request $request)
    {
        $this->name = $request->name;
        $this->hex_code = $request->hex_code;
        $this->save();
    }
}
