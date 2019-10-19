<?php

namespace Modules\Goods\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\Brand;

class BrandsSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //CATEGORIES BRAND
        $brand = new Brand();
        $brand->name = "Apple";
        $brand->save();

        $brand = new Brand();
        $brand->name = "Samsung";
        $brand->save();

        $brand = new Brand();
        $brand->name = "Huawei";
        $brand->save();

        $brand = new Brand();
        $brand->name = "LG";
        $brand->save();

        $brand = new Brand();
        $brand->name = "Sony";
        $brand->save();

        $brand = new Brand();
        $brand->name = "Google";
        $brand->save();

        $brand = new Brand();
        $brand->name = "Oppo";
        $brand->save();

        $brand = new Brand();
        $brand->name = "Vivo";
        $brand->save();

        $brand = new Brand();
        $brand->name = "Xiaomi";
        $brand->save();

    }
}
