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
        $brand->logo = "https://image.flaticon.com/icons/png/128/37/37150.png";
        $brand->created_at = "2019-12-23 14:37:46";
        $brand->is_custom = 0;
        $brand->save();

        $brand = new Brand();
        $brand->name = "Samsung";
        $brand->logo = "http://assets.stickpng.com/thumbs/580b57fcd9996e24bc43c533.png";
        $brand->created_at = "2019-12-22 14:37:46";
        $brand->is_custom = 0;
        $brand->save();

        $brand = new Brand();
        $brand->name = "Huawei";
        $brand->logo = "https://www.freepnglogos.com/uploads/huawei-logo-png/huawei-logo-icon-11.png";
        $brand->created_at = "2019-12-21 14:37:46";
        $brand->is_custom = 0;
        $brand->save();

        $brand = new Brand();
        $brand->name = "LG";
        $brand->logo = "http://www.myiconfinder.com/uploads/iconsets/256-256-d14c8c035b3c8f8d7c74085ce761c24e-lg.png";
        $brand->created_at = "2019-12-20 14:37:46";
        $brand->is_custom = 0;
        $brand->save();

        $brand = new Brand();
        $brand->name = "Sony";
        $brand->logo =  "https://etree.de/wp-content/uploads/2018/09/sony-logo-etree.jpg";
        $brand->created_at = "2019-12-19 14:37:46";
        $brand->is_custom = 0;
        $brand->save();

        $brand = new Brand();
        $brand->name = "OnePlus";
        $brand->logo =  "https://cdn.iconscout.com/icon/free/png-256/oneplus-282590.png";
        $brand->created_at = "2019-12-18 14:37:46";
        $brand->is_custom = 0;
        $brand->save();

        $brand = new Brand();
        $brand->name = "Oppo";
        $brand->logo = "https://hashmart.co.ke/media/brand/o/p/oppo.png";
        $brand->created_at = "2019-12-17 14:37:46";
        $brand->is_custom = 0;
        $brand->save();

        $brand = new Brand();
        $brand->name = "Vivo";
        $brand->logo = "https://cdn.iconscout.com/icon/free/png-256/vivo-1-285323.png";
        $brand->created_at = "2019-12-16 14:37:46";
        $brand->is_custom = 0;
        $brand->save();

        $brand = new Brand();
        $brand->name = "Xiaomi";
        $brand->logo = "https://cdn.iconscout.com/icon/free/png-256/xiaomi-2-722656.png";
        $brand->created_at = "2019-12-15 14:37:46";
        $brand->is_custom = 0;
        $brand->save();

    }
}
