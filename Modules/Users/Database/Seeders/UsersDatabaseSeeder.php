<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DOES NOT WORK!!!!!!!!
        DB::table('roles')->insert([
            ['name' => 'Head'],
            ['name' => 'Sales Manager'],
            ['name' => 'Tech']
        ]);
    }
}
