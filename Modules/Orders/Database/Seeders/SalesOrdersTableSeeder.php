<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SalesOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory('Modules\Orders\Entities\SalesOrder',10)->create();
    }
}
