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
        $color->hex_code = "#D3D3D3";
        $color->save();

        $color = new Color();
        $color->name = "Black";
        $color->hex_code = "#222";
        $color->save();

        $color = new Color();
        $color->name = "White";
        $color->hex_code = "#fff";
        $color->save();

        $color = new Color();
        $color->name = "Silver";
        $color->hex_code = "#C0C0C0";
        $color->save();

        $color = new Color();
        $color->name = "Product Red";
        $color->hex_code = "#ff0000";
        $color->save();

        $color = new Color();
        $color->name = "Space Gray";
        $color->hex_code = "#808080";
        $color->save();

        $color = new Color();
        $color->name = "Midnight Green";
        $color->hex_code = "#004953";
        $color->save();

        $color = new Color();
        $color->name = "Gold";
        $color->hex_code = "#004953";
        $color->save();

        $color = new Color();
        $color->name = "Blue";
        $color->hex_code = "#ffd700";
        $color->save();

        $color = new Color();
        $color->name = "Pink";
        $color->hex_code = "#ffc0cb";
        $color->save();

        $color = new Color();
        $color->name = "Yellow";
        $color->hex_code = "#ffff00";
        $color->save();

        $color = new Color();
        $color->name = "Green";
        $color->hex_code = "#00ff00";
        $color->save();


    }
}
