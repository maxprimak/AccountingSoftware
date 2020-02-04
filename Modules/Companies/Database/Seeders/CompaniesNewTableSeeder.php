<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Warehouses\Entities\Warehouse;
use Modules\Companies\Entities\Address;

class CompaniesNewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function store_warehouse($branch){
       $warehouse = new Warehouse();
       $branch->branch_id = $branch->id;
       $warehouse->store($branch);
    }

    public function run()
    {
        Model::unguard();

        $company = factory('Modules\Companies\Entities\Company')->create([
            'name' => 'NewCompany',
            'currency_id' => 1,
            'phone' => '+43 1 23456789',
            'tax' => 10,
            'address_id' => Address::makeCopy(Address::all()->first())->id,
        ]);

        $firstBranch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'NewBranch 11',
            'company_id' => $company->id,
            'color' => '#F64272',
            'address_id' => Address::makeCopy(Address::all()->first())->id,
            'phone' => '+43 1 123456789'
        ]);
        $this->store_warehouse($firstBranch);

        $secondBranch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'NewBranch 22',
            'company_id' => $company->id,
            'color' => '#f7ff16',
            'address_id' => Address::makeCopy(Address::all()->first())->id,
            'phone' => '+43 9 87654321'
        ]);

        $this->store_warehouse($secondBranch);

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => 'me@newcompany.at',
            'password' => bcrypt('123456789'),
            'email' => 'me@newcompany.at',
        ]);

        $person = factory('Modules\Users\Entities\People')->create([
            'name' => 'Tom Thompson',
            'address' => 'Brigittenau 1',
            'phone' => '+43 1 23456789'
        ]);

        $user = factory('Modules\Users\Entities\User')->create([
            'login_id' => $login->id,
            'person_id' => $person->id,
            'company_id' => $company->id,
        ]);

        factory('Modules\Users\Entities\UserHasBranch')->create([
            'user_id' => $user->id,
            'branch_id' => $firstBranch->id
        ]);


        factory('Modules\Users\Entities\UserHasBranch')->create([
            'user_id' => $user->id,
            'branch_id' => $secondBranch->id
        ]);

        factory('Modules\Employees\Entities\Employee')->create([
            'user_id' => $user->id,
            'role_id' => 1,
        ]);

    }
}
