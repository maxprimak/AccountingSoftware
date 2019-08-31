<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['login_id', 'person_id', 'branch_id', 'is_active'];

}
