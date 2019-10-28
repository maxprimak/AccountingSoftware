<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\Order;

$factory->define(RepairOrder::class, function (Faker $faker) {

    $order = factory('Modules\Orders\Entities\Order')->create();

    return [
        'order_nr' => $faker->swiftBicNumber(),
        'order_id' => $order->id,
        'customer_id' => 1,
        'located_in' => $order->branch_id,
        'defect_description' => $faker->text(50),
        'comment' => $faker->text(100),
        'prepay_sum' => $faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 1000),
        'status_id' => $faker->numberBetween(1,3)
    ];
});
