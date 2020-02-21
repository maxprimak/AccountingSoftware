<?php

namespace Modules\Goods\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Goods\Entities\Part;
use Modules\Goods\Entities\PartsTranslation;

class MorePartsAndPartsTranslationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $parts = $this->getMorePartsWithDeTranslation();

        foreach($parts as $en => $de){
            if(PartsTranslation::where('name', $en)->exists()){
                $en_translation = PartsTranslation::where('name', $en)->first();
                $de_translation = new PartsTranslation();
                $de_translation->part_id = $en_translation->part_id;
                $de_translation->name = $de;
                $de_translation->language_id = 2;
                $de_translation->save();
            }
            else{

                $part = new Part();
                $part->save();

                $en_translation = new PartsTranslation();
                $en_translation->part_id = $part->id;
                $en_translation->name = $en;
                $en_translation->language_id = 1;
                $en_translation->save();

                $de_translation = new PartsTranslation();
                $de_translation->part_id = $part->id;
                $de_translation->name = $de;
                $de_translation->language_id = 2;
                $de_translation->save();
            }
        }
        
    }

    private function getMorePartsWithDeTranslation() {
        return [
            "Charging port" => "Aufladeport",
            "Microphone" => "Mikrofon",
            "Ear Speaker" => "Ohrhörer", //?
            "Loud Speaker" => "Lautsprecher",
            "Back Cover" => "Rückseite",
            "Power-button" => "Power-Taste",
            "Back camera glass" => "Rückkameraglas",
            "TrackPad" => "TrackPad",
            "Keyboard" => "Tastatur",
            "Display" => "Display",
            "Battery" => "Akku",
            "Side Buttons" => "Seitentasten",
            "Vibration motor" => "Vibrationsmotor",
            "Home-button" => "Home-Taste",
            "Front-camera" => "Frontkamera",
            "Main-camera" => "Hauptkamera",
        ];
    }
}
