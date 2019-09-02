<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Modules\Users\Entities\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'login_id' => 1,
        'person_id' => 1,
        'company_id' =>  1,
    ];
});
