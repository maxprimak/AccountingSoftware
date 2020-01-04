<?php

namespace Modules\Orders\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;

class DiscountCodeTest extends TestCase
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
     *
     * @return void
     */
     public function test_user_can_see_discount_codes_of_company()
     {
         $login = $this->makeNewLoginWithCompanyAndBranch();
         $login2 = $this->makeNewLoginWithCompanyAndBranch();

         Passport::actingAs($login);

         $response = $this->json('GET', route('discount_codes.index'))
             ->assertStatus(200);
     }

     public function test_user_can_store_discount_code()
     {
         $login = $this->makeNewLoginWithCompanyAndBranch();
         Passport::actingAs($login);
         $company = auth('api')->user()->getCompany();

         $name = "test";
         $percent_amount = 30;

         $request = [
           'name' => $name,
           'percent_amount' => $percent_amount,
         ];

         $response = $this->json('POST', route('discount_codes.store'), $request)->assertStatus(200);

         $response = $response->decodeResponseJson();
         $discount_codes = $response['discount_code'];
         //Check that DB has New Good
         $this->assertDatabaseHas('discount_codes', [
           'id' => $discount_codes['id'],
           'name' => $name,
           'percent_amount' => $percent_amount,
           'is_active' => 1,
           'company_id' => $company->id,
         ]);


     }
}
