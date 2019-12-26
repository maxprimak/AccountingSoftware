<?php

namespace Modules\Services\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\Submodel;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Brand;

class ModelFixTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $model_ids = Models::where('brand_id' , 1)->pluck('id')->toArray();
        $submodels = Submodel::whereIn('model_id' , $model_ids)->get();

        foreach($submodels as $submodel){
            $model = Models::find($submodel->model_id);
            if($model->id != 2 && $model->id != 3){
                $submodel->name = $model->name ." " . $submodel->name;
                $submodel->save();
            }
        }
        
    }
}
