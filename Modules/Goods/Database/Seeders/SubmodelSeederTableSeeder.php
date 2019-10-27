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
        $this->onePlus();
        $this->oppo();
        $this->vivo();
        $this->xiaomi();

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
            $Submodel->name = "Galaxy S".$i." Edge";
            $Submodel->save();

            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy S".$i." Edge+";
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


            if($i > 4 && $i <= 9){
              //SAMSUNG Submodel
              $Submodel = new Submodel();
              $Submodel->model_id = 5;
              $Submodel->name = "Galaxy  A".$i. " (2016)";
              $Submodel->save();

              //SAMSUNG Submodel
              $Submodel = new Submodel();
              $Submodel->model_id = 5;
              $Submodel->name = "Galaxy  A".$i. " (2017)";
              $Submodel->save();


            }
            if($i <= 7 && $i <= 9){
              //SAMSUNG Submodel
              $Submodel = new Submodel();
              $Submodel->model_id = 5;
              $Submodel->name = "Galaxy  A".$i. " (2018)";
              $Submodel->save();
            }

          }
        }

        // A 10 - A 70
        for($i = 10; $i < 90; $i += 10){
            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy  A".$i;
            $Submodel->save();

          if($i == 10 || $i == 20){
            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy  A".$i. "e";
            $Submodel->save();
          }

          if($i >= 10 && $i <= 70){
            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy  A".$i. "s";
            $Submodel->save();
          }
        }


        //SAMSUNG Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 5;
        $Submodel->name = "Galaxy J 330";
        $Submodel->save();

        //SAMSUNG Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 5;
        $Submodel->name = "Galaxy J 530";
        $Submodel->save();

        for($i = 10; $i <= 40; $i += 10){
          //SAMSUNG Submodel
          $Submodel = new Submodel();
          $Submodel->model_id = 5;
          $Submodel->name = "Galaxy M".$i;
          $Submodel->save();

          if($i == 10 || $i == 30){
            //SAMSUNG Submodel
            $Submodel = new Submodel();
            $Submodel->model_id = 5;
            $Submodel->name = "Galaxy M".$i."s";
            $Submodel->save();
          }
        }
    }

    public function huawei(){
      //HUAWEI Submodel
      for($i = 8; $i <= 9; $i++){
        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "Mate ".$i;
        $Submodel->save();

        if($i == 9){
          $Submodel = new Submodel();
          $Submodel->model_id = 9;
          $Submodel->name = "Mate ".$i." Lite";
          $Submodel->save();

          $Submodel = new Submodel();
          $Submodel->model_id = 9;
          $Submodel->name = "Mate ".$i." Pro";
          $Submodel->save();

          $Submodel = new Submodel();
          $Submodel->model_id = 9;
          $Submodel->name = "Mate ".$i." Porsche";
          $Submodel->save();
        }
      }
      for($i = 10; $i <= 30; $i += 10){
        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "Mate ".$i;
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "Mate ".$i." Pro";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "Mate ".$i." Porsche";
        $Submodel->save();
      }

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "P Smart";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "P Smart +";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "P Smart Z";
        $Submodel->save();

      for($i = 8; $i <= 9; $i++){
        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "P".$i;
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "P".$i." Lite";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "P".$i." Max";
        $Submodel->save();

        if($i == 9){
          $Submodel = new Submodel();
          $Submodel->model_id = 9;
          $Submodel->name = "P".$i." Plus";
          $Submodel->save();

          $Submodel = new Submodel();
          $Submodel->model_id = 9;
          $Submodel->name = "P".$i." Lite Mini";
          $Submodel->save();
        }
      }

      for($i = 10; $i <= 30;$i += 10){
        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "P".$i;
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "P".$i." Lite";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 9;
        $Submodel->name = "P".$i." Pro";
        $Submodel->save();
      }

        for($i = 2; $i <= 5; $i++){
          $Submodel = new Submodel();
          $Submodel->model_id = 9;
          $Submodel->name = "Nova ".$i;
          $Submodel->save();

          if($i == 2){
            $Submodel = new Submodel();
            $Submodel->model_id = 9;
            $Submodel->name = "Nova ".$i." Plus";
            $Submodel->save();

            $Submodel = new Submodel();
            $Submodel->model_id = 9;
            $Submodel->name = "Nova ".$i."s";
            $Submodel->save();
          }
        }
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
        $Submodel->name = "Xperia 5";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia 1";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia 10";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia 10 Plus";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia L3";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia XZ3";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia XZ2";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia XZ2 Compact";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia XZ1";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia XZ1 Compact";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia XZ Premium";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia Z1";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia Z1 Compact";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia Z Ultra";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia Z2";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia Z3";
        $Submodel->save();


        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia Z5";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia Z5 Compact";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia Z5 Premium";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia M4 Aqua";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia M5 Aqua";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 15;
        $Submodel->name = "Xperia L1";
        $Submodel->save();

    }

    public function onePlus(){
      //OnePlus Submodel
        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "3";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "5";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "6";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "7";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "7 Pro";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "3T";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "5T";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "6T";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "6T McLaren";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "7T";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "7T Pro";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 16;
        $Submodel->name = "7T McLaren";
        $Submodel->save();
    }

    public function oppo(){
      //OnePlus oppo
        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "A9";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "A9 2020";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "A5 2020";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "K3";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Reno2";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Reno2 F";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Reno2 Z";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Reno Z";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "Reno 10x Zoom";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "F11";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 17;
        $Submodel->name = "F11 Pro";
        $Submodel->save();
    }

    public function vivo(){
      //Vivo oppo
        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "V17 Pro";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "V15 Pro";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "V15";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "V11";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "V11i";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "V9 Youth";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "V9";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "V7";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "V7+";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "Y95";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "Y91C";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "Y93";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "Y17";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "Y85";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "Y81i";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "Y83";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "Y71";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "X21";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "NEX";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "NEX Dual Display";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 18;
        $Submodel->name = "S1";
        $Submodel->save();
    }


    public function xiaomi(){
      //OnePlus oppo
        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi 8";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi 8A";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi Note 8";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi Note 8 Pro";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi 7A";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi 7";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi Note 7";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi 6";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi 6A";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi Note 6 Pro";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Redmi S2";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "POCOPHONE F1";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi Mix Alpha";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi Mix 3";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi Mix 2S";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi 9 Lite";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi 9T";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi 9T Pro";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi 9 SE";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi 9";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi 8";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi 8 Pro";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi 8 Lite";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi Max 3";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi A3";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi A2";
        $Submodel->save();

        $Submodel = new Submodel();
        $Submodel->model_id = 19;
        $Submodel->name = "Mi A2 Lite";
        $Submodel->save();

    }



}
