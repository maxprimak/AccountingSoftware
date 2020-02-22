<?php

namespace Modules\Services\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\Part;
use Modules\Goods\Entities\PartsTranslation;
use Modules\Services\Entities\Service;
use Modules\Services\Entities\ServiceHasPart;
use Modules\Services\Entities\ServicesTranslation;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $services = $this->getServices();

        foreach($services as $key => $value){
            $service_arr = $value;

            $service = new Service();
            $service->is_custom = 0;
            $service->save();

            $en = new ServicesTranslation();
            $en->name = $service_arr['en'];
            $en->service_id = $service->id;
            $en->language_id = 1;
            $en->save();

            $de = new ServicesTranslation();
            $de->name = $service_arr['de'];
            $de->service_id = $service->id;
            $de->language_id = 2;
            $de->save();

            if($service_arr['part_id'] != null){
                $has_part = new ServiceHasPart();
                $has_part->part_id = $service_arr['part_id'];
                $has_part->service_id = $service->id;
                $has_part->save();
            }

        }

    }

    private function getPartIdByName($name){
        $translation = PartsTranslation::where('name',$name)->firstOrFail();
        return $translation->part_id;
    }

    private function getServices(){
        return [
            1 => [
                "en" => "Display Repair",
                "de" => "Display Reparatur",
                "part_id" => $this->getPartIdByName("Display")
            ],
            2 => [
                "en" => "Battery Repair",
                "de" => "Akku Reparatur",
                "part_id" => $this->getPartIdByName("Akku")
            ],
            3 => [
                "en" => "Charging port + (Headphone Jack Repair)",
                "de" => "Ladeanschluss + (Reparatur der Kopfhörerbuchse)",
                "part_id" => $this->getPartIdByName("Charging port")
            ],
            4 => [
                "en" => "Microphone Repair",
                "de" => "Mikrofon Reparatur",
                "part_id" => $this->getPartIdByName("Mikrofon")
            ],
            5 => [
                "en" => "Home-button Repair",
                "de" => "Home-Taste Reparatur",
                "part_id" => $this->getPartIdByName("Home-Taste")
            ],
            6 => [
                "en" => "Ear Speaker Repair",
                "de" => "Ohrhörer Reparatur",
                "part_id" => $this->getPartIdByName("Ohrhörer")
            ],
            7 => [
                "en" => "Loud Speaker Repair",
                "de" => "Lautsprecher Reparatur",
                "part_id" => $this->getPartIdByName("Lautsprecher")
            ],
            8 => [
                "en" => "Software problems solving",
                "de" => "Lösung der Softwareprobleme",
                "part_id" => null
            ],
            9 => [
                "en" => "Back Cover Repair",
                "de" => "Rückseite Reparatur",
                "part_id" => $this->getPartIdByName("Back Cover")
            ],
            10 => [
                "en" => "Data Recovery",
                "de" => "Datenwiederherstellung",
                "part_id" => null
            ],
            11 => [
                "en" => "Power Button Repair",
                "de" => "Power-Taste Reparatur",
                "part_id" => $this->getPartIdByName("Power-Taste")
            ],
            12 => [
                "en" => "Logic Board Repair",
                "de" => "Reparatur der Logikplatine",
                "part_id" => null
            ],
            13 => [
                "en" => "Main-camera Repair",
                "de" => "Hauptkamera Reparatur",
                "part_id" => $this->getPartIdByName("Hauptkamera")
            ],
            14 => [
                "en" => "Front-camera + Proximity Sensor Repair",
                "de" => "Frontkamera + Näherungssensor Reparatur",
                "part_id" => $this->getPartIdByName("Frontkamera")
            ],
            15 => [
                "en" => "Back Camera Glass Repair",
                "de" => "Rückkameraglas Reparatur ",
                "part_id" => $this->getPartIdByName("Rückkameraglas")
            ],
            16 => [
                "en" => "Diagnostics",
                "de" => "Analyse",
                "part_id" => null
            ],
            17 => [
                "en" => "Water damages",
                "de" => "Wasserschäden",
                "part_id" => null
            ],
            18 => [
                "en" => "TrackPad Repair",
                "de" => "TrackPad Reparatur",
                "part_id" => $this->getPartIdByName("TrackPad")
            ],
            19 => [
                "en" => "Keyboard Repair",
                "de" => "Tastatur Reparatur",
                "part_id" => $this->getPartIdByName("Keyboard")
            ],
        ];
    }
}
