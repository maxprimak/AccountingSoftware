<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Modules\Companies\Entities\Branch;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word . ' branch',
        'company_id' => 1,
        'color' => '#F64272',
        'address' => $faker->address,
        'phone' => $faker->phoneNumber
    ];
});
