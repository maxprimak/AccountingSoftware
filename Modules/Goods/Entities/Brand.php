<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name'];

    public function store($request): Brand{
        $this->name = $request->name;
        $this->logo = $request->logo;
        $this->save();
        return $this;
    }

}
