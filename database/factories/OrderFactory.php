<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Modules\Orders\Entities\Order;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'accept_date' =>  $faker->date('Y-m-d', '1461067200'),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 100),
        'branch_id' => 1,
        'created_by' => 1,
    ];
});
