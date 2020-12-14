<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PartsTranslation extends Model
{
    use Searchable;
    protected $fillable = ['name','part_id','language_id'];

    public function store($request): PartsTranslation{

      $this->name = $request->name;
      $this->part_id = $request->part_id;
      $user = auth('api')->user();
      if($user){
        $company = $user->getCompany();
        $this->language_id = $company->language_id;
      }
      $this->save();
      return $this;
    }

    public function goods() {
        return $this->hasMany (Good::class, 'part_id', 'part_id');
    }
}
