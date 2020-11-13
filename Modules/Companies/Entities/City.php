<?php

namespace Modules\Companies\Entities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo (Country::class);
    }
}
