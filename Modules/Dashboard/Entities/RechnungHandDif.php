<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class RechnungHandDif extends Model
{
    protected $fillable = ['number', 'date', 'shop', 'shop_tel', 'shop_email', 'web', 'kundenbetreuer', 
            'zahlungsmodalitat', 'kunde', 'kunde_tel', 'kunde_email', 'text_head', 'text_body'];
}
