<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\CompanyHasPart;
use Modules\Goods\Entities\PartsTranslation;

class Part extends Model
{
    protected $fillable = ['name'];

    public function store($request){
      $this->is_custom = 1;
      $this->save();
      $this->storePartTranslation($request);
      $this->addToCompany($request);
      return $this;
    }

    public function storePartTranslation($request): PartsTranslation{
      $part_translation = new PartsTranslation();
      $request->part_id = $this->id;
      $part_translation = $part_translation->store($request);
      return $part_translation;
    }

    public function checkIfExistsInCompany(){
      $company = auth('api')->user()->getCompany();
      return CompanyHasPart::where('company_id',$company->id)->where('part_id',$this->id)->exists();
    }

    public function addToCompany($request){
      $company = auth('api')->user()->getCompany();
      $request->company_id = $company->id;
      $request->part_id = $this->id;
      $company_has_part = new CompanyHasPart();
      $company_has_part = $company_has_part->store($request);
      return $company_has_part;
    }

    public function getTranslatedName($language_id){
      return PartsTranslation::where('part_id', $this->id)->where('language_id', $language_id)->first()->name;
    }

}
