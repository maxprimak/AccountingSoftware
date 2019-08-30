<?php

use Illuminate\Database\Seeder;
use Modules\Login\Database\Seeders\LoginDatabaseSeeder;
use Modules\Users\Database\Seeders\UsersDatabaseSeeder;
use Modules\Companies\Database\Seeders\CompaniesDatabaseSeeder;
use Modules\Employees\Database\Seeders\RolesDatabaseSeeder;
use Modules\Employees\Database\Seeders\EmployeesDatabaseSeeder;
use Modules\Customers\Database\Seeders\CustomersDatabaseSeeder;
use Modules\Customers\Database\Seeders\CustomerTypesTableSeeder;

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
        $this->call(CustomersDatabaseSeeder::class);
    }
}
