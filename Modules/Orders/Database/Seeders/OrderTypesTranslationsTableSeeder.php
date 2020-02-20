<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\OrderTypes;
use Modules\Orders\Entities\OrderTypesTranslations;

class OrderTypesTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $translations = $this->getDETranslations();

        foreach($translations as $key => $value){
            $this->saveDETranslation($key, $value);
        }

    }

    private function getDETranslations(){
        return  [
            1 => "Zahlung",
            2 => "Herstellergarantie",
            3 => "Reklamation",
        ];
    }

    private function saveDETranslation($type_id, $name){
        $translation = new OrderTypesTranslations();
        $translation->name = $name;
        $translation->order_type_id = $type_id;
        $translation->language_id = 2;

        $translation->save();
    }
}
