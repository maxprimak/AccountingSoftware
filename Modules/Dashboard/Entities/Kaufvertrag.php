<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class Kaufvertrag extends Model
{
    protected $fillable = ['name', 'telefon', 'adresse', 'ort_plz', 'mobil', 'tablet', 'modell', 'imei', 'text_body', 'ort_datum'];
}
