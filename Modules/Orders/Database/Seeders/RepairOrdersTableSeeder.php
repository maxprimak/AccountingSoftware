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
            'name' => 'Not repaired'
        ]);

        factory('Modules\Orders\Entities\OrderStatus')->create([
            'name' => 'Called'
        ]);

        factory('Modules\Orders\Entities\OrderStatus')->create([
            'name' => 'Ready'
        ]);
        
        for($i = 0; $i < 10; $i++){
            $order = factory('Modules\Orders\Entities\Order')->create([
                'branch_id' => 1
            ]);
            factory('Modules\Orders\Entities\RepairOrder')->create([
                'order_id' => $order->id
            ]);
        }

        for($i = 0; $i < 10; $i++){
            $order = factory('Modules\Orders\Entities\Order')->create([
                'branch_id' => 2
            ]);
            factory('Modules\Orders\Entities\RepairOrder')->create([
                'order_id' => $order->id
            ]);
        }

        for($i = 0; $i < 10; $i++){
            $order = factory('Modules\Orders\Entities\Order')->create([
                'branch_id' => 3
            ]);
            factory('Modules\Orders\Entities\RepairOrder')->create([
                'order_id' => $order->id
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
