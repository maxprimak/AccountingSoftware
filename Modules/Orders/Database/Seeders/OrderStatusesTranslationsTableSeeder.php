<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\OrderStatusesTranslation;

class OrderStatusesTranslationsTableSeeder extends Seeder
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
            1 => "Angenommen",
            2 => "In Bearbeitung",
            3 => "Ersatzteile bestellen",
            4 => "Warten auf Ersatzteile",
            5 => "Repariert",
            6 => "Nicht reparierbar",
            7 => "Warten auf Kunden",
            8 => "Abgeholt"
        ];
    }

    private function saveDETranslation($status_id, $name){
        $translation = new OrderStatusesTranslation();
        $translation->name = $name;
        $translation->order_status_id = $status_id;
        $translation->language_id = 2;

        $translation->save();
    }
}
