<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\PaymentStatuses;
use Modules\Orders\Entities\PaymentStatusesTranslations;

class PaymentStatusesTranslationsTableSeeder extends Seeder
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
            1 => "Bezahlt",
            2 => "Teilweise bezahlt",
            3 => "Nicht bezahlt",
        ];
    }

    private function saveDETranslation($status_id, $name){
        $translation = new PaymentStatusesTranslations();
        $translation->name = $name;
        $translation->payment_status_id = $status_id;
        $translation->language_id = 2;

        $translation->save();
    }
}
