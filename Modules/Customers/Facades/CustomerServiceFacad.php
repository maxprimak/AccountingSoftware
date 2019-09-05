<?php
namespace Modules\Customers\Facades;

use Illuminate\Support\Facades\Facade;

class CustomerServiceFacad extends Facade{

    protected static function getFacadeAccessor(){
        return 'customerServices';
    }

}
