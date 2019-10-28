<?php

use Illuminate\Database\Seeder;
use Modules\Login\Database\Seeders\LoginDatabaseSeeder;
use Modules\Users\Database\Seeders\UsersDatabaseSeeder;
use Modules\Companies\Database\Seeders\CompaniesDatabaseSeeder;
use Modules\Employees\Database\Seeders\RolesDatabaseSeeder;
use Modules\Employees\Database\Seeders\EmployeesDatabaseSeeder;
use Modules\Customers\Database\Seeders\CustomersDatabaseSeeder;
use Modules\Customers\Database\Seeders\CustomerTypesTableSeeder;
use Modules\Goods\Database\Seeders\CategoriesSeederTableSeeder;
use Modules\Goods\Database\Seeders\BrandsSeederTableSeeder;
use Modules\Goods\Database\Seeders\ModelsSeederTableSeeder;
use Modules\Goods\Database\Seeders\SubmodelSeederTableSeeder;
use Modules\Goods\Database\Seeders\PartSeederTableSeeder;
use Modules\Goods\Database\Seeders\ColorSeederTableSeeder;
use Modules\Goods\Database\Seeders\GoodsDatabaseSeeder;
use Modules\Orders\Database\Seeders\RepairOrdersTableSeeder;
use Modules\Orders\Database\Seeders\SalesOrdersTableSeeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompaniesDatabaseSeeder::class);
        $this->call(LoginDatabaseSeeder::class);
        $this->call(UsersDatabaseSeeder::class);
        $this->call(RolesDatabaseSeeder::class);
        $this->call(EmployeesDatabaseSeeder::class);
        $this->call(CustomerTypesTableSeeder::class);
        //$this->call(CustomersDatabaseSeeder::class);
        //$this->call(CategoriesSeederTableSeeder::class);
        $this->call(BrandsSeederTableSeeder::class);
        $this->call(ModelsSeederTableSeeder::class);
        $this->call(SubmodelSeederTableSeeder::class);
        $this->call(PartSeederTableSeeder::class);
        $this->call(ColorSeederTableSeeder::class);
        $this->call(GoodsDatabaseSeeder::class);
        $this->call(RepairOrdersTableSeeder::class);
        //$this->call(SalesOrdersTableSeeder::class);

    }
}
