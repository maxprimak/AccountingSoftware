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
          $Models->name = "Smartphones";
          $Models->save();

          //SAMSUNG Models
          $Models = new Models();
          $Models->brand_id = 2;
          $Models->name = "Tablets";
          $Models->save();

          //SAMSUNG Models
          $Models = new Models();
          $Models->brand_id = 2;
          $Models->name = "Watches";
          $Models->save();

          //SAMSUNG Models
          $Models = new Models();
          $Models->brand_id = 2;
          $Models->name = "Laptops";
          $Models->save();

          //HUAWEI Models
            $Models = new Models();
            $Models->brand_id = 3;
            $Models->name = "Smartphones";
            $Models->save();

            $Models = new Models();
            $Models->brand_id = 3;
            $Models->name = "Tablets";
            $Models->save();

            $Models = new Models();
            $Models->brand_id = 3;
            $Models->name = "Watches";
            $Models->save();

            $Models = new Models();
            $Models->brand_id = 3;
            $Models->name = "Laptops";
            $Models->save();

            //LG Models
              $Models = new Models();
              $Models->brand_id = 4;
              $Models->name = "Smartphones";
              $Models->save();

              $Models = new Models();
              $Models->brand_id = 4;
              $Models->name = "Tablets";
              $Models->save();

        //SONY Models
          $Models = new Models();
          $Models->brand_id = 5;
          $Models->name = "Smartphones";
          $Models->save();

        //OnePlus Models
          $Models = new Models();
          $Models->brand_id = 6;
          $Models->name = "Smartphones";
          $Models->save();

        //Oppo Models
          $Models = new Models();
          $Models->brand_id = 7;
          $Models->name = "Smartphones";
          $Models->save();

        //Vivo Models
          $Models = new Models();
          $Models->brand_id = 8;
          $Models->name = "Smartphones";
          $Models->save();


        //Xiaomi Models
          $Models = new Models();
          $Models->brand_id = 9;
          $Models->name = "Smartphones";
          $Models->save();

        //Xiaomi Models
          $Models = new Models();
          $Models->brand_id = 9;
          $Models->name = "Laptops";
          $Models->save();

    }
}
