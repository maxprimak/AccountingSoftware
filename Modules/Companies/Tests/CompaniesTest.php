<?php

namespace Modules\Companies\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Companies\Entities\Company;
use Modules\Users\Entities\User;

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

      $response = $this->makeResponseWithNewAuthRegisteredLogin();

      $response->json('GET', route('companies.index'))->assertStatus(200);
      
    }

    public function test_user_can_edit_his_company(){

      $login = $this->makeNewLoginWithCompanyAndBranch();
      $response = $this->getAuthorizedResponseAs($login);
      $company = $this->getCompanyOfLogin($login);

      $response->json('POST', route('companies.update', ['company_id' => $company->id]), [
          'name' => $this->faker->name,
          'address' => $this->faker->address,
          'phone' => $this->faker->phonenumber,
          'currency_id' => 1
      ])->assertStatus(200);

    }

    /*
    ////NEEDS FIX!!!
    public function test_company_edit_validation_if_unique(){
      
      $login = factory('Modules\Login\Entities\Login')->create([
        'username' => $this->faker->firstName()
      ]);

      $tokenResult = $login->createToken('Personal Access Token');

      $response = $this->withHeaders([
        'Authorization' => 'Bearer '.$tokenResult->accessToken
      ]);

      $response->json('POST', route('registration.store'),[
        'company_name' => $this->faker->name(),
        'company_phone' => $this->faker->phoneNumber(),
        'company_address' => $this->faker->address(),
        'currency_id' => 1,
        'name' => $this->faker->name(),
        'phone' => $this->faker->phoneNumber(),
        'address' => $this->faker->address()
      ])->assertStatus(200);
      $response = $this->getAuthorizedResponseAs($login);
      $company = $this->getCompanyOfLogin($login);

      $not_unique_data = [
        'name' => $company->name
      ];

      $required_data = [
        'currency_id' => 1,
        'name' => $this->faker->name,
        'address' => $this->faker->address,
        'phone' => $this->faker->phoneNumber
      ];

      $this->logOutAs($login, $response);

      $new_login = factory('Modules\Login\Entities\Login')->create([
        'username' => $this->faker->firstName()
      ]);

      $tokenResult_new = $new_login->createToken('Personal Access Token');
      
      $new_response = $this->withHeaders([
        'Authorization' => 'Bearer '.$tokenResult_new->accessToken
      ]);

      $response->json('POST', route('registration.store'),[
        'company_name' => $this->faker->name(),
        'company_phone' => $this->faker->phoneNumber(),
        'company_address' => $this->faker->address(),
        'currency_id' => 1,
        'name' => $this->faker->name(),
        'phone' => $this->faker->phoneNumber(),
        'address' => $this->faker->address()
      ])->dump();

      //$response = $this->getAuthorizedResponseAs($login);
      //$company = $this->getCompanyOfLogin($login);

      //$this->checkValidationUnique($not_unique_data, $required_data, route('companies.update', ['company_id' => $company->id]), $response);

    }
    */

}
