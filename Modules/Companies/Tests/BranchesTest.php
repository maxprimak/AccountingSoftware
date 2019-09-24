<?php

namespace Modules\Companies\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class BranchesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp() : void
    {
        parent::setUp();
        $this->login = $this->setUpLogin();
        $this->person = $this->setUpPerson();
        $this->currency = $this->setUpCurrency();
        $this->company = $this->setUpCompany($this->currency);
        $this->branch = $this->setUpBranch($this->company);
        $this->user = $this->setUpUser($this->login,$this->person,$this->company);
        $this->user_has_branch = $this->setUpUserHasBranch($this->user,$this->branch);
    }

    public function test_user_can_access_newBranch_page()
    {
      $response = $this->actingAs($this->login)->get(route('branches.create'));
      $response->assertStatus(200);
    }

    public function test_user_can_create_new_branch(){
      //ONLY WITH BRANCH NAME + COLOR
      $response = $this->actingAs($this->login)->get(route('branches.create'));
      $request = [
          'name' => $this->faker->unique()->name(),
          'color' => '#F64272'
      ];
      $response = $this->actingAs($this->login)->json('POST',route('branches.store'),$request);
      $response->assertSuccessful();

      //ONLY WITH BRANCH NAME + Branch address + COLOR

      $request = [
          'name' => $this->faker->name,
          'address' => $this->faker->address,
          'color' => '#F64272'
      ];

      $response = $this->actingAs($this->login)->json('POST',route('branches.store'),$request);
      $response->assertSuccessful();

      //WITH ALL FIELDS

      $request = [
          'name' => $this->faker->name,
          'address' => $this->faker->address,
          'phone' => $this->faker->phonenumber,
          'color' => '#F64272'
      ];

      $response = $this->actingAs($this->login)->json('POST',route('branches.store'),$request);
      $response->assertSuccessful();

    }

    public function test_user_can_edit_branch(){
      //FIRST WE GO TO COMPANY PAGE
      $response = $this->actingAs($this->login)->get(route('companies.index'));
      $response->assertStatus(200);

      //THEN WE EDIT A BRANCH (ALL FIELDS)
      $request = [
          'name' => $this->faker->name,
          'address' => $this->faker->address,
          'phone' => $this->faker->phonenumber,
          'color' => '#F64272'
      ];

      $response = $this->actingAs($this->login)->json('POST',route('branches.update', ['branch_id' => $this->branch->id]),$request);
      $response->assertStatus(200);

      //EDIT A BRANCH (ONLY NAME)
      $request = [
          'name' => $this->faker->name,
          'color' => '#F64272'
      ];

      $response = $this->actingAs($this->login)->json('POST',route('branches.update', ['branch_id' => $this->branch->id]),$request);
      $response->assertStatus(200);
    }

    public function test_user_can_delete_branch(){
      //FIRST WE GO TO COMPANY PAGE
      $response = $this->actingAs($this->login)->get(route('companies.index'));
      $response->assertStatus(200);

      $new_branch = $this->setUpBranch($this->company);

      $response = $this->actingAs($this->login)->json('delete',route('branches.destroy', ['branch_id' => $new_branch->id]));
      $response->assertStatus(200);
    }

    //user can delete branch only if there are no Employees in this branch

    //user can delete branch only if there are no Customers in this branch

    //user can not delete first branch in his company

    public static function tearDownAfterClass()
    {
    shell_exec('php artisan migrate:fresh --seed');
    print "\nMigration --seed was done\n";
    parent::tearDownAfterClass();
    }
}
