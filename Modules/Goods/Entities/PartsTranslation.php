<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class PartsTranslation extends Model
{
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
}
