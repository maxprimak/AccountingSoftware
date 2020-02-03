<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Login\Entities\Login;
use Modules\Warehouses\Entities\Warehouse;
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

       $company = factory('Modules\Companies\Entities\Company')->create([
            'name' => 'PhoneFactory',
            'currency_id' => 1,
            'address' => 'Wagramerstraße 94, Top 1A',
            'phone' => '+43 1 3694001',
        ]);

        Warranty::createDefaultForNewCompany($company->id);
        DiscountCode::createDefaultForNewCompany($company->id);

        $branch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'DZ',
            'company_id' => 1,
            'color' => '#F64272',
            'address' => 'Wagramerstraße 94, Top 1A',
            'phone' => '+43 1 3694001'
        ]);
        $this->store_warehouse($branch);

        $branch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'DZ Neu',
            'company_id' => 1,
            'color' => '#0a9901',
            'address' => 'Wagramerstraße 94, Top 1A',
            'phone' => '+43 1 3694001'
        ]);
        $this->store_warehouse($branch);

        $branch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'KG',
            'company_id' => 1,
            'color' => '#0970c7',
            'address' => 'Kirchengasse 1, Mariahilferstraße 50',
            'phone' => '+43 1 3694001'
        ]);
        $this->store_warehouse($branch);

        $branch = factory('Modules\Companies\Entities\Branch')->create([
            'name' => 'Huma',
            'company_id' => 1,
            'color' => '#ec9a5d',
            'address' => 'Landwehrstraße 6, Top 126A',
            'phone' => '+43 1 7670666'
        ]);
        $this->store_warehouse($branch);
    }
}
