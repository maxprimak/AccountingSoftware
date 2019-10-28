<?php
namespace Modules\Companies\Facades;

use Illuminate\Support\Facades\Facade;

class BranchesService extends Facade{

    protected static function getFacadeAccessor(){
        return 'getUserBranches';
    }

}
