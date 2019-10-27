<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Modules\Customers\Entities\CustomerType;
use Faker\Generator as Faker;

$factory->define(CustomerType::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word.' company',
    ];
});
