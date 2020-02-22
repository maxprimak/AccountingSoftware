<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [];

    public static function getMyLanguageId(){
        return auth('api')->user()->getCompany()->language_id;
    }
}
