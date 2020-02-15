<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Services\Entities\Language;

class AddGermanAndRussianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $language = new Language();
        $language->id = 2;
        $language->code = "DE";
        $language->name = "German";
        $language->save();

        $language = new Language();
        $language->id = 3;
        $language->code = "RU";
        $language->name = "Russian";
        $language->save();

    }
}
