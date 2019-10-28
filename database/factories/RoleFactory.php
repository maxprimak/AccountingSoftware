<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Employees\Entities\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
