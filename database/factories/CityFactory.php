<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Modules\Companies\Entities\City;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => 'Vienna',
        'country_id' => 1
    ];
});
