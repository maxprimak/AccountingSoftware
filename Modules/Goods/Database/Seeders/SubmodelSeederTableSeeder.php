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
        // $this->samsung();
        // $this->huawei();
        // $this->sonny();
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

        //MAKE IPADS
          $submodel = new Submodel();
          $submodel->model_id = 2;
          $submodel->name = "iPad";
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 2;
          $submodel->name = "iPad 2";
          $submodel->save();
          //IPAD
          for($i = 3; $i <= 7;$i++){
            $submodel = new Submodel();
            $submodel->model_id = 2;
            $submodel->name = "iPad ".$i."rd Generation";
            $submodel->save();
          }
          //IPAD MINI
          $submodel = new Submodel();
          $submodel->model_id = 2;
          $submodel->name = "iPad mini";
          $submodel->save();

          for($i = 2; $i <= 5;$i++){
            $submodel = new Submodel();
            $submodel->model_id = 2;
            $submodel->name = "iPad mini ".$i;
            $submodel->save();
          }

          //IPAD AIR
          $submodel = new Submodel();
          $submodel->model_id = 2;
          $submodel->name = "iPad Air";
          $submodel->save();

          for($i = 2; $i <= 3;$i++){
            $submodel = new Submodel();
            $submodel->model_id = 2;
            $submodel->name = "iPad Air ".$i;
            $submodel->save();
          }

          //IPAD PRO
          $submodel = new Submodel();
          $submodel->model_id = 2;
          $submodel->name = "iPad Pro 12.9 inch";
          $submodel->save();

          for($i = 2; $i <= 3;$i++){
            $submodel = new Submodel();
            $submodel->model_id = 2;
            if($i == 2){
              $submodel->name = "iPad Pro 12.9 inch ".$i."nd Generation";
            }else{
              $submodel->name = "iPad Pro 12.9 inch ".$i."rd Generation";
            }
            $submodel->save();
          }

      //MAKE APPLE WATCH
          for($i = 1; $i <= 5;$i++){
            $submodel = new Submodel();
            $submodel->model_id = 3;
            $submodel->name = "Apple Watch Series ".$i;
            $submodel->save();
          }

      //MAKE MACBOOK
          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1181';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1278';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1342';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1534';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1237';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1304';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1370';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1369';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1465';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1466';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1932';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1150';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1151';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1211';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1212';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1226';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1229';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1260';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1261';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1286';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1297';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1398';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1425';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1502';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1708';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1706';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1707';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1989';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1990';
          $submodel->save();

          $submodel = new Submodel();
          $submodel->model_id = 4;
          $submodel->name = 'A1212';
          $submodel->save();
    }

    public function samsung(){
        for($i = 5; $i <= 10; $i++){
          //SAMSUNG Submodel
          $Submodel = new Submodel();
          $Submodel->model_id = 5;
          $Submodel->name = "Galaxy S".$i;
          $Submodel->save();

          if($i == 5){
            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy S".$i." Plus";
            $Submodel->save();
          }

          if($i > 5 && $i < 8){
            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy S".$i."Edge";
            $Submodel->save();

            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy S".$i."Edge+";
            $Submodel->save();

          }

          if($i >= 8){
            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy S".$i. "+";
            $Submodel->save();
          }

          if($i == 10){
            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy S".$i. "e";
            $Submodel->save();

            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy S".$i. "+";
            $Submodel->save();
          }

        }

        for($i = 4; $i <= 10; $i++){
          //SAMSUNG Submodel
          $Submodel = new Submodel();
          $Submodel->model_id = 5;
          $Submodel->name = "Galaxy Note ".$i;
          $Submodel->save();

          if($i == 10){
            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy Note ".$i. "+";
            $Submodel->save();
          }
        }
        //A MODEL
        for($i = 3; $i <= 9; $i++){
          if($i != 4){
            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy A".$i;
            $Submodel->save();


            if($i == 3 || $i == 5){
              //SAMSUNG Submodel
              $Submodel = new Submodel();
              $Submodel->model_id = 5;
              $Submodel->name = "Galaxy  ".$i. "+";
              $Submodel->save();
            }
          }
        }
        //SAMSUNG Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 5;
        $Submodel->name = "Galaxy J";
        $Submodel->save();

        //SAMSUNG Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 5;
        $Submodel->name = "Galaxy A";
        $Submodel->save();

        //SAMSUNG Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 5;
        $Submodel->name = "Galaxy M";
        $Submodel->save();

        //SAMSUNG Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 6;
        $Submodel->name = "Galaxy Tab";
        $Submodel->save();
    }

    public function huawei(){
      //HUAWEI Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "Mate";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "P";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "Y";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "Nova";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "Honor";
        $Submodel->save();

    }

    public function LG(){
      //LG Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 13;
        $Submodel->name = "Q";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 13;
        $Submodel->name = "G";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 13;
        $Submodel->name = "K";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 13;
        $Submodel->name = "Y";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 14;
        $Submodel->name = "G Tab";
        $Submodel->save();
    }

    public function sonny(){
      //SONY Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia X";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia Z";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia L";
        $Submodel->save();

    }

    public function onePlus(){
      //OnePlus Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "OnePlus";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "OnePlus T";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "OnePlus Pro";
        $Submodel->save();
    }

    public function oppo(){
      //OnePlus oppo
        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Oppo A";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Oppo K";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Oppo R";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Oppo Reno";
        $Submodel->save();
    }

    public function vivo(){
      //Vivo oppo
        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "Oppo A";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Oppo K";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 7;
        $Submodel->name = "Oppo R";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 7;
        $Submodel->name = "Oppo Reno";
        $Submodel->save();
    }


    public function xiaomi(){
      //OnePlus oppo
        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Oppo A";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Oppo K";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 7;
        $Submodel->name = "Oppo R";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 7;
        $Submodel->name = "Oppo Reno";
        $Submodel->save();
    }



}
