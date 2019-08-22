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

        //Add currency (Kazakstan Tenge)
        factory('Modules\Companies\Entities\Currency')->create();

        //Create Company of oliinykm95
        factory('Modules\Companies\Entities\Company')->create();

        //Create 5 Branches of this company
        factory('Modules\Companies\Entities\Branch', 5)->create();
        
    }
}
