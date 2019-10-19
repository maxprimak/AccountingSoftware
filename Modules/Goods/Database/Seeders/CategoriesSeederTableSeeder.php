<?php

namespace Modules\Goods\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\CategoryHeader;
use Modules\Goods\Entities\GoodsCategory;

class CategoriesSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // HEADERS
        // $category_header = new CategoryHeader();
        // $category_header->name = "Brand";
        // $category_header->save();
        //
        // $category_header = new CategoryHeader();
        // $category_header->name = "Model";
        // $category_header->save();
        //
        // $category_header = new CategoryHeader();
        // $category_header->name = "Submodel";
        // $category_header->save();
        //
        // $category_header = new CategoryHeader();
        // $category_header->name = "Parts";
        // $category_header->save();

    }
}
