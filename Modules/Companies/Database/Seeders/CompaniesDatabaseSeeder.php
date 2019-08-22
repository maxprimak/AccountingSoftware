<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Login\Entities\Login;

class CompaniesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //Users (ONLY TEMPORARY, DELETE THEN AND MOVE TO ANOTHER MODULES)
        factory('Modules\Login\Entities\Login')->create(['username' => 'oliinykm95']);
        factory('Modules\Users\Entities\People')->create();
        factory('Modules\Users\Entities\User')->create();

        //Add currency (Kazakstan Tenge)
        factory('Modules\Companies\Entities\Currency')->create();

        //Create Company of oliinykm95
        //TODO
        
    }
}
