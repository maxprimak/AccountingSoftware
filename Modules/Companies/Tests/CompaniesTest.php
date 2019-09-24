<?php

namespace Modules\Companies\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class CompaniesTest extends TestCase
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

    public function test_user_can_access_myCompany_page()
    {
      $response = $this->actingAs($this->login)->get(route('companies.index'));
      $response->assertStatus(200);
      $response->assertViewHas('company');
    }

    public function test_user_can_edit_company(){
      $response = $this->actingAs($this->login)->get(route('companies.index'));
      $request = [
          'name' => $this->faker->name,
          'address' => $this->faker->address,
          'phone' => $this->faker->phonenumber,
          'currency_id' => $this->currency->id
      ];

      $response = $this->actingAs($this->login)->json('POST',route('companies.update', ['company_id' => $this->company->id]),$request);
      $response->assertSuccessful();
    }

    // public function test_company_edit_validation_if_unique(){
    //   $new_company = $this->setUpCompany($this->currency);
    //   //PHONE UNIQUE
    //   $request = [
    //       'name' => $this->faker->name,
    //       'address' => $this->faker->address,
    //       'phone' => $new_company->phone,
    //       'currency_id' => $this->currency->id
    //   ];
    //   $response = $this->actingAs($this->login)->json('POST',route('companies.update', ['company_id' => $this->company->id]),$request);
    //   $response->assertStatus(422); // HIER SHOULD BE 422
    // }

    public static function tearDownAfterClass()
    {
    shell_exec('php artisan migrate:fresh --seed');
    print "\nMigration --seed was done\n";
    parent::tearDownAfterClass();
    }
}
