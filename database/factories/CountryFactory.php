<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Modules\Companies\Entities\Country;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => 'Austria',
        'code' => 'AT',
    ];
});
