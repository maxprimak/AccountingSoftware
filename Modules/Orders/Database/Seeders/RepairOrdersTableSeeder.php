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

        $statuses = [
            'Accepted for repair',
            'In progress',
            'Order parts',
            'Waiting for parts',
            'Repaired',
            'Not repairable',
            'Called to client',
            'Returned to client',
            'Warranty',
        ];

        foreach($statuses as $status){
            factory('Modules\Orders\Entities\OrderStatus')->create([
                'name' => $status
            ]);
        }

        factory('Modules\Orders\Entities\PaymentType')->create([
            'name' => 'Cash'
        ]);

        factory('Modules\Orders\Entities\PaymentType')->create([
            'name' => 'Card'
        ]);
        
    }
}
