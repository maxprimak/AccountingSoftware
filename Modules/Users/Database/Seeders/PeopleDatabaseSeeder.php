<?php
namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\People;

class PeopleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $Maxim = new People();
        $Maxim->name = "Maxim Primak";
        $Maxim->address = 'Prechtlgasse 9';
        $Maxim->phone = '067762337470';
        $Maxim->save();

        $Maxym = new People();
        $Maxym->name = "Maxym Oliinyk";
        $Maxym->address = 'Bakhamach';
        $Maxym->phone = '02';
        $Maxym->save();

        // $this->call("OthersTableSeeder");
    }
}
