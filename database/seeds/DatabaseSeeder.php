<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Head'],
            ['name' => 'Sales Manager'],
            ['name' => 'Tech']
        ]);

        DB::table('logins')->insert([
            ['username' => 'person',
            'password' => bcrypt('123456789'),
            'email' => 'email@mail.com']
        ]);

        DB::table('people')->insert([
            ['name' => 'Max Mustermann',
            'phone' => '+43 333 44 55 712',
            'address' => 'Brigittaplatz 14, Vienna']
        ]);

    }
}
