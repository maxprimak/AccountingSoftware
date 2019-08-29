<?php

namespace Modules\Customers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CustomersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //Create 5 Customers
        factory('Modules\Customers\Entities\Customer')->create();

        factory('Modules\Customers\Entities\CustomerHasBranch')->create();

    }
}
