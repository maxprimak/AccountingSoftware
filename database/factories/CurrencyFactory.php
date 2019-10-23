<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Modules\Companies\Entities\Currency;

$factory->define(Currency::class, function (Faker $faker) {

    return [
        'name' => 'Kazakhstan Tenge',
        'symbol' => 'KZT'
    ];

});
