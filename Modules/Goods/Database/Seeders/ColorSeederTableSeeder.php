<?php

namespace Modules\Goods\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\Color;

class ColorSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $color = new Color();
        $color->name = "none";
        $color->save();

        $color = new Color();
        $color->name = "Black";
        $color->save();

        $color = new Color();
        $color->name = "White";
        $color->save();

        $color = new Color();
        $color->name = "Silver";
        $color->save();

        $color = new Color();
        $color->name = "Product Red";
        $color->save();

        $color = new Color();
        $color->name = "Space Gray";
        $color->save();

        $color = new Color();
        $color->name = "Midnight Green";
        $color->save();

        $color = new Color();
        $color->name = "Gold";
        $color->save();

        $color = new Color();
        $color->name = "Blue";
        $color->save();

        $color = new Color();
        $color->name = "Pink";
        $color->save();

        $color = new Color();
        $color->name = "Yellow";
        $color->save();

        $color = new Color();
        $color->name = "Green";
        $color->save();


    }
}
