<?php

namespace Modules\Goods\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\Submodel;


class SubmodelSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        Model::unguard();
        $this->apple();
        $this->samsung();
        $this->huawei();
        $this->sonny();
    }

    public function apple(){
      //APPLE
        //MAKE IPHONE FROM iPhone 5 TILL iPhone 8
        for($i = 5; $i <= 8;$i++){
          //normal
          $submodel = new Submodel();
          $submodel->model_id = 1;
          $submodel->name = $i;
          $submodel->save();
          if($i >= 6){
            //Plus
            $submodel = new Submodel();
            $submodel->model_id = 1;
            $submodel->name = $i." Plus";
            $submodel->save();
          }
          if($i < 7){
            $submodel = new Submodel();
            $submodel->model_id = 1;
            $submodel->name = $i."s";
            $submodel->save();
            if($i >= 6){
              //Plus
              $submodel = new Submodel();
              $submodel->model_id = 1;
              $submodel->name = $i."s Plus";
              $submodel->save();
            }
          }
        }

        //MAKE IPHONE FROM iPhone X TILL iPhone 11 Pro
        $submodel = new Submodel();
        $submodel->model_id = 1;
        $submodel->name = "X";
        $submodel->save();

        $submodel = new Submodel();
        $submodel->model_id = 1;
        $submodel->name = "Xr";
        $submodel->save();

        $submodel = new Submodel();
        $submodel->model_id = 1;
        $submodel->name = "Xs";
        $submodel->save();

        $submodel = new Submodel();
        $submodel->model_id = 1;
        $submodel->name = "Xs Max";
        $submodel->save();

        $submodel = new Submodel();
        $submodel->model_id = 1;
        $submodel->name = "11";
        $submodel->save();

        $submodel = new Submodel();
        $submodel->model_id = 1;
        $submodel->name = "11 Pro";
        $submodel->save();

    }

    public function samsung(){

    }

    public function huawei(){

    }

    public function sonny(){

    }

}
