<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Brand extends Model
{
    use Searchable;

    protected $fillable = ['name'];

    public function store($request): Brand{
        $this->name = $request->name;
        $this->logo = $request->logo;
        $this->save();
        return $this;
    }

    public function goods() {
        return $this->hasMany (Good::class);
    }

}
