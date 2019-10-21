<?php

namespace Modules\Login\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LoginDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //Create login data of user oliinykm95
        factory('Modules\Login\Entities\Login')->create([
            'username' => 'oliinykm95',
        ]);

        factory('Modules\Login\Entities\Login')->create([
            'username' => 'maxim_primak',
        ]);

        factory('Modules\Login\Entities\Login')->create([
            'username' => 'Lee_duy_vn',
        ]);

        factory('Modules\Login\Entities\Login')->create([
            'username' => 'bomman_getwife',
        ]);

        factory('Modules\Login\Entities\Login')->create([
            'username' => 'vanduycr7',
        ]);
    }
}
