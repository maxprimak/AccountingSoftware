<?php

namespace Modules\Customers\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Entities\User;
use Modules\Login\Entities\Login;
use Modules\Users\Entities\UserHasBranch;
use Modules\Users\Entities\People;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Currency;
use Modules\Companies\Entities\Branch;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Entities\CustomerType;
use Modules\Customers\Entities\CustomerHasBranch;
use Modules\Registration\Tests\RegisterTest;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;

class CustomersTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    private $login;
    private $branch;
    private $customer;

     public function setUp() : void
     {
        parent::setUp();
        TestCase::setUpEnvironment();

        $this->login = $this->makeNewLoginWithCompanyAndBranch();
        $this->branch = $this->getBranchesOfLogin($this->login)->first();

        $this->addCustomersToBranch($this->branch, $this->login, 1, 1);
        $this->customer = $this->getCustomersOfLogin($this->login)->first();

     }

     //TEST DELETE

     public function test_user_can_delete_customers()
     {
        //FIRST WE NEED TO CREATE THIS USER DO DELETE HIM
         $customer = [
             'name' => $this->faker->name,
             'email' => $this->faker->email  . str_random(20),
             'phone' => $this->faker->phonenumber,
             'customer_type_id' => $this->faker->numberBetween(1,2),
             'branch_id' => array($this->branch->id),
             'user_id' => $this->getUserOfLogin($this->login)->id,
         ];

         Passport::actingAs($this->login);

         $response = $this->json('POST', route('customers.store'), $customer);
         $response->assertJsonStructure(['message', 'customer']);
         $response->assertSuccessful();

         //THEN WE NEED TO FIND HIM
         $customer_id = Customer::where('email', $customer['email'])->first()->id;

          //THEN WE ARE DELETING HIM
         $response = $this->json('DELETE', route('customers.destroy', ['customer_id' => $customer_id]));
         $response->assertJson(['message' => 'Successfully deleted!']);
         $response->assertSuccessful();
     }

     //TEST STARS
     public function test_user_can_edit_stars_of_customer()
     {

        $this->customer->stars_number = 1;
        $this->customer->save();

        //HERE WE NEED TO CREATE REQUEST
         $request = [
             'stars_number' => 5
         ];

         Passport::actingAs($this->login);

         $response = $this->json('POST', route('set.stars.number',['customer_id' => $this->customer->id]),$request);
         $response->assertJson(['message' => 'Successfully updated!']);
         $response->assertSuccessful();

         $this->assertDatabaseHas('customers', ['stars_number' => 5]);

         $this->customer = Customer::find($this->customer->id);

         $this->assertEquals(5, $this->customer->stars_number);

     }


     public function test_user_can_not_set_stars_greater_than_5()
     {

       //HERE WE NEED TO CREATE REQUEST
        $request = [
            'stars_number' => $this->faker->numberBetween(6,10000)
        ];

        Passport::actingAs($this->login);

        $response = $this->json('POST',route('set.stars.number',['customer_id' => $this->customer->id]),$request);
        $response->assertJsonStructure(['message', 'errors']);
        $response->assertStatus(422);
     }

     public function test_user_can_not_set_stars_smaller_than_1()
     {

       //HERE WE NEED TO CREATE REQUEST
        $request = [
            'stars_number' => $this->faker->numberBetween(-2000,0)
        ];

        Passport::actingAs($this->login);

        $response = $this->json('POST',route('set.stars.number',['customer_id' => $this->customer->id]),$request);
        $response->assertJsonStructure(['message', 'errors']);
        $response->assertStatus(422);
     }

     //TEST VALIDATION OF CUSTOMER
     public function test_customers_validation_if_unique()
     {  
        Passport::actingAs($this->login);

        $not_unique_data = [
            'email' => $this->customer->email,
            'phone' => $this->customer->phone
        ];

        $required_data = [
            'name' => $this->faker->name, 
            'email' => $this->faker->email, 
            'phone' => $this->faker->phoneNumber, 
            'customer_type_id' => 1, 
            'branch_id' => $this->branch->id, 
            'user_id' => $this->getUserOfLogin($this->login)->id
        ];

        $route = route('customers.index');
        $response = $this;

        $this->checkValidationUnique($not_unique_data, $required_data, $route, $response);

     }

     public function test_customers_validation_if_required()
     {  

        // TEST required user_id
        $test_customer = [
            'name' => $this->faker->name,
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'customer_type_id' => 1,
            'branch_id' => array($this->branch->id),
            'user_id' => $this->getUserOfLogin($this->login)->id,
        ];

        $route = route('customers.index');
        $response = $this;

        $this->checkValidationRequired($test_customer, $route, $response);

     }

     //test_new_customer_added_to_branch
     //test_validation_stops_request_if_branch_id_is_not_an_array

}
