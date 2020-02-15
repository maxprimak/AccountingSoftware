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

        $address = Address::saveAddress("1", "1000", "Teststraße", 3899);

        $company = factory('Modules\Companies\Entities\Company')->create([
            'name' => 'NewCompany',
            'currency_id' => 1,
            'phone' => '+43 1 23456789',
            'tax' => 10,
            'address_id' => $address->id,
        ]);

        $firstBranch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'NewBranch 11',
            'company_id' => $company->id,
            'color' => '#F64272',
            'address_id' => Address::makeCopy($address)->id,
            'phone' => '+43 1 123456789'
        ]);
        $this->store_warehouse($firstBranch);

        $secondBranch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'NewBranch 22',
            'company_id' => $company->id,
            'color' => '#f7ff16',
            'address_id' => Address::makeCopy($address)->id,
            'phone' => '+43 9 87654321'
        ]);

        $this->store_warehouse($secondBranch);

        $login = factory('Modules\Login\Entities\Login')->create([
            'id' => 6,
            'username' => 'me@newcompany.at',
            'password' => bcrypt('123456789'),
            'email' => 'me@newcompany.at',
        ]);

        $person = factory('Modules\Users\Entities\People')->create([
            'id' => 48,
            'name' => 'Tom Thompson',
            'address' => 'Brigittenau 1',
            'phone' => '+43 1 23456789'
        ]);

        $user = factory('Modules\Users\Entities\User')->create([
            'id' => 6,
            'login_id' => $login->id,
            'person_id' => $person->id,
            'company_id' => $company->id,
        ]);

        factory('Modules\Users\Entities\UserHasBranch')->create([
            'id' => 35,
            'user_id' => $user->id,
            'branch_id' => $firstBranch->id
        ]);


        factory('Modules\Users\Entities\UserHasBranch')->create([
            'id' => 36,
            'user_id' => $user->id,
            'branch_id' => $secondBranch->id
        ]);

        factory('Modules\Employees\Entities\Employee')->create([
            'id' => 6,
            'user_id' => $user->id,
            'role_id' => 1,
        ]);

    }
}
