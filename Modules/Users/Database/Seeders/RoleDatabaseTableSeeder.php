<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\Role;

class RoleDatabaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();

      $Founder = new Role();
      $Founder->name = "Founder";
      $Founder->save();

      $Head = new Role();
      $Head->name = "Head";
      $Head->save();

      $Tech = new Role();
      $Tech->name = "Tech";
      $Tech->save();

      $Sales_Manager = new Role();
      $Sales_Manager->name = "Sales Manager";
      $Sales_Manager->save();

      $Courier = new Role();
      $Courier->name = "Courier";
      $Courier->save();
        // $this->call("OthersTableSeeder");
    }
}
