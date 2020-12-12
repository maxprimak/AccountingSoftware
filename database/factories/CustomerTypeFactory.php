<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Modules\Customers\Entities\CustomerType;

$factory->define(CustomerType::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word.' company',
    ];
});
