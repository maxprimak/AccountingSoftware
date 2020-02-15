<?php

namespace Modules\Goods\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\Good;
use Modules\Goods\Entities\GoodHasPrices;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Part;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Submodel;
use Modules\Goods\Entities\CompanyHasSubmodel;
use Modules\Goods\Entities\CompanyHasModel;
use Modules\Goods\Entities\CompanyHasBrands;
use Modules\Goods\Entities\CompanyHasPart;
use Modules\Goods\Entities\PartsTranslation;
use Modules\Warehouses\Entities\WarehouseHasGood;
use Modules\Warehouses\Entities\Warehouse;

class OldGoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $submodels = (array) json_decode($this->getSubmodelsInJson());
        $models = (array) json_decode($this->getModelsInJson());
        $brands = (array) json_decode($this->getBrandsInJson());
        $parts = (array) json_decode($this->getPartsInJson());

        foreach($brands as $eachBrand){
            $eachBrand = (array) $eachBrand;
           
            if(!Brand::where('id', $eachBrand['id'])->exists()){
                $brand = new Brand();
                $brand->id = $eachBrand['id'];
                $brand->name = $eachBrand['name'];
                $brand->logo = $eachBrand['logo'];
                $brand->is_custom = 1;
                $brand->created_at = $eachBrand['created_at'];
                $brand->updated_at = $eachBrand['updated_at'];
                $brand->save();

                $has_brand = new CompanyHasBrands();
                $has_brand->brand_id = $brand->id;
                $has_brand->company_id = 1;
                $has_brand->save();
            }
        }
        foreach($models as $eachModel){
            $eachModel = (array) $eachModel;
            
            if(!Models::where('id', $eachModel['id'])->exists()){
                $model = new Models();
                $model->id = $eachModel['id'];
                $model->brand_id = $eachModel['brand_id'];
                $model->name = $eachModel['name'];
                $model->logo = $eachModel['logo'];
                $model->is_custom = 1;
                $model->save();

                $has_model = new CompanyHasModels();
                $has_model->model_id = $model->id;
                $has_model->company_id = 1;
                $has_model->save();
            }
        }
        foreach($submodels as $eachSubmodel){
            $eachSubmodel = (array) $eachSubmodel;
            
            if(!Submodel::where('id', $eachSubmodel['id'])->exists()){
                $submodel = new Submodel();
                $submodel->id = $eachSubmodel['id'];
                $submodel->model_id = $eachSubmodel['model_id'];
                $submodel->name = $eachSubmodel['name'];
                $submodel->is_custom = 1;
                $submodel->save();

                $has_submodel = new CompanyHasSubmodel();
                $has_submodel->submodel_id = $submodel->id;
                $has_submodel->company_id = 1;
                $submodel->save();
            };
        }
        foreach($parts as $eachPart){

            $eachPart = (array) $eachPart;

            if(!Part::where('id', $eachPart['id'])->exists()){

                $part = new Part();
                $part->id = $eachPart['id'];
                $part->is_custom = 1;
                $part->save();

                $has_translation = new PartsTranslation();
                $has_translation->name = $eachPart['name'];
                $has_translation->part_id = $part->id;
                $has_translation->language_id = 1;
                $has_translation->save();

                $has_part = new CompanyHasPart();
                $has_part->part_id = $part->id;
                $has_part->company_id = 1;
                $has_part->save();

            }

        }


        $goods = (array) json_decode($this->getGoodsInJson());

        foreach($goods as $eachGood){
            $eachGood = (array) $eachGood;

            $good = new Good();
            $good->id = $eachGood['id'];
            $good->brand_id = $eachGood['brand_id'];
            $good->model_id = $eachGood['model_id'];
            $good->submodel_id = $eachGood['submodel_id'];
            $good->part_id = $eachGood['part_id'];
            $good->color_id = $eachGood['color_id'];
            $good->created_at = $eachGood['created_at'];
            $good->updated_at = $eachGood['updated_at'];
            $good->save();

            $has_prices = new GoodHasPrices();
            $has_prices->good_id = $good->id;
            $has_prices->retail_price = null;
            $has_prices->wholesale_price = null;
            $has_prices->branch_id = $eachGood['branch_id'];
            $has_prices->save();

            $has_goods = new WarehouseHasGood();
            $has_goods->good_id = $good->id;
            $has_goods->warehouse_id = Warehouse::where('branch_id', $eachGood['branch_id'])->first()->id;
            $has_goods->amount = $eachGood['amount'];
            $has_goods->save();

        }
    }

    public function getPartsInJson(){
        $result = '[
            {
              "id": 1,
              "name": "Display",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 2,
              "name": "Battery",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 3,
              "name": "Side Buttons",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 4,
              "name": "Vibration motor",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 5,
              "name": "Home-button",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 6,
              "name": "Front-camera",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 7,
              "name": "Main-camera",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 8,
              "name": "3D Folie",
              "created_at": "2019-11-08 08:17:37",
              "updated_at": "2019-11-08 08:17:37"
            },
            {
              "id": 9,
              "name": "XR/11",
              "created_at": "2019-11-08 08:19:13",
              "updated_at": "2019-11-08 08:19:13"
            },
            {
              "id": 10,
              "name": "Glasfolie",
              "created_at": "2019-11-08 08:32:29",
              "updated_at": "2019-11-08 08:32:29"
            },
            {
              "id": 11,
              "name": "UHD Display",
              "created_at": "2019-12-05 13:52:58",
              "updated_at": "2019-12-05 13:52:58"
            }
          ]';

        return $result;
    }

    public function getBrandsInJson(){
        $result = '[
            {
              "id": 1,
              "name": "Apple",
              "logo": "https://image.flaticon.com/icons/png/128/37/37150.png",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 2,
              "name": "Samsung",
              "logo": "http://assets.stickpng.com/thumbs/580b57fcd9996e24bc43c533.png",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 3,
              "name": "Huawei",
              "logo": "https://www.freepnglogos.com/uploads/huawei-logo-png/huawei-logo-icon-11.png",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 4,
              "name": "LG",
              "logo": "http://www.myiconfinder.com/uploads/iconsets/256-256-d14c8c035b3c8f8d7c74085ce761c24e-lg.png",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 5,
              "name": "Sony",
              "logo": "https://etree.de/wp-content/uploads/2018/09/sony-logo-etree.jpg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 6,
              "name": "OnePlus",
              "logo": "https://cdn.iconscout.com/icon/free/png-256/oneplus-282590.png",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 7,
              "name": "Oppo",
              "logo": "https://hashmart.co.ke/media/brand/o/p/oppo.png",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 8,
              "name": "Vivo",
              "logo": "https://cdn.iconscout.com/icon/free/png-256/vivo-1-285323.png",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 9,
              "name": "Xiaomi",
              "logo": "https://cdn.iconscout.com/icon/free/png-256/xiaomi-2-722656.png",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            }
          ]';

        return $result;
    }

    public function getModelsInJson(){
        $result = '[
            {
              "id": 1,
              "brand_id": 1,
              "name": "iPhone",
              "logo": "https://image.flaticon.com/icons/svg/114/114702.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 2,
              "brand_id": 1,
              "name": "iPad",
              "logo": "https://image.flaticon.com/icons/svg/114/114703.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 3,
              "brand_id": 1,
              "name": "Apple Watch",
              "logo": "https://image.flaticon.com/icons/svg/916/916337.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 4,
              "brand_id": 1,
              "name": "MacBook",
              "logo": "https://image.flaticon.com/icons/svg/65/65732.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 5,
              "brand_id": 2,
              "name": "Smartphones",
              "logo": "https://image.flaticon.com/icons/svg/114/114702.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 6,
              "brand_id": 2,
              "name": "Tablets",
              "logo": "https://image.flaticon.com/icons/svg/114/114703.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 7,
              "brand_id": 2,
              "name": "Watches",
              "logo": "https://image.flaticon.com/icons/svg/916/916337.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 8,
              "brand_id": 2,
              "name": "Laptops",
              "logo": "https://image.flaticon.com/icons/svg/65/65732.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 9,
              "brand_id": 3,
              "name": "Smartphones",
              "logo": "https://image.flaticon.com/icons/svg/114/114702.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 10,
              "brand_id": 3,
              "name": "Tablets",
              "logo": "https://image.flaticon.com/icons/svg/114/114703.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 11,
              "brand_id": 3,
              "name": "Watches",
              "logo": "https://image.flaticon.com/icons/svg/916/916337.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 12,
              "brand_id": 3,
              "name": "Laptops",
              "logo": "https://image.flaticon.com/icons/svg/114/114702.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 13,
              "brand_id": 4,
              "name": "Smartphones",
              "logo": "https://image.flaticon.com/icons/svg/114/114702.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 14,
              "brand_id": 4,
              "name": "Tablets",
              "logo": "https://image.flaticon.com/icons/svg/114/114703.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 15,
              "brand_id": 5,
              "name": "Smartphones",
              "logo": "https://image.flaticon.com/icons/svg/114/114702.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 16,
              "brand_id": 6,
              "name": "Smartphones",
              "logo": "https://image.flaticon.com/icons/svg/114/114702.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 17,
              "brand_id": 7,
              "name": "Smartphones",
              "logo": "https://image.flaticon.com/icons/svg/114/114702.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 18,
              "brand_id": 8,
              "name": "Smartphones",
              "logo": "https://image.flaticon.com/icons/svg/114/114702.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 19,
              "brand_id": 9,
              "name": "Smartphones",
              "logo": "https://image.flaticon.com/icons/svg/114/114702.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 20,
              "brand_id": 9,
              "name": "Laptops",
              "logo": "https://image.flaticon.com/icons/svg/65/65732.svg",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            }
          ]';

        return $result;
    }

    public function getSubmodelsInJson(){
        $result = '[
            {
              "id": 1,
              "model_id": 1,
              "name": "5",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 2,
              "model_id": 1,
              "name": "5s",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 3,
              "model_id": 1,
              "name": "6",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 4,
              "model_id": 1,
              "name": "6 Plus",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 5,
              "model_id": 1,
              "name": "6s",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 6,
              "model_id": 1,
              "name": "6s Plus",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 7,
              "model_id": 1,
              "name": "7",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 8,
              "model_id": 1,
              "name": "7 Plus",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 9,
              "model_id": 1,
              "name": "8",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 10,
              "model_id": 1,
              "name": "8 Plus",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 11,
              "model_id": 1,
              "name": "X",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 12,
              "model_id": 1,
              "name": "Xr",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 13,
              "model_id": 1,
              "name": "Xs",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 14,
              "model_id": 1,
              "name": "Xs Max",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 15,
              "model_id": 1,
              "name": "11",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 16,
              "model_id": 1,
              "name": "11 Pro",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 17,
              "model_id": 2,
              "name": "iPad",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 18,
              "model_id": 2,
              "name": "iPad 2",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 19,
              "model_id": 2,
              "name": "iPad 3rd Generation",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 20,
              "model_id": 2,
              "name": "iPad 4rd Generation",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 21,
              "model_id": 2,
              "name": "iPad 5rd Generation",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 22,
              "model_id": 2,
              "name": "iPad 6rd Generation",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 23,
              "model_id": 2,
              "name": "iPad 7rd Generation",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 24,
              "model_id": 2,
              "name": "iPad mini",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 25,
              "model_id": 2,
              "name": "iPad mini 2",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 26,
              "model_id": 2,
              "name": "iPad mini 3",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 27,
              "model_id": 2,
              "name": "iPad mini 4",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 28,
              "model_id": 2,
              "name": "iPad mini 5",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 29,
              "model_id": 2,
              "name": "iPad Air",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 30,
              "model_id": 2,
              "name": "iPad Air 2",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 31,
              "model_id": 2,
              "name": "iPad Air 3",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 32,
              "model_id": 2,
              "name": "iPad Pro 12.9 inch",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 33,
              "model_id": 2,
              "name": "iPad Pro 12.9 inch 2nd Generation",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 34,
              "model_id": 2,
              "name": "iPad Pro 12.9 inch 3rd Generation",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 35,
              "model_id": 3,
              "name": "Apple Watch Series 1",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 36,
              "model_id": 3,
              "name": "Apple Watch Series 2",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 37,
              "model_id": 3,
              "name": "Apple Watch Series 3",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 38,
              "model_id": 3,
              "name": "Apple Watch Series 4",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 39,
              "model_id": 3,
              "name": "Apple Watch Series 5",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 40,
              "model_id": 4,
              "name": "A1181",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 41,
              "model_id": 4,
              "name": "A1278",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 42,
              "model_id": 4,
              "name": "A1342",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 43,
              "model_id": 4,
              "name": "A1534",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 44,
              "model_id": 4,
              "name": "A1237",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 45,
              "model_id": 4,
              "name": "A1304",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 46,
              "model_id": 4,
              "name": "A1370",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 47,
              "model_id": 4,
              "name": "A1369",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 48,
              "model_id": 4,
              "name": "A1465",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 49,
              "model_id": 4,
              "name": "A1466",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 50,
              "model_id": 4,
              "name": "A1932",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 51,
              "model_id": 4,
              "name": "A1150",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 52,
              "model_id": 4,
              "name": "A1151",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 53,
              "model_id": 4,
              "name": "A1211",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 54,
              "model_id": 4,
              "name": "A1212",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 55,
              "model_id": 4,
              "name": "A1226",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 56,
              "model_id": 4,
              "name": "A1229",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 57,
              "model_id": 4,
              "name": "A1260",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 58,
              "model_id": 4,
              "name": "A1261",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 59,
              "model_id": 4,
              "name": "A1286",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 60,
              "model_id": 4,
              "name": "A1297",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 61,
              "model_id": 4,
              "name": "A1398",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 62,
              "model_id": 4,
              "name": "A1425",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 63,
              "model_id": 4,
              "name": "A1502",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 64,
              "model_id": 4,
              "name": "A1708",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 65,
              "model_id": 4,
              "name": "A1706",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 66,
              "model_id": 4,
              "name": "A1707",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 67,
              "model_id": 4,
              "name": "A1989",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 68,
              "model_id": 4,
              "name": "A1990",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 69,
              "model_id": 4,
              "name": "A1212",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 70,
              "model_id": 5,
              "name": "Galaxy S5",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 71,
              "model_id": 5,
              "name": "Galaxy S5 Plus",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 72,
              "model_id": 5,
              "name": "Galaxy S6",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 73,
              "model_id": 5,
              "name": "Galaxy S6 Edge",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 74,
              "model_id": 5,
              "name": "Galaxy S6 Edge+",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 75,
              "model_id": 5,
              "name": "Galaxy S7",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 76,
              "model_id": 5,
              "name": "Galaxy S7 Edge",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 77,
              "model_id": 5,
              "name": "Galaxy S7 Edge+",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 78,
              "model_id": 5,
              "name": "Galaxy S8",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 79,
              "model_id": 5,
              "name": "Galaxy S8+",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 80,
              "model_id": 5,
              "name": "Galaxy S9",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 81,
              "model_id": 5,
              "name": "Galaxy S9+",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 82,
              "model_id": 5,
              "name": "Galaxy S10",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 83,
              "model_id": 5,
              "name": "Galaxy S10+",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 84,
              "model_id": 5,
              "name": "Galaxy S10e",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 85,
              "model_id": 5,
              "name": "Galaxy S10+",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 86,
              "model_id": 5,
              "name": "Galaxy Note 4",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 87,
              "model_id": 5,
              "name": "Galaxy Note 5",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 88,
              "model_id": 5,
              "name": "Galaxy Note 6",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 89,
              "model_id": 5,
              "name": "Galaxy Note 7",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 90,
              "model_id": 5,
              "name": "Galaxy Note 8",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 91,
              "model_id": 5,
              "name": "Galaxy Note 9",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 92,
              "model_id": 5,
              "name": "Galaxy Note 10",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 93,
              "model_id": 5,
              "name": "Galaxy Note 10+",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 94,
              "model_id": 5,
              "name": "Galaxy A3",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 95,
              "model_id": 5,
              "name": "Galaxy  A3 (2018)",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 96,
              "model_id": 5,
              "name": "Galaxy A5",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 97,
              "model_id": 5,
              "name": "Galaxy  A5 (2016)",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 98,
              "model_id": 5,
              "name": "Galaxy  A5 (2017)",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 99,
              "model_id": 5,
              "name": "Galaxy  A5 (2018)",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 100,
              "model_id": 5,
              "name": "Galaxy A6",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 101,
              "model_id": 5,
              "name": "Galaxy  A6 (2016)",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 102,
              "model_id": 5,
              "name": "Galaxy  A6 (2017)",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 103,
              "model_id": 5,
              "name": "Galaxy  A6 (2018)",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 104,
              "model_id": 5,
              "name": "Galaxy A7",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 105,
              "model_id": 5,
              "name": "Galaxy  A7 (2016)",
              "created_at": "2019-10-29 10:57:49",
              "updated_at": "2019-10-29 10:57:49"
            },
            {
              "id": 106,
              "model_id": 5,
              "name": "Galaxy  A7 (2017)",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 107,
              "model_id": 5,
              "name": "Galaxy  A7 (2018)",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 108,
              "model_id": 5,
              "name": "Galaxy A8",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 109,
              "model_id": 5,
              "name": "Galaxy  A8 (2016)",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 110,
              "model_id": 5,
              "name": "Galaxy  A8 (2017)",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 111,
              "model_id": 5,
              "name": "Galaxy A9",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 112,
              "model_id": 5,
              "name": "Galaxy  A9 (2016)",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 113,
              "model_id": 5,
              "name": "Galaxy  A9 (2017)",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 114,
              "model_id": 5,
              "name": "Galaxy  A10",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 115,
              "model_id": 5,
              "name": "Galaxy  A10e",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 116,
              "model_id": 5,
              "name": "Galaxy  A10s",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 117,
              "model_id": 5,
              "name": "Galaxy  A20",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 118,
              "model_id": 5,
              "name": "Galaxy  A20e",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 119,
              "model_id": 5,
              "name": "Galaxy  A20s",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 120,
              "model_id": 5,
              "name": "Galaxy  A30",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 121,
              "model_id": 5,
              "name": "Galaxy  A30s",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 122,
              "model_id": 5,
              "name": "Galaxy  A40",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 123,
              "model_id": 5,
              "name": "Galaxy  A40s",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 124,
              "model_id": 5,
              "name": "Galaxy  A50",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 125,
              "model_id": 5,
              "name": "Galaxy  A50s",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 126,
              "model_id": 5,
              "name": "Galaxy  A60",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 127,
              "model_id": 5,
              "name": "Galaxy  A60s",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 128,
              "model_id": 5,
              "name": "Galaxy  A70",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 129,
              "model_id": 5,
              "name": "Galaxy  A70s",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 130,
              "model_id": 5,
              "name": "Galaxy  A80",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 131,
              "model_id": 5,
              "name": "Galaxy J 330",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 132,
              "model_id": 5,
              "name": "Galaxy J 530",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 133,
              "model_id": 5,
              "name": "Galaxy M10",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 134,
              "model_id": 5,
              "name": "Galaxy M10s",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 135,
              "model_id": 5,
              "name": "Galaxy M20",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 136,
              "model_id": 5,
              "name": "Galaxy M30",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 137,
              "model_id": 5,
              "name": "Galaxy M30s",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 138,
              "model_id": 5,
              "name": "Galaxy M40",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 139,
              "model_id": 9,
              "name": "Mate 8",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 140,
              "model_id": 9,
              "name": "Mate 9",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 141,
              "model_id": 9,
              "name": "Mate 9 Lite",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 142,
              "model_id": 9,
              "name": "Mate 9 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 143,
              "model_id": 9,
              "name": "Mate 9 Porsche",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 144,
              "model_id": 9,
              "name": "Mate 10",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 145,
              "model_id": 9,
              "name": "Mate 10 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 146,
              "model_id": 9,
              "name": "Mate 10 Porsche",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 147,
              "model_id": 9,
              "name": "Mate 20",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 148,
              "model_id": 9,
              "name": "Mate 20 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 149,
              "model_id": 9,
              "name": "Mate 20 Porsche",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 150,
              "model_id": 9,
              "name": "Mate 30",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 151,
              "model_id": 9,
              "name": "Mate 30 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 152,
              "model_id": 9,
              "name": "Mate 30 Porsche",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 153,
              "model_id": 9,
              "name": "P Smart",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 154,
              "model_id": 9,
              "name": "P Smart +",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 155,
              "model_id": 9,
              "name": "P Smart Z",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 156,
              "model_id": 9,
              "name": "P8",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 157,
              "model_id": 9,
              "name": "P8 Lite",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 158,
              "model_id": 9,
              "name": "P8 Max",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 159,
              "model_id": 9,
              "name": "P9",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 160,
              "model_id": 9,
              "name": "P9 Lite",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 161,
              "model_id": 9,
              "name": "P9 Max",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 162,
              "model_id": 9,
              "name": "P9 Plus",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 163,
              "model_id": 9,
              "name": "P9 Lite Mini",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 164,
              "model_id": 9,
              "name": "P10",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 165,
              "model_id": 9,
              "name": "P10 Lite",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 166,
              "model_id": 9,
              "name": "P10 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 167,
              "model_id": 9,
              "name": "P20",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 168,
              "model_id": 9,
              "name": "P20 Lite",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 169,
              "model_id": 9,
              "name": "P20 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 170,
              "model_id": 9,
              "name": "P30",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 171,
              "model_id": 9,
              "name": "P30 Lite",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 172,
              "model_id": 9,
              "name": "P30 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 173,
              "model_id": 9,
              "name": "Nova 2",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 174,
              "model_id": 9,
              "name": "Nova 2 Plus",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 175,
              "model_id": 9,
              "name": "Nova 2s",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 176,
              "model_id": 9,
              "name": "Nova 3",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 177,
              "model_id": 9,
              "name": "Nova 4",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 178,
              "model_id": 9,
              "name": "Nova 5",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 179,
              "model_id": 15,
              "name": "Xperia 5",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 180,
              "model_id": 15,
              "name": "Xperia 1",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 181,
              "model_id": 15,
              "name": "Xperia 10",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 182,
              "model_id": 15,
              "name": "Xperia 10 Plus",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 183,
              "model_id": 15,
              "name": "Xperia L3",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 184,
              "model_id": 15,
              "name": "Xperia XZ3",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 185,
              "model_id": 15,
              "name": "Xperia XZ2",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 186,
              "model_id": 15,
              "name": "Xperia XZ2 Compact",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 187,
              "model_id": 15,
              "name": "Xperia XZ1",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 188,
              "model_id": 15,
              "name": "Xperia XZ1 Compact",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 189,
              "model_id": 15,
              "name": "Xperia XZ Premium",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 190,
              "model_id": 15,
              "name": "Xperia Z1",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 191,
              "model_id": 15,
              "name": "Xperia Z1 Compact",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 192,
              "model_id": 15,
              "name": "Xperia Z Ultra",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 193,
              "model_id": 15,
              "name": "Xperia Z2",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 194,
              "model_id": 15,
              "name": "Xperia Z3",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 195,
              "model_id": 15,
              "name": "Xperia Z5",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 196,
              "model_id": 15,
              "name": "Xperia Z5 Compact",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 197,
              "model_id": 15,
              "name": "Xperia Z5 Premium",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 198,
              "model_id": 15,
              "name": "Xperia M4 Aqua",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 199,
              "model_id": 15,
              "name": "Xperia M5 Aqua",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 200,
              "model_id": 15,
              "name": "Xperia L1",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 201,
              "model_id": 16,
              "name": "3",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 202,
              "model_id": 16,
              "name": "5",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 203,
              "model_id": 16,
              "name": "6",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 204,
              "model_id": 16,
              "name": "7",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 205,
              "model_id": 16,
              "name": "7 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 206,
              "model_id": 16,
              "name": "3T",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 207,
              "model_id": 16,
              "name": "5T",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 208,
              "model_id": 16,
              "name": "6T",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 209,
              "model_id": 16,
              "name": "6T McLaren",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 210,
              "model_id": 16,
              "name": "7T",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 211,
              "model_id": 16,
              "name": "7T Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 212,
              "model_id": 16,
              "name": "7T McLaren",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 213,
              "model_id": 17,
              "name": "A9",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 214,
              "model_id": 17,
              "name": "A9 2020",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 215,
              "model_id": 17,
              "name": "A5 2020",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 216,
              "model_id": 17,
              "name": "K3",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 217,
              "model_id": 17,
              "name": "Reno2",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 218,
              "model_id": 17,
              "name": "Reno2 F",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 219,
              "model_id": 17,
              "name": "Reno2 Z",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 220,
              "model_id": 17,
              "name": "Reno Z",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 221,
              "model_id": 17,
              "name": "Reno 10x Zoom",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 222,
              "model_id": 17,
              "name": "F11",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 223,
              "model_id": 17,
              "name": "F11 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 224,
              "model_id": 18,
              "name": "V17 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 225,
              "model_id": 18,
              "name": "V15 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 226,
              "model_id": 18,
              "name": "V15",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 227,
              "model_id": 18,
              "name": "V11",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 228,
              "model_id": 18,
              "name": "V11i",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 229,
              "model_id": 18,
              "name": "V9 Youth",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 230,
              "model_id": 18,
              "name": "V9",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 231,
              "model_id": 18,
              "name": "V7",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 232,
              "model_id": 18,
              "name": "V7+",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 233,
              "model_id": 18,
              "name": "Y95",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 234,
              "model_id": 18,
              "name": "Y91C",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 235,
              "model_id": 18,
              "name": "Y93",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 236,
              "model_id": 18,
              "name": "Y17",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 237,
              "model_id": 18,
              "name": "Y85",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 238,
              "model_id": 18,
              "name": "Y81i",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 239,
              "model_id": 18,
              "name": "Y83",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 240,
              "model_id": 18,
              "name": "Y71",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 241,
              "model_id": 18,
              "name": "X21",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 242,
              "model_id": 18,
              "name": "NEX",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 243,
              "model_id": 18,
              "name": "NEX Dual Display",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 244,
              "model_id": 18,
              "name": "S1",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 245,
              "model_id": 19,
              "name": "Redmi 8",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 246,
              "model_id": 19,
              "name": "Redmi 8A",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 247,
              "model_id": 19,
              "name": "Redmi Note 8",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 248,
              "model_id": 19,
              "name": "Redmi Note 8 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 249,
              "model_id": 19,
              "name": "Redmi 7A",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 250,
              "model_id": 19,
              "name": "Redmi 7",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 251,
              "model_id": 19,
              "name": "Redmi Note 7",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 252,
              "model_id": 19,
              "name": "Redmi 6",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 253,
              "model_id": 19,
              "name": "Redmi 6A",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 254,
              "model_id": 19,
              "name": "Redmi Note 6 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 255,
              "model_id": 19,
              "name": "Redmi S2",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 256,
              "model_id": 19,
              "name": "POCOPHONE F1",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 257,
              "model_id": 19,
              "name": "Mi Mix Alpha",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 258,
              "model_id": 19,
              "name": "Mi Mix 3",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 259,
              "model_id": 19,
              "name": "Mi Mix 2S",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 260,
              "model_id": 19,
              "name": "Mi 9 Lite",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 261,
              "model_id": 19,
              "name": "Mi 9T",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 262,
              "model_id": 19,
              "name": "Mi 9T Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 263,
              "model_id": 19,
              "name": "Mi 9 SE",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 264,
              "model_id": 19,
              "name": "Mi 9",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 265,
              "model_id": 19,
              "name": "Mi 8",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 266,
              "model_id": 19,
              "name": "Mi 8 Pro",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 267,
              "model_id": 19,
              "name": "Mi 8 Lite",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 268,
              "model_id": 19,
              "name": "Mi Max 3",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 269,
              "model_id": 19,
              "name": "Mi A3",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 270,
              "model_id": 19,
              "name": "Mi A2",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 271,
              "model_id": 19,
              "name": "Mi A2 Lite",
              "created_at": "2019-10-29 10:57:50",
              "updated_at": "2019-10-29 10:57:50"
            },
            {
              "id": 272,
              "model_id": 1,
              "name": "7 Orig",
              "created_at": "2019-10-29 13:54:15",
              "updated_at": "2019-10-29 13:54:15"
            },
            {
              "id": 273,
              "model_id": 1,
              "name": "8 Orig.",
              "created_at": "2019-10-29 13:55:44",
              "updated_at": "2019-10-29 13:55:44"
            },
            {
              "id": 274,
              "model_id": 1,
              "name": "8 Plus Orig.",
              "created_at": "2019-10-29 13:58:53",
              "updated_at": "2019-10-29 13:58:53"
            },
            {
              "id": 275,
              "model_id": 1,
              "name": "7 Plus Orig.",
              "created_at": "2019-10-29 17:00:33",
              "updated_at": "2019-10-29 17:00:33"
            },
            {
              "id": 276,
              "model_id": 1,
              "name": "Xs Orig.",
              "created_at": "2019-10-29 17:06:27",
              "updated_at": "2019-10-29 17:06:27"
            },
            {
              "id": 277,
              "model_id": 1,
              "name": "4/4s",
              "created_at": "2019-10-29 17:08:11",
              "updated_at": "2019-10-29 17:08:11"
            },
            {
              "id": 278,
              "model_id": 1,
              "name": "IPhone XS Max / 11 Pro Max 3D Glasfolie",
              "created_at": "2019-11-08 08:17:19",
              "updated_at": "2019-11-08 08:17:19"
            },
            {
              "id": 279,
              "model_id": 1,
              "name": "IPhone XR / IPhone 11 3D Glasfolie",
              "created_at": "2019-11-08 08:18:49",
              "updated_at": "2019-11-08 08:18:49"
            },
            {
              "id": 280,
              "model_id": 1,
              "name": "IPhone X / IPhone 11 Pro",
              "created_at": "2019-11-08 08:21:00",
              "updated_at": "2019-11-08 08:21:00"
            },
            {
              "id": 281,
              "model_id": 1,
              "name": "IPhone 8 Plus 3D Glasfolie",
              "created_at": "2019-11-08 08:23:28",
              "updated_at": "2019-11-08 08:23:28"
            },
            {
              "id": 282,
              "model_id": 1,
              "name": "IPhone 7/8 Plus 3D Glasfolie",
              "created_at": "2019-11-08 08:26:20",
              "updated_at": "2019-11-08 08:26:20"
            },
            {
              "id": 283,
              "model_id": 1,
              "name": "IPhone 7/8 3D Glasfolie",
              "created_at": "2019-11-08 08:27:35",
              "updated_at": "2019-11-08 08:27:35"
            },
            {
              "id": 284,
              "model_id": 1,
              "name": "IPhone 6/6s 3D Glasfolie",
              "created_at": "2019-11-08 08:29:30",
              "updated_at": "2019-11-08 08:29:30"
            },
            {
              "id": 285,
              "model_id": 1,
              "name": "IPhone 6/6s Plus 3D Glasfolie",
              "created_at": "2019-11-08 08:31:11",
              "updated_at": "2019-11-08 08:31:11"
            },
            {
              "id": 286,
              "model_id": 1,
              "name": "IPhone 5/5s Glasfolie",
              "created_at": "2019-11-08 08:32:15",
              "updated_at": "2019-11-08 08:32:15"
            },
            {
              "id": 287,
              "model_id": 5,
              "name": "Galaxy S10 Plus 3D Glasfolie",
              "created_at": "2019-11-08 08:36:26",
              "updated_at": "2019-11-08 08:36:26"
            },
            {
              "id": 288,
              "model_id": 1,
              "name": "X Orig.",
              "created_at": "2019-11-08 08:47:24",
              "updated_at": "2019-11-08 08:47:24"
            },
            {
              "id": 289,
              "model_id": 1,
              "name": "5C",
              "created_at": "2019-11-08 08:48:15",
              "updated_at": "2019-11-08 08:48:15"
            },
            {
              "id": 290,
              "model_id": 1,
              "name": "SE",
              "created_at": "2019-11-08 08:53:57",
              "updated_at": "2019-11-08 08:53:57"
            },
            {
              "id": 291,
              "model_id": 1,
              "name": "2G",
              "created_at": "2019-12-07 15:14:42",
              "updated_at": "2019-12-07 15:14:42"
            }
          ]';

        return $result;
    }

    public function getGoodsInJson(){
        $result = '[
            {
              "id": 1,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 5,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 13:51:35",
              "updated_at": "2019-10-29 13:51:35"
            },
            {
              "id": 2,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 5,
              "part_id": 1,
              "color_id": 3,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 13:52:03",
              "updated_at": "2019-10-29 13:52:03"
            },
            {
              "id": 3,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 3,
              "part_id": 1,
              "color_id": 3,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-10-29 13:52:39",
              "updated_at": "2019-10-29 14:18:38"
            },
            {
              "id": 4,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 3,
              "part_id": 1,
              "color_id": 2,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-10-29 13:53:03",
              "updated_at": "2019-10-29 13:53:03"
            },
            {
              "id": 6,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 272,
              "part_id": 1,
              "color_id": 2,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-10-29 13:54:20",
              "updated_at": "2019-10-29 13:54:20"
            },
            {
              "id": 7,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 272,
              "part_id": 1,
              "color_id": 3,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-10-29 13:54:49",
              "updated_at": "2019-10-29 13:54:49"
            },
            {
              "id": 8,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 273,
              "part_id": 1,
              "color_id": 2,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-10-29 13:55:56",
              "updated_at": "2019-10-29 13:55:56"
            },
            {
              "id": 9,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 273,
              "part_id": 1,
              "color_id": 3,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-10-29 13:56:22",
              "updated_at": "2019-10-29 13:56:22"
            },
            {
              "id": 10,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 7,
              "part_id": 1,
              "color_id": 3,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-10-29 13:57:22",
              "updated_at": "2019-10-29 13:57:22"
            },
            {
              "id": 11,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 7,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 13:57:59",
              "updated_at": "2019-10-29 13:57:59"
            },
            {
              "id": 12,
              "branch_id": 3,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 274,
              "part_id": 1,
              "color_id": 3,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-10-29 13:59:00",
              "updated_at": "2019-10-29 13:59:00"
            },
            {
              "id": 13,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 1,
              "part_id": 1,
              "color_id": 2,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-10-29 16:50:08",
              "updated_at": "2019-10-29 16:50:08"
            },
            {
              "id": 14,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 1,
              "part_id": 1,
              "color_id": 3,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-10-29 16:50:37",
              "updated_at": "2020-01-17 22:04:36"
            },
            {
              "id": 15,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 2,
              "part_id": 1,
              "color_id": 2,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-10-29 16:50:57",
              "updated_at": "2019-10-29 16:50:57"
            },
            {
              "id": 16,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 2,
              "part_id": 1,
              "color_id": 3,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 16:51:15",
              "updated_at": "2019-10-29 16:51:15"
            },
            {
              "id": 17,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 3,
              "part_id": 1,
              "color_id": 2,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-10-29 16:51:34",
              "updated_at": "2019-10-31 14:15:32"
            },
            {
              "id": 18,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 3,
              "part_id": 1,
              "color_id": 3,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-10-29 16:51:52",
              "updated_at": "2019-10-29 16:51:52"
            },
            {
              "id": 19,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 5,
              "part_id": 1,
              "color_id": 2,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-10-29 16:52:39",
              "updated_at": "2019-10-31 14:16:00"
            },
            {
              "id": 20,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 5,
              "part_id": 1,
              "color_id": 3,
              "amount": 7,
              "price": 0.00,
              "created_at": "2019-10-29 16:53:02",
              "updated_at": "2019-10-29 16:53:02"
            },
            {
              "id": 21,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 4,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 16:53:22",
              "updated_at": "2019-10-29 16:53:22"
            },
            {
              "id": 22,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 4,
              "part_id": 1,
              "color_id": 3,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-10-29 16:53:39",
              "updated_at": "2019-10-29 16:53:39"
            },
            {
              "id": 23,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 6,
              "part_id": 1,
              "color_id": 2,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-10-29 16:53:59",
              "updated_at": "2019-10-29 16:53:59"
            },
            {
              "id": 24,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 6,
              "part_id": 1,
              "color_id": 3,
              "amount": 10,
              "price": 0.00,
              "created_at": "2019-10-29 16:54:17",
              "updated_at": "2019-10-29 16:54:19"
            },
            {
              "id": 25,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 7,
              "part_id": 1,
              "color_id": 2,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-10-29 16:54:44",
              "updated_at": "2019-10-29 16:54:44"
            },
            {
              "id": 26,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 7,
              "part_id": 1,
              "color_id": 3,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-10-29 16:55:16",
              "updated_at": "2019-10-29 16:55:16"
            },
            {
              "id": 27,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 8,
              "part_id": 1,
              "color_id": 2,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-10-29 16:55:34",
              "updated_at": "2019-10-29 16:55:34"
            },
            {
              "id": 28,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 8,
              "part_id": 1,
              "color_id": 3,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 16:55:51",
              "updated_at": "2019-10-29 16:55:51"
            },
            {
              "id": 29,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 9,
              "part_id": 1,
              "color_id": 2,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-10-29 16:56:14",
              "updated_at": "2019-10-29 16:56:14"
            },
            {
              "id": 30,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 9,
              "part_id": 1,
              "color_id": 3,
              "amount": 7,
              "price": 0.00,
              "created_at": "2019-10-29 16:56:33",
              "updated_at": "2019-10-29 16:56:33"
            },
            {
              "id": 31,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 10,
              "part_id": 1,
              "color_id": 2,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-10-29 16:56:55",
              "updated_at": "2019-10-29 16:56:55"
            },
            {
              "id": 32,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 10,
              "part_id": 1,
              "color_id": 3,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 16:57:11",
              "updated_at": "2019-10-29 16:57:11"
            },
            {
              "id": 33,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 11,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 16:57:34",
              "updated_at": "2019-11-11 14:30:01"
            },
            {
              "id": 34,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 272,
              "part_id": 1,
              "color_id": 2,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-10-29 16:58:33",
              "updated_at": "2019-10-29 16:58:33"
            },
            {
              "id": 35,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 272,
              "part_id": 1,
              "color_id": 3,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-10-29 16:58:58",
              "updated_at": "2019-10-29 16:58:58"
            },
            {
              "id": 36,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 275,
              "part_id": 1,
              "color_id": 2,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-10-29 17:00:47",
              "updated_at": "2019-10-29 17:00:47"
            },
            {
              "id": 37,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 275,
              "part_id": 1,
              "color_id": 3,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 17:01:14",
              "updated_at": "2019-10-29 17:01:14"
            },
            {
              "id": 38,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 273,
              "part_id": 1,
              "color_id": 2,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-10-29 17:02:39",
              "updated_at": "2019-10-29 17:02:39"
            },
            {
              "id": 39,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 273,
              "part_id": 1,
              "color_id": 3,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 17:03:11",
              "updated_at": "2019-10-29 17:03:11"
            },
            {
              "id": 40,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 274,
              "part_id": 1,
              "color_id": 2,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-10-29 17:03:40",
              "updated_at": "2019-10-29 17:03:40"
            },
            {
              "id": 41,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 274,
              "part_id": 1,
              "color_id": 3,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-10-29 17:04:01",
              "updated_at": "2019-10-29 17:04:01"
            },
            {
              "id": 42,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 13,
              "part_id": 1,
              "color_id": 2,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-10-29 17:05:58",
              "updated_at": "2019-10-29 17:05:58"
            },
            {
              "id": 43,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 276,
              "part_id": 1,
              "color_id": 2,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-10-29 17:06:36",
              "updated_at": "2019-10-29 17:06:36"
            },
            {
              "id": 44,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 277,
              "part_id": 2,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 17:08:27",
              "updated_at": "2019-10-29 17:08:27"
            },
            {
              "id": 45,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 1,
              "part_id": 2,
              "color_id": 2,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-10-29 17:09:49",
              "updated_at": "2019-10-29 17:09:49"
            },
            {
              "id": 46,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 2,
              "part_id": 2,
              "color_id": 2,
              "amount": 7,
              "price": 0.00,
              "created_at": "2019-10-29 17:10:21",
              "updated_at": "2019-10-29 17:10:21"
            },
            {
              "id": 47,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 3,
              "part_id": 2,
              "color_id": 2,
              "amount": 8,
              "price": 0.00,
              "created_at": "2019-10-29 17:11:05",
              "updated_at": "2019-10-29 17:11:05"
            },
            {
              "id": 48,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 5,
              "part_id": 2,
              "color_id": 2,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-10-29 17:20:37",
              "updated_at": "2019-10-29 17:20:37"
            },
            {
              "id": 49,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 4,
              "part_id": 2,
              "color_id": 2,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-10-29 17:21:01",
              "updated_at": "2019-10-29 17:21:01"
            },
            {
              "id": 50,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 6,
              "part_id": 2,
              "color_id": 2,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-10-29 17:21:21",
              "updated_at": "2019-10-29 17:21:21"
            },
            {
              "id": 51,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 7,
              "part_id": 2,
              "color_id": 2,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-10-29 17:21:42",
              "updated_at": "2019-10-29 17:21:42"
            },
            {
              "id": 52,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 8,
              "part_id": 2,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 17:22:08",
              "updated_at": "2019-10-29 17:22:08"
            },
            {
              "id": 53,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 9,
              "part_id": 2,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 17:22:27",
              "updated_at": "2019-10-29 17:22:27"
            },
            {
              "id": 54,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 10,
              "part_id": 2,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-10-29 17:22:45",
              "updated_at": "2019-10-29 17:22:45"
            },
            {
              "id": 55,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 11,
              "part_id": 2,
              "color_id": 2,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-10-29 17:23:03",
              "updated_at": "2019-10-29 17:23:03"
            },
            {
              "id": 56,
              "branch_id": 1,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 13,
              "part_id": 2,
              "color_id": 2,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-10-29 17:23:19",
              "updated_at": "2019-10-29 17:23:19"
            },
            {
              "id": 61,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 1,
              "part_id": 1,
              "color_id": 2,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-11-08 08:08:45",
              "updated_at": "2019-11-08 08:08:45"
            },
            {
              "id": 62,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 1,
              "part_id": 1,
              "color_id": 3,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-11-08 08:09:05",
              "updated_at": "2019-11-08 08:09:05"
            },
            {
              "id": 63,
              "branch_id": 2,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 278,
              "part_id": 8,
              "color_id": 2,
              "amount": 8,
              "price": 0.00,
              "created_at": "2019-11-08 08:17:57",
              "updated_at": "2019-11-08 08:17:57"
            },
            {
              "id": 65,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 2,
              "part_id": 1,
              "color_id": 2,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-11-08 08:20:50",
              "updated_at": "2019-11-08 08:20:50"
            },
            {
              "id": 67,
              "branch_id": 2,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 279,
              "part_id": 8,
              "color_id": 2,
              "amount": 15,
              "price": 0.00,
              "created_at": "2019-11-08 08:22:14",
              "updated_at": "2019-11-08 08:39:52"
            },
            {
              "id": 68,
              "branch_id": 2,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 280,
              "part_id": 8,
              "color_id": 2,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-11-08 08:22:53",
              "updated_at": "2019-11-08 08:22:53"
            },
            {
              "id": 69,
              "branch_id": 2,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 282,
              "part_id": 8,
              "color_id": 2,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-11-08 08:26:23",
              "updated_at": "2019-11-08 08:26:23"
            },
            {
              "id": 70,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 2,
              "part_id": 1,
              "color_id": 3,
              "amount": 12,
              "price": 0.00,
              "created_at": "2019-11-08 08:26:27",
              "updated_at": "2019-11-08 08:26:27"
            },
            {
              "id": 71,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 3,
              "part_id": 1,
              "color_id": 2,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-11-08 08:26:54",
              "updated_at": "2019-11-08 08:26:54"
            },
            {
              "id": 72,
              "branch_id": 2,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 282,
              "part_id": 8,
              "color_id": 3,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-11-08 08:26:54",
              "updated_at": "2019-11-08 08:26:54"
            },
            {
              "id": 73,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 3,
              "part_id": 1,
              "color_id": 3,
              "amount": 8,
              "price": 0.00,
              "created_at": "2019-11-08 08:27:22",
              "updated_at": "2019-11-08 08:27:22"
            },
            {
              "id": 74,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 4,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-11-08 08:27:49",
              "updated_at": "2019-11-08 16:36:36"
            },
            {
              "id": 75,
              "branch_id": 2,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 283,
              "part_id": 8,
              "color_id": 2,
              "amount": 7,
              "price": 0.00,
              "created_at": "2019-11-08 08:27:55",
              "updated_at": "2019-11-08 08:27:55"
            },
            {
              "id": 76,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 4,
              "part_id": 1,
              "color_id": 3,
              "amount": 11,
              "price": 0.00,
              "created_at": "2019-11-08 08:28:08",
              "updated_at": "2019-11-08 08:28:08"
            },
            {
              "id": 77,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 5,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-11-08 08:28:25",
              "updated_at": "2019-11-08 08:28:25"
            },
            {
              "id": 78,
              "branch_id": 2,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 283,
              "part_id": 8,
              "color_id": 3,
              "amount": 20,
              "price": 0.00,
              "created_at": "2019-11-08 08:28:33",
              "updated_at": "2019-11-08 08:28:33"
            },
            {
              "id": 79,
              "branch_id": 2,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 284,
              "part_id": 8,
              "color_id": 2,
              "amount": 0,
              "price": 0.00,
              "created_at": "2019-11-08 08:30:01",
              "updated_at": "2019-11-08 08:30:01"
            },
            {
              "id": 80,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 5,
              "part_id": 1,
              "color_id": 3,
              "amount": 7,
              "price": 0.00,
              "created_at": "2019-11-08 08:30:20",
              "updated_at": "2019-11-08 08:30:20"
            },
            {
              "id": 81,
              "branch_id": 2,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 284,
              "part_id": 8,
              "color_id": 3,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-11-08 08:30:27",
              "updated_at": "2019-11-08 08:30:27"
            },
            {
              "id": 82,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 6,
              "part_id": 1,
              "color_id": 2,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-11-08 08:30:54",
              "updated_at": "2019-11-08 08:30:54"
            },
            {
              "id": 83,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 6,
              "part_id": 1,
              "color_id": 3,
              "amount": 8,
              "price": 0.00,
              "created_at": "2019-11-08 08:31:10",
              "updated_at": "2019-11-08 08:31:10"
            },
            {
              "id": 84,
              "branch_id": 2,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 285,
              "part_id": 8,
              "color_id": 2,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-11-08 08:31:27",
              "updated_at": "2019-11-08 08:31:27"
            },
            {
              "id": 87,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 7,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-11-08 08:33:28",
              "updated_at": "2019-11-08 08:33:28"
            },
            {
              "id": 88,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 7,
              "part_id": 1,
              "color_id": 3,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-11-08 08:33:45",
              "updated_at": "2019-11-08 08:33:45"
            },
            {
              "id": 89,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 8,
              "part_id": 1,
              "color_id": 2,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-11-08 08:35:24",
              "updated_at": "2019-11-08 08:35:24"
            },
            {
              "id": 90,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 8,
              "part_id": 1,
              "color_id": 3,
              "amount": 9,
              "price": 0.00,
              "created_at": "2019-11-08 08:35:39",
              "updated_at": "2019-11-08 08:35:39"
            },
            {
              "id": 91,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 9,
              "part_id": 1,
              "color_id": 2,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-11-08 08:36:09",
              "updated_at": "2019-11-08 08:36:09"
            },
            {
              "id": 92,
              "branch_id": 2,
              "brand_id": 2,
              "model_id": 5,
              "submodel_id": 287,
              "part_id": 8,
              "color_id": 2,
              "amount": 7,
              "price": 0.00,
              "created_at": "2019-11-08 08:36:48",
              "updated_at": "2019-11-08 08:36:48"
            },
            {
              "id": 93,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 9,
              "part_id": 1,
              "color_id": 3,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-11-08 08:39:49",
              "updated_at": "2019-11-08 08:39:49"
            },
            {
              "id": 94,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 10,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-11-08 08:40:10",
              "updated_at": "2019-11-08 08:40:10"
            },
            {
              "id": 95,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 10,
              "part_id": 1,
              "color_id": 3,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-11-08 08:40:24",
              "updated_at": "2019-11-08 08:40:24"
            },
            {
              "id": 96,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 11,
              "part_id": 1,
              "color_id": 2,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-11-08 08:41:54",
              "updated_at": "2019-11-11 14:30:41"
            },
            {
              "id": 97,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 13,
              "part_id": 1,
              "color_id": 2,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-11-08 08:42:22",
              "updated_at": "2019-11-08 08:42:22"
            },
            {
              "id": 98,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 12,
              "part_id": 1,
              "color_id": 2,
              "amount": 0,
              "price": 0.00,
              "created_at": "2019-11-08 08:42:37",
              "updated_at": "2019-11-11 14:38:58"
            },
            {
              "id": 99,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 272,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-11-08 08:43:22",
              "updated_at": "2019-11-08 08:43:22"
            },
            {
              "id": 100,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 272,
              "part_id": 1,
              "color_id": 3,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-11-08 08:43:39",
              "updated_at": "2019-11-08 08:43:39"
            },
            {
              "id": 101,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 275,
              "part_id": 1,
              "color_id": 2,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-11-08 08:43:57",
              "updated_at": "2019-11-08 08:43:57"
            },
            {
              "id": 102,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 275,
              "part_id": 1,
              "color_id": 3,
              "amount": 6,
              "price": 0.00,
              "created_at": "2019-11-08 08:44:28",
              "updated_at": "2019-11-08 08:44:28"
            },
            {
              "id": 103,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 273,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-11-08 08:44:53",
              "updated_at": "2019-11-08 08:44:53"
            },
            {
              "id": 104,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 273,
              "part_id": 1,
              "color_id": 3,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-11-08 08:45:07",
              "updated_at": "2019-11-08 08:45:07"
            },
            {
              "id": 105,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 274,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-11-08 08:45:24",
              "updated_at": "2019-11-08 08:45:24"
            },
            {
              "id": 106,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 274,
              "part_id": 1,
              "color_id": 3,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-11-08 08:45:42",
              "updated_at": "2019-11-08 08:45:42"
            },
            {
              "id": 107,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 276,
              "part_id": 1,
              "color_id": 2,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-11-08 08:47:49",
              "updated_at": "2019-11-08 08:47:49"
            },
            {
              "id": 108,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 289,
              "part_id": 1,
              "color_id": 2,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-11-08 08:48:31",
              "updated_at": "2019-11-08 08:48:31"
            },
            {
              "id": 109,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 277,
              "part_id": 1,
              "color_id": 2,
              "amount": 10,
              "price": 0.00,
              "created_at": "2019-11-08 08:49:01",
              "updated_at": "2019-11-08 08:49:01"
            },
            {
              "id": 110,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 277,
              "part_id": 1,
              "color_id": 3,
              "amount": 9,
              "price": 0.00,
              "created_at": "2019-11-08 08:49:16",
              "updated_at": "2019-11-08 08:49:16"
            },
            {
              "id": 111,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 277,
              "part_id": 2,
              "color_id": 1,
              "amount": 7,
              "price": 0.00,
              "created_at": "2019-11-08 08:52:36",
              "updated_at": "2019-11-08 08:52:36"
            },
            {
              "id": 112,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 1,
              "part_id": 2,
              "color_id": 1,
              "amount": 9,
              "price": 0.00,
              "created_at": "2019-11-08 08:52:55",
              "updated_at": "2019-11-08 08:52:55"
            },
            {
              "id": 113,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 289,
              "part_id": 2,
              "color_id": 1,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-11-08 08:53:15",
              "updated_at": "2019-11-08 08:53:15"
            },
            {
              "id": 114,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 2,
              "part_id": 2,
              "color_id": 1,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-11-08 08:53:40",
              "updated_at": "2019-11-08 08:53:40"
            },
            {
              "id": 115,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 290,
              "part_id": 2,
              "color_id": 1,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-11-08 08:54:06",
              "updated_at": "2019-11-08 08:54:06"
            },
            {
              "id": 116,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 3,
              "part_id": 2,
              "color_id": 1,
              "amount": 10,
              "price": 0.00,
              "created_at": "2019-11-08 08:54:29",
              "updated_at": "2019-11-08 16:37:01"
            },
            {
              "id": 117,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 5,
              "part_id": 2,
              "color_id": 1,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-11-08 08:54:49",
              "updated_at": "2019-11-08 08:54:49"
            },
            {
              "id": 118,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 4,
              "part_id": 2,
              "color_id": 1,
              "amount": 7,
              "price": 0.00,
              "created_at": "2019-11-08 08:55:06",
              "updated_at": "2019-11-08 08:55:06"
            },
            {
              "id": 119,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 6,
              "part_id": 2,
              "color_id": 1,
              "amount": 4,
              "price": 0.00,
              "created_at": "2019-11-08 08:55:28",
              "updated_at": "2019-11-08 08:55:28"
            },
            {
              "id": 120,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 7,
              "part_id": 2,
              "color_id": 1,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-11-08 08:56:15",
              "updated_at": "2019-11-08 08:56:15"
            },
            {
              "id": 121,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 8,
              "part_id": 2,
              "color_id": 1,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-11-08 08:56:31",
              "updated_at": "2019-11-08 08:56:31"
            },
            {
              "id": 122,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 9,
              "part_id": 2,
              "color_id": 1,
              "amount": 3,
              "price": 0.00,
              "created_at": "2019-11-08 08:56:47",
              "updated_at": "2019-11-08 08:56:47"
            },
            {
              "id": 123,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 10,
              "part_id": 2,
              "color_id": 1,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-11-08 08:57:04",
              "updated_at": "2019-11-08 08:57:04"
            },
            {
              "id": 124,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 11,
              "part_id": 2,
              "color_id": 1,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-11-08 08:57:17",
              "updated_at": "2019-11-08 08:57:17"
            },
            {
              "id": 126,
              "branch_id": 5,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 15,
              "part_id": 1,
              "color_id": 1,
              "amount": 10,
              "price": 0.00,
              "created_at": "2019-11-10 11:02:38",
              "updated_at": "2019-11-10 11:02:38"
            },
            {
              "id": 127,
              "branch_id": 4,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 288,
              "part_id": 1,
              "color_id": 2,
              "amount": 2,
              "price": 0.00,
              "created_at": "2019-11-11 14:30:56",
              "updated_at": "2019-11-11 14:30:56"
            },
            {
              "id": 128,
              "branch_id": 5,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 11,
              "part_id": 1,
              "color_id": 2,
              "amount": 19,
              "price": 0.00,
              "created_at": "2019-11-24 19:56:44",
              "updated_at": "2019-11-24 19:56:54"
            },
            {
              "id": 129,
              "branch_id": 5,
              "brand_id": 9,
              "model_id": 19,
              "submodel_id": 245,
              "part_id": 3,
              "color_id": 8,
              "amount": 1,
              "price": 0.00,
              "created_at": "2019-11-25 16:03:57",
              "updated_at": "2019-11-25 16:03:57"
            },
            {
              "id": 130,
              "branch_id": 5,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 9,
              "part_id": 1,
              "color_id": 2,
              "amount": 5,
              "price": 0.00,
              "created_at": "2019-11-25 16:27:29",
              "updated_at": "2019-11-25 16:27:29"
            },
            {
              "id": 131,
              "branch_id": 5,
              "brand_id": 1,
              "model_id": 1,
              "submodel_id": 6,
              "part_id": 1,
              "color_id": 2,
              "amount": 7,
              "price": 0.00,
              "created_at": "2019-11-25 16:47:38",
              "updated_at": "2019-11-25 16:47:38"
            }
          ]';

        return $result;
    }
}
