<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\Users;

class UserDatabaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = new Users();
        $user->login_id = "1";
        $user->person_id = "1";
        $user->role_id = "1";
        $user->branch_id = "1";
        $user->save();
    }
}
