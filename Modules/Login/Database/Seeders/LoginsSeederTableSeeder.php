<?php

namespace Modules\Login\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Login\Entities\Login;

class LoginsSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $Maxim = new Login();
        $Maxim->username = "Login Loginovich";
        $Maxim->password = 'Prechtlgasse 9';
        $Maxim->email = 'mail@mail.com';
        $Maxim->save();
    }
}
