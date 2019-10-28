<?php

namespace Modules\Employees\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EmployeesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory('Modules\Employees\Entities\Employee')->create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
        /*
        factory('Modules\Employees\Entities\Employee')->create([
            'user_id' => 2,
            'role_id' => 2,
        ]);
        
        factory('Modules\Employees\Entities\Employee')->create([
            'user_id' => 3,
            'role_id' => 2,
        ]);

        factory('Modules\Employees\Entities\Employee')->create([
            'user_id' => 4,
            'role_id' => 3,
        ]);

        factory('Modules\Employees\Entities\Employee')->create([
            'user_id' => 5,
            'role_id' => 3,
        ]);
        */
    }
}
