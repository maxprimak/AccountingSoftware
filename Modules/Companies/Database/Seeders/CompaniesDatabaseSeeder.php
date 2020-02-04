<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Login\Entities\Login;
use Modules\Warehouses\Entities\Warehouse;
use Modules\Companies\Entities\Address;
use Modules\Orders\Entities\Warranty;
use Modules\Orders\Entities\DiscountCode;

class CompaniesDatabaseSeeder extends Seeder
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

        factory('Modules\Companies\Entities\Currency')->create([
            'name' => 'Euro',
            'symbol' => 'EUR'
        ]);

        $country = factory('Modules\Companies\Entities\Country')->create();

        $city = factory('Modules\Companies\Entities\City')->create([
            'country_id' => $country->id
        ]);

        $address = new Address();
        $address->house_number = '22';
        $address->postcode = '1200';
        $address->street_name = 'Brigittaplatz';
        $address->city_id = 1;
        $address->save();

       $company = factory('Modules\Companies\Entities\Company')->create([
            'name' => 'PhoneFactory',
            'currency_id' => 1,
            'phone' => '+43 1 3694001',
            'tax' => 20,
            'address_id' => $address->id
        ]);

        Warranty::createDefaultForNewCompany($company->id);
        DiscountCode::createDefaultForNewCompany($company->id);

        $branch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'DZ',
            'company_id' => 1,
            'color' => '#F64272',
            'address_id' => Address::makeCopy($address)->id,
            'phone' => '+43 1 3694001'
        ]);
        $this->store_warehouse($branch);

        $branch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'DZ Neu',
            'company_id' => 1,
            'color' => '#0a9901',
            'address_id' => Address::makeCopy($address)->id,
            'phone' => '+43 1 3694001'
        ]);
        $this->store_warehouse($branch);

        $branch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'KG',
            'company_id' => 1,
            'color' => '#0970c7',
            'address_id' => Address::makeCopy($address)->id,
            'phone' => '+43 1 3694001'
        ]);
        $this->store_warehouse($branch);

        $branch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'Huma',
            'company_id' => 1,
            'color' => '#ec9a5d',
            'address_id' => Address::makeCopy($address)->id,
            'phone' => '+43 1 7670666'
        ]);
        $this->store_warehouse($branch);
    }
}
