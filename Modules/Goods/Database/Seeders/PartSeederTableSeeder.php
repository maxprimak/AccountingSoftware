<?php

namespace Modules\Goods\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\Part;
use Illuminate\Http\Request;

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

        $request = new Request();
        $part = new Part();
        $request->name = "Display";
        $part->save();
        $part->storePartTranslation($request);

        $part = new Part();
        $request->name = "Battery";
        $part->save();

        $part = new Part();
        $request->name = "Side Buttons";
        $part->save();
        $part->storePartTranslation($request);

        $part = new Part();
        $request->name = "Vibration motor";
        $part->save();
        $part->storePartTranslation($request);

        $part = new Part();
        $request->name = "Home-button";
        $part->save();
        $part->storePartTranslation($request);

        $part = new Part();
        $request->name = "Front-camera";
        $part->save();
        $part->storePartTranslation($request);

        $part = new Part();
        $request->name = "Main-camera";
        $part->save();
        $part->storePartTranslation($request);
    }
}
