<?php

namespace Modules\Companies\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'phone', 'address'];
}
