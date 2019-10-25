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
          $Models->name = "Galaxy S";
          $Models->save();

          //SAMSUNG Models
          $Models = new Models();
          $Models->brand_id = 2;
          $Models->name = "Galaxy Note";
          $Models->save();

          //SAMSUNG Models
          $Models = new Models();
          $Models->brand_id = 2;
          $Models->name = "Galaxy J";
          $Models->save();

          //SAMSUNG Models
          $Models = new Models();
          $Models->brand_id = 2;
          $Models->name = "Galaxy A";
          $Models->save();

          //SAMSUNG Models
          $Models = new Models();
          $Models->brand_id = 2;
          $Models->name = "Galaxy M";
          $Models->save();

          //SAMSUNG Models
          $Models = new Models();
          $Models->brand_id = 2;
          $Models->name = "Galaxy Tab";
          $Models->save();


          //HUAWEI Models
            $Models = new Models();
            $Models->brand_id = 3;
            $Models->name = "Mate";
            $Models->save();

            $Models = new Models();
            $Models->brand_id = 3;
            $Models->name = "P";
            $Models->save();

            $Models = new Models();
            $Models->brand_id = 3;
            $Models->name = "Y";
            $Models->save();

            $Models = new Models();
            $Models->brand_id = 3;
            $Models->name = "Nova";
            $Models->save();

            $Models = new Models();
            $Models->brand_id = 3;
            $Models->name = "Honor";
            $Models->save();

            //LG Models
              $Models = new Models();
              $Models->brand_id = 4;
              $Models->name = "Q";
              $Models->save();

              $Models = new Models();
              $Models->brand_id = 4;
              $Models->name = "G";
              $Models->save();

              $Models = new Models();
              $Models->brand_id = 4;
              $Models->name = "K";
              $Models->save();

              $Models = new Models();
              $Models->brand_id = 4;
              $Models->name = "Y";
              $Models->save();

              $Models = new Models();
              $Models->brand_id = 4;
              $Models->name = "G Tab";
              $Models->save();

        //SONY Models
          $Models = new Models();
          $Models->brand_id = 5;
          $Models->name = "Xperia";
          $Models->save();

          $Models = new Models();
          $Models->brand_id = 5;
          $Models->name = "Xperia X";
          $Models->save();

          $Models = new Models();
          $Models->brand_id = 5;
          $Models->name = "Xperia Z";
          $Models->save();

          $Models = new Models();
          $Models->brand_id = 5;
          $Models->name = "Xperia L";
          $Models->save();

          //OnePlus Models
            $Models = new Models();
            $Models->brand_id = 6;
            $Models->name = "OnePlus";
            $Models->save();

            $Models = new Models();
            $Models->brand_id = 6;
            $Models->name = "OnePlus T";
            $Models->save();

            $Models = new Models();
            $Models->brand_id = 6;
            $Models->name = "OnePlus Pro";
            $Models->save();

        //OnePlus Models
          $Models = new Models();
          $Models->brand_id = 7;
          $Models->name = "Oppo A";
          $Models->save();

          $Models = new Models();
          $Models->brand_id = 7;
          $Models->name = "Oppo K";
          $Models->save();

          $Models = new Models();
          $Models->brand_id = 7;
          $Models->name = "Oppo R";
          $Models->save();

          $Models = new Models();
          $Models->brand_id = 7;
          $Models->name = "Oppo Reno";
          $Models->save();

    }
}
