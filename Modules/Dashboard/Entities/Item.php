<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['artikelbeschreibung', 'menge', 'preis', 'kost29'];
}
