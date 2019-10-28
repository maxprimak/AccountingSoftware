<?php

use Faker\Generator as Faker;
use Modules\Goods\Entities\Good;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Submodel;
use Modules\Goods\Entities\Part;
use Modules\Goods\Entities\Color;


$factory->define(Good::class, function (Faker $faker) {

    $model = Models::where('brand_id',1)->get()->random(1)->first();
    $submodel = Submodel::where('model_id',$model->id)->get()->random(1)->first();
    $part = Part::all()->random(1)->first();
    $color = Color::all()->random(1)->first();
    return [
      'branch_id' => 1,
      'brand_id' => 1,
      'model_id' => $model->id,
      'submodel_id' => $submodel->id,
      'part_id' => $part->id,
      'color_id' => $color->id,
      'amount' => $faker->numberBetween(10,50),
      'price' => $faker->numberBetween(50,300),
    ];

});
