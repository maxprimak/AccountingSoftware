<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class SalesOrder extends Model
{
    protected $fillable = [];

    public function store(FormRequest $request, $order_id){

        $this->article_description = $request->article_description;
        $this->payment_type_id = $request->payment_type_id;
        $this->order_id = $order_id;

        $this->save();

        return $this;

    }

    public function storeUpdated(FormRequest $request){

        $this->article_description = $request->article_description;
        $this->payment_type_id = $request->payment_type_id;

        $this->save();

        return $this;
        
    }

}
