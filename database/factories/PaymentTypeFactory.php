<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Modules\Orders\Entities\PaymentType;

$factory->define(PaymentType::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
