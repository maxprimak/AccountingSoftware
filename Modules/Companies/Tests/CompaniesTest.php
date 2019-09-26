<?php

namespace Modules\Companies\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Companies\Entities\Company;
use Modules\Users\Entities\User;
use Laravel\Passport\Passport;

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
        TestCase::setUpEnvironment();

    }

    public function test_user_can_get_his_company(){

      $login = $this->makeNewLoginWithCompanyAndBranch();
      Passport::actingAs($login);

      $response = $this->json('GET', route('companies.index'));
      $response->assertStatus(200);
      
    }

    public function test_user_can_edit_his_company(){

      $login = $this->makeNewLoginWithCompanyAndBranch();
      $company = $this->getCompanyOfLogin($login);
      Passport::actingAs($login);

      $response = $this->json('POST', route('companies.update', ['company_id' => $company->id]), [
          'name' => $this->faker->name,
          'address' => $this->faker->address,
          'phone' => $this->faker->phonenumber,
          'currency_id' => 1
      ]);
      $response->assertStatus(200);

    }

    public function test_company_edit_validation_if_unique(){

      $login = $this->makeNewLoginWithCompanyAndBranch();
      $company = $this->getCompanyOfLogin($login);
      Passport::actingAs($login);

      $logged_in_user = $this->json('GET', route('user'))->assertStatus(200);
    
      $not_unique_data = [
        'name' => $company->name
      ];
      $required_data = [
        'currency_id' => 1,
        'name' => $this->faker->name,
        'address' => $this->faker->address,
        'phone' => $this->faker->phoneNumber
      ];

      $login = $this->makeNewLoginWithCompanyAndBranch();
      $company = $this->getCompanyOfLogin($login);
      Passport::actingAs($login);

      $new_logged_in_user = $this->json('GET', route('user'))->assertStatus(200);

      $this->assertNotEquals($logged_in_user, $new_logged_in_user);

      $this->checkValidationUnique($not_unique_data, $required_data, route('companies.update', ['company_id' => $company->id]), $this);

    }

}
