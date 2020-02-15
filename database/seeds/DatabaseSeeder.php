<?php

use Illuminate\Database\Seeder;
use Modules\Companies\Database\Seeders\AddGermanAndRussianTableSeeder;
use Modules\Login\Database\Seeders\LoginDatabaseSeeder;
use Modules\Users\Database\Seeders\UsersDatabaseSeeder;
use Modules\Companies\Database\Seeders\CompaniesDatabaseSeeder;
use Modules\Companies\Database\Seeders\CompaniesNewTableSeeder;
use Modules\Employees\Database\Seeders\RolesDatabaseSeeder;
use Modules\Employees\Database\Seeders\EmployeesDatabaseSeeder;
use Modules\Customers\Database\Seeders\OldCustomersDatabaseSeeder;
use Modules\Goods\Database\Seeders\OldGoodsTableSeeder;
use Modules\Customers\Database\Seeders\CustomerTypesTableSeeder;
use Modules\Documents\Database\Seeders\AddReceiptMainTextForEveryExistingBranchTableSeeder;
use Modules\Goods\Database\Seeders\CategoriesSeederTableSeeder;
use Modules\Goods\Database\Seeders\BrandsSeederTableSeeder;
use Modules\Goods\Database\Seeders\ModelsSeederTableSeeder;
use Modules\Goods\Database\Seeders\SubmodelSeederTableSeeder;
use Modules\Goods\Database\Seeders\PartSeederTableSeeder;
use Modules\Goods\Database\Seeders\ColorSeederTableSeeder;
use Modules\Goods\Database\Seeders\GoodsDatabaseSeeder;
use Modules\Orders\Database\Seeders\RepairOrdersTableSeeder;
use Modules\Orders\Database\Seeders\SalesOrdersTableSeeder;
use Modules\Orders\Database\Seeders\OrderTypesSeederTableSeeder;
use Modules\Orders\Database\Seeders\PaymentStatusesTableSeeder;
use Modules\Orders\Database\Seeders\OrderStatusesTableSeeder;
use Modules\Orders\Database\Seeders\OldOrdersTableSeeder;
use Modules\Services\Database\Seeders\LanguagesTableSeeder;
use Modules\Services\Database\Seeders\ModelFixTableSeeder;





class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguagesTableSeeder::class);
        $this->call(CompaniesDatabaseSeeder::class);
        $this->call(LoginDatabaseSeeder::class);
        $this->call(UsersDatabaseSeeder::class);
        $this->call(RolesDatabaseSeeder::class);
        $this->call(EmployeesDatabaseSeeder::class);
        $this->call(CustomerTypesTableSeeder::class);
        $this->call(CompaniesNewTableSeeder::class);
        //$this->call(OldCustomersDatabaseSeeder::class);
        //$this->call(CategoriesSeederTableSeeder::class);
        $this->call(BrandsSeederTableSeeder::class);
        $this->call(ModelsSeederTableSeeder::class);
        $this->call(SubmodelSeederTableSeeder::class);
        $this->call(PartSeederTableSeeder::class);
        $this->call(ColorSeederTableSeeder::class);
        //$this->call(OldGoodsTableSeeder::class);
        $this->call(GoodsDatabaseSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(RepairOrdersTableSeeder::class);
        $this->call(PaymentStatusesTableSeeder::class);
        $this->call(OrderTypesSeederTableSeeder::class);
        //$this->call(OldOrdersTableSeeder::class);
        //$this->call(SalesOrdersTableSeeder::class);
        $this->call(ModelFixTableSeeder::class);
        
        //NEW
        $this->call(AddGermanAndRussianTableSeeder::class);
        $this->call(AddReceiptMainTextForEveryExistingBranchTableSeeder::class);
    }
}
