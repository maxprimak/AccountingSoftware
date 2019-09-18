<?php

namespace Modules\Employees\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('roles')->insert([
            [
                'name' => 'Head',
            ],
            [
                'name' => 'Top Manager',
            ],
            [
                'name' => 'Tech',
            ],
            [
                'name' => 'Sales Manager',
            ],
            [
                'name' => 'Courier',
            ]
        ]);
    }
}
