<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\SalesOrder;

$factory->define(SalesOrder::class, function (Faker $faker) {
    $order = factory('Modules\Orders\Entities\Order')->create([
        'accept_date' => date('Y-m-d'),
    ]);

    return [
        'order_id' => $order->id,
        'article_description' => $faker->text(70),
        'payment_type_id' => 1,
    ];
});
