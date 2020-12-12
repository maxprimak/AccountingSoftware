<?php

use App\Model;
use Faker\Generator as Faker;
use Modules\Customers\Entities\Customer;

$factory->define(Customer::class, function (Faker $faker) {
    return [
      'person_id' => 1,
      'stars_number' => $faker->numberBetween(10, 20),
      'type_id' => 1,
      'company_id' => 1,
    ];
});
