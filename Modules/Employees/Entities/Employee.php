<?php

namespace Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['user_id', 'role_id'];
}
