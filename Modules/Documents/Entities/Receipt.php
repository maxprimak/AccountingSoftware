<?php

namespace Modules\Documents\Entities;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = ['branch_id', 'main_text', 'language_id'];
}
