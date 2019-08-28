<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Employees\Entities\Employee;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'role_id' => 1,
    ];
});
