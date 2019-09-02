<?php
namespace Modules\Users\Facades;

use Illuminate\Support\Facades\Facade;

class CreateUsersService extends Facade{

    protected static function getFacadeAccessor(){
        return 'createUsers';
    }

}