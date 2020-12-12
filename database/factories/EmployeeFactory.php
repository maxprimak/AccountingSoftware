<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Modules\Employees\Entities\Employee;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'role_id' => 1,
    ];
});
