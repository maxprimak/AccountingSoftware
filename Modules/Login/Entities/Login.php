<?php

namespace Modules\Login\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    protected $fillable = ['id', 'username', 'password', 'remember_token'];
    public $timestamps = false;
}
