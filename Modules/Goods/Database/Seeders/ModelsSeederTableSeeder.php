<?php

namespace Modules\Goods\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\Models;

class ModelsSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //CATEGORIES Models
        //APPLE Models
        $Models = new Models();
        $Models->brand_id = 1;
        $Models->name = "iPhone";
        $Models->save();

        $Models = new Models();
        $Models->brand_id = 1;
        $Models->name = "iPad";
        $Models->save();

        $Models = new Models();
        $Models->brand_id = 1;
        $Models->name = "Apple Watch";
        $Models->save();

        $Models = new Models();
        $Models->brand_id = 1;
        $Models->name = "MacBook";
        $Models->save();

        //SAMSUNG Models
        $Models = new Models();         
        $Models->brand_id = 2;
        $Models->name = "Galaxy";
        $Models->save();

    }
}
