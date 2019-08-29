<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //Create personal data for user oliinykm95
        factory('Modules\Users\Entities\People')->create();

        //Create user instance of oliinykm95
        factory('Modules\Users\Entities\User')->create();

        factory('Modules\Users\Entities\UserHasBranch')->create();


        //TODO - roles
        /*DB::table('roles')->insert([
            ['name' => 'Head'],
            ['name' => 'Sales Manager'],
            ['name' => 'Tech']
        ]);*/
    }
}
