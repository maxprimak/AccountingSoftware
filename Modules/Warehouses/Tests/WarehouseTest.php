<?php

namespace Modules\Warehouses\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Warehouses\Entities\Warehouse;
use Laravel\Passport\Passport;

class WarehouseTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();
        $this->login = $this->makeNewLoginWithCompanyAndBranch();
        $this->branch = $this->getBranchesOfLogin($this->login)->first();

    }

    public function test_user_can_create_warehouse()
    {
      Passport::actingAs($this->login);
      $name = $this->faker->name();

      $request = [
        'name' => $name,
        'branch_id' => $this->branch->id,
      ];

      $response = $this->json('POST', route('warehouse.store'), $request)->assertStatus(200);

      $response = $this->assertDatabaseHas('warehouses', [
        'name' => $name,
        'branch_id' => $this->branch->id
      ]);

      return $request;
    }

    public function test_user_can_update_warehouse()
    {
      Passport::actingAs($this->login);
      //CREATE NEW BRANCH
      $request = $this->test_user_can_create_warehouse();
      //UPDATE NEW BRANCH
      $warehouse = Warehouse::where('name',$request['name'])->where('branch_id',$request['branch_id'])->first();
      $new_name = $this->faker->unique()->name();
      $response = $this->json('POST', route('warehouse.update', ['warehouse_id' => $warehouse->id]), [
          'name' => $new_name,
      ])->assertStatus(200);

      $response = $this->assertDatabaseHas('warehouses', [
        'name' => $new_name,
        'branch_id' => $request['branch_id']
      ]);
    }
}
