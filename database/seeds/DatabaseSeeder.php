<?php

use Illuminate\Database\Seeder;
use Modules\Login\Database\Seeders\LoginDatabaseSeeder;
use Modules\Users\Database\Seeders\UsersDatabaseSeeder;
use Modules\Companies\Database\Seeders\CompaniesDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LoginDatabaseSeeder::class);
        $this->call(CompaniesDatabaseSeeder::class);
        $this->call(UsersDatabaseSeeder::class);
    }
}
