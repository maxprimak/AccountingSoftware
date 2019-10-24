<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\RepairOrder;

class RepairOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory('Modules\Orders\Entities\OrderStatus')->create([
            'name' => 'Called'
        ]);

        factory('Modules\Orders\Entities\RepairOrder',10)->create();

    }
}
