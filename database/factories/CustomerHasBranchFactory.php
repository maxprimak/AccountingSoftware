<?php

use App\Model;
use Modules\Customers\Entities\CustomerHasBranch;
use Faker\Generator as Faker;

$factory->define(CustomerHasBranch::class, function (Faker $faker) {
    return [
        'customer_id' => 1,
        'branch_id' => 1
    ];
});
