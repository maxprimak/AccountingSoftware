<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Services\Entities\ServicesTranslation;
use Modules\Login\Entities\Login;
use Modules\Goods\Entities\Part;
use Modules\Services\Entities\ServiceHasPart;
use Modules\Services\Entities\CompanyHasService;

class Service extends Model
{
    protected $fillable = [];
    
    public function getTranslatedName($language_id){

        $translation = ServicesTranslation::where('service_id', $this->id)
                                            ->where('language_id', $language_id)
                                            ->first();
        return $translation->name;

    }

    public function getParts(){

        $has_part_ids = ServiceHasPart::where('service_id', $this->id)->pluck('part_id')->toArray();
        $parts = Part::whereIn('id', $has_part_ids)->get();
        
        return $parts;

    }

    public function getPartId(){
        if($this->getParts()->first() != null) return $this->getParts()->first()->id;
        else return null;
    }

    public function store(FormRequest $request){

        $this->is_custom = 1;
        $this->save();

        $company = auth('api')->user()->getCompany();

        $company_has_service = new CompanyHasService();
        $company_has_service->company_id = $company->id;
        $company_has_service->service_id = $this->id;
        $company_has_service->save();

        $translation = new ServicesTranslation();
        $translation->name = $request->name;
        $translation->service_id = $this->id;
        $translation->language_id = $company->language_id;
        $translation->save();

        if($request->has('part_id') && $request->part_id != null){

            $part = Part::find($request->part_id);

            $has_part = new ServiceHasPart();
            $has_part->store($part, $this->id);
            $has_part->save();

        }

        return $this;

    }

    
    public function storeUpdated(FormRequest $request){

        $translation = ServicesTranslation::where('service_id', $this->id)->first();
        $translation->name = $request->name;
        $translation->save();

        $has_part = ServiceHasPart::where('service_id', $this->id)->first();
        if($has_part != null) {
            if($request->has('part_id') && $request->part_id != null){
                $has_part->part_id = $request->part_id;
                $has_part->save();
            }else{
                $has_part->delete();
            }

        }
        else{
            if($request->has('part_id') && $request->part_id != null){
                $has_part = new ServiceHasPart();
                $has_part->service_id = $this->id;
                $has_part->part_id = $request->part_id;
                $has_part->save();
            }
        }

    }
}
