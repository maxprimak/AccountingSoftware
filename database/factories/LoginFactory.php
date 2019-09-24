<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Modules\Login\Entities\Login;

$factory->define(Login::class, function (Faker $faker) {

    $email = $faker->unique()->email;

    return [
        'username' => $email,
        'password' => bcrypt('123456789'),
        'email' => $email,
        'email_verified_at' => now(),
        'api_token' => Str::random(60)
    ];
});
