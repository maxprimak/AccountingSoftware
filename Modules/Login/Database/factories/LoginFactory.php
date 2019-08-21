<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Login\Entities\Login;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Login::class, function (Faker $faker) {
    return [
        'username' => $faker->username,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('123456789'),
        'remember_token' => Str::random(10)
    ];
});
