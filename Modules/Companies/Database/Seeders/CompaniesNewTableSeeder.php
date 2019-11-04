<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CompaniesNewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory('Modules\Companies\Entities\Company')->create([
            'name' => 'NewCompany',
            'currency_id' => 1,
            'address' => 'Brigittenau',
            'phone' => '+43 1 23456789'
        ]);
        
        factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'NewBranch 11',
            'company_id' => 2,
            'color' => '#F64272',
            'address' => 'Brigittenau 1',
            'phone' => '+43 1 123456789'
        ]);

        factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'NewBranch 22',
            'company_id' => 2,
            'color' => '#f7ff16',
            'address' => 'Brigittenau 2',
            'phone' => '+43 9 87654321'
        ]);

        factory('Modules\Login\Entities\Login')->create([
            'username' => 'me@newcompany.at',
            'password' => bcrypt('123456789'),
            'email' => 'me@newcompany.at',
        ]);

        factory('Modules\Users\Entities\People')->create([
            'name' => 'Tom Thompson',
            'address' => 'Brigittenau 1',
            'phone' => '+43 1 23456789'
        ]);

        //Create user instance
        factory('Modules\Users\Entities\User')->create([
            'login_id' => 2,
            'person_id' => 2,
            'company_id' => 2,
        ]);

        factory('Modules\Users\Entities\UserHasBranch')->create([
            'user_id' => 2,
            'branch_id' => 5
        ]);

    
        factory('Modules\Users\Entities\UserHasBranch')->create([
            'user_id' => 2,
            'branch_id' => 6
        ]);

        factory('Modules\Employees\Entities\Employee')->create([
            'user_id' => 2,
            'role_id' => 1,
        ]);

    }
}
