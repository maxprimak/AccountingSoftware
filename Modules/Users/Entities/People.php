<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = ['name', 'phone', 'address'];
}
