<?php

namespace Modules\Orders\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;

class WarrantyTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;

    public function setUp() : void
    {
       parent::setUp();
       TestCase::setUpEnvironment();

       $this->login = $this->makeNewLoginWithCompanyAndBranch();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_see_warranties_of_company()
    {
        $login = $this->makeNewLoginWithCompanyAndBranch();
        $login2 = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $response = $this->json('GET', route('warranties.index'))
            ->assertStatus(200);
    }

    public function test_user_can_store_warranty()
    {
        $login = $this->makeNewLoginWithCompanyAndBranch();
        $login2 = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);
        $company = auth('api')->user()->getCompany();

        $name = "repair";
        $days_number = 30;
        $is_active = 1;
        $is_default = 1;

        $request = [
          'name' => $name,
          'days_number' => $days_number,
          'is_active' => $is_active,
          'company_id' => $company->id,
          'is_default' => $is_default,
        ];

        $response = $this->json('POST', route('warranties.store'), $request)->assertStatus(200);

        $response = $response->decodeResponseJson();
        $warranty = $response['warranty'];
        //Check that DB has New Good
        $this->assertDatabaseHas('warranties', [
          'id' => $warranty['id'],
          'name' => $name,
          'days_number' => $days_number,
          'is_active' => $is_active,
          'company_id' => $company->id,
          'is_default' => $is_default,
        ]);


    }
}
