<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Companies\Entities\Branch;

class Order extends Model
{
    protected $fillable = ['accept_date', 'price', 'branch_id', 'created_by'];

    public function store(FormRequest $request){

            $this->accept_date = $request->accept_date;
            $this->price = $request->price;
            $this->branch_id = $request->branch_id;
            $this->created_by = auth('api')->user()->id;

            $this->save();

            return $this;

    }

    public function storeUpdated(FormRequest $request, $id){

        $order = Order::find($id);

        $order->accept_date = $request->accept_date;
        $order->price = $request->price;

        $order->update();

        return $order;

    }

    public function getBranch(): Branch{
            $branch = Branch::findOrFail($this->branch_id);
            return $branch;
    }
}
