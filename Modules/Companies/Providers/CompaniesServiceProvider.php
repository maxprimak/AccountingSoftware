<?php

namespace Modules\Companies\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class CompaniesServiceProvider extends ServiceProvider
{
    public function register(){
        $this->app->bind('getUserBranches', 'Modules\Companies\Services\GetUserBranches');
    }
}
