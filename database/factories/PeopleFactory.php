<?php

use Faker\Generator as Faker;
use Modules\Users\Entities\People;

$factory->define(People::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber
    ];
});
