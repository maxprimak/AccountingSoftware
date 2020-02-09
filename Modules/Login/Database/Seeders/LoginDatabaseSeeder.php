<?php

namespace Modules\Login\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LoginDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory('Modules\Login\Entities\Login')->create([
            'username' => 'me@phonefactory.at',
            'password' => bcrypt('123456789'),
            'email' => 'me@phonefactory.at',
        ]);
    }
}
