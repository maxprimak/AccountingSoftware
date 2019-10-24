<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class RechnungItem extends Model
{
    protected $fillable = ['artikelbeschreibung', 'menge', 'preis'];
}
