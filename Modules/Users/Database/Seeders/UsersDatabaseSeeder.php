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
        factory('Modules\Users\Entities\People', 5)->create();

        //Create user instance of oliinykm95
        factory('Modules\Users\Entities\User')->create([
            'login_id' => 1,
            'person_id' => 1,
            'company_id' =>  1,
        ]);
        
        /*
        factory('Modules\Users\Entities\User')->create([
            'login_id' => 2,
            'person_id' => 2,
            'company_id' =>  2,
        ]);

        factory('Modules\Users\Entities\User')->create([
            'login_id' => 3,
            'person_id' => 3,
            'branch_id' =>  3,
        ]);

        factory('Modules\Users\Entities\User')->create([
            'login_id' => 4,
            'person_id' => 4,
            'branch_id' =>  4,
        ]);

        factory('Modules\Users\Entities\User')->create([
            'login_id' => 5,
            'person_id' => 5,
            'branch_id' =>  5,
        ]);
        */

        factory('Modules\Users\Entities\UserHasBranch')->create();
    }
}
