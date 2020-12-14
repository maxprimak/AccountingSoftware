<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Models extends Model
{
    use Searchable;

    protected $fillable = ['brand_id','name'];

    public function store($request){
      $this->brand_id = $request->brand_id;
      $this->name = $request->name;
      $this->logo = $request->logo;
      $this->save();
    }

    public function goods() {
        return $this->hasMany (Good::class, 'model_id');
    }
}
