<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Modules\Companies\Entities\Company;

$factory->define(Company::class, function (Faker $faker) {
    return [
        //account_id 
        //package_id 
        'name' => $faker->unique()->word.' company',
        'currency_id' => 1,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber
    ];
});
