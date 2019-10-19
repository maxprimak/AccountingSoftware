<?php

namespace Modules\Goods\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\Part;

class PartSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $part = new Part();
        $part->name = "Display";
        $part->save();

        $part = new Part();
        $part->name = "Battery";
        $part->save();

        $part = new Part();
        $part->name = "Side Buttons";
        $part->save();

        $part = new Part();
        $part->name = "Vibration motor";
        $part->save();

        $part = new Part();
        $part->name = "Home-button";
        $part->save();

        $part = new Part();
        $part->name = "Front-camera";
        $part->save();

        $part = new Part();
        $part->name = "Main-camera";
        $part->save();
    }
}
