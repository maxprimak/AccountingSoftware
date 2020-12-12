<?php

use App\Model;
use Faker\Generator as Faker;
use Modules\Customers\Entities\CustomerHasBranch;

$factory->define(CustomerHasBranch::class, function (Faker $faker) {
    return [
        'customer_id' => 1,
        'branch_id' => 1,
    ];
});
