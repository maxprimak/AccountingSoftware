<?php

use Faker\Generator as Faker;
use Modules\Users\Entities\UserHasBranch;

$factory->define(UserHasBranch::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'branch_id' => 1
    ];
});
