<?php

namespace Modules\Companies\Entities;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name', 'company_id'];
}
