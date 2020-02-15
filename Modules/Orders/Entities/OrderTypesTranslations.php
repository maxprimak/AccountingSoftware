<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Company;

class OrderTypesTranslations extends Model
{
    protected $fillable = [];

    public function store($request): OrderTypesTranslations{
      $this->order_type_id = $request->order_type_id;
      $this->name = $request->name;
      $this->language_id = $request->language_id;
      $this->save();
      return $this;
    }
}
