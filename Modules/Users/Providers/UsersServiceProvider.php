<?php

namespace Modules\Users\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class UsersServiceProvider extends ServiceProvider
{
    public function register(){
        $this->app->bind('createUsers', 'Modules\Users\Services\CreateUsers');
    }
}
