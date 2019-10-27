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

        //Create personal data
        factory('Modules\Users\Entities\People')->create([
            'name' => 'Mustafa',
            'address' => 'Wagramerstraße 94',
            'phone' => '+43 1 3694001'
        ]);

        //Create user instance
        factory('Modules\Users\Entities\User')->create([
            'login_id' => 1,
            'person_id' => 1,
            'company_id' =>  1,
        ]);

        factory('Modules\Users\Entities\UserHasBranch')->create([
            'user_id' => 1,
            'branch_id' => 1
        ]);

    
        factory('Modules\Users\Entities\UserHasBranch')->create([
            'user_id' => 1,
            'branch_id' => 2
        ]);

        factory('Modules\Users\Entities\UserHasBranch')->create([
            'user_id' => 1,
            'branch_id' => 3
        ]);

        factory('Modules\Users\Entities\UserHasBranch')->create([
            'user_id' => 1,
            'branch_id' => 4
        ]);
        
    }
}
