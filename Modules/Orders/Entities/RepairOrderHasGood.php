<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Branch;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Color;
use Modules\Goods\Entities\Part;
use Modules\Warehouses\Entities\Warehouse;

class RepairOrderHasGood extends Model
{
    protected $fillable = [];

    public function store($warehouse_has_good,$repair_order_id,$device_id): RepairOrderHasGood{
        $this->repair_order_id = $repair_order_id;
        $this->warehouse_has_good_id = $warehouse_has_good['id'];
        $this->is_used = 0;
        $this->amount = $warehouse_has_good['amount'];
        $this->device_id = $device_id;
        $this->save();
      return $this;
    }

    public function combineGoodsRepairOrderHasGood($repair_order_has_goods,$goods){
        $result = array();
        foreach ($repair_order_has_goods as $repair_order_has_good){
                foreach ($goods as $good){
                    if($repair_order_has_good['warehouse_has_good_id'] == $good['warehouse_has_good_id']){
                        $good['amount_in_order'] = $repair_order_has_good->amount;
                        array_push($result,$good);
                    }
                }
        }
        return $result;
    }

    public function deleteExistingGoods($repair_order_id, $device_id){
        $repair_order_has_goods = $this::where('repair_order_id',$repair_order_id)
                        ->where('device_id', $device_id)->get();
        foreach ($repair_order_has_goods as $repair_order_has_good){
            $repair_order_has_good->delete();
        }
    }
}
