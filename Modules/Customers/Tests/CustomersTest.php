<?php

namespace Modules\Customers\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Users\Entities\User;
use Modules\Login\Entities\Login;
use Modules\Users\Entities\UserHasBranch;
use Modules\Users\Entities\People;
use Modules\Companies\Entities\Company;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Entities\CustomerHasBranch;

use Modules\Registration\Tests\RegisterTest;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Artisan;

class CustomersTest extends TestCase
{
    use WithFaker;

    /**
     * A basic test example.
     *
     * @return void
     */

     public function setUp(): void
     {
         parent::setUp();

         $this->faker = Faker::create();

         $this->login = Login::find(2);

         $this->user = User::where('login_id',$this->login->id)->firstOrFail();

         $this->person = factory(People::class)->create();

         $this->customer = factory(Customer::class)->create([
             'person_id' => $this->person->id,
             'email' => $this->faker->email  . str_random(20),
             'type_id' => '1',
             'company_id' => '2',
             'created_by' => $this->user->id
         ]);

         $customer_has_branch = factory(CustomerHasBranch::class)->create([
             'customer_id' => $this->customer,
             'branch_id' => '9',
         ]);

     }

     // public function tearDown(): void
     // {
     //     $this->delete('employees/'.$this->employee->id);
     // }

     //TEST DELETE

     public function test_user_can_delete_customers()
     {
        //FIRST WE NEED TO CREATE THIS USER DO DELETE HIM
         $customer = [
             'name' => $this->faker->name,
             'email' => $this->faker->email  . str_random(20),
             'phone' => $this->faker->phonenumber,
             'customer_type_id' => '1',
             'branch_id' => ['1'],
             'user_id' => $this->user->id,
         ];
         $response = $this->actingAs($this->login)->post('/customers', $customer);
         $response->assertJson(['message' => 'Successfully created!']);
         $response->assertSuccessful();

         //THEN WE NEED TO FIND HIM
         $customer_id = Customer::where('email', $customer['email'])->first()->id;

          //THEN WE ARE DELETING HIM
         $response = $this->actingAs($this->login)->delete('customers/'.$customer_id);
         $response->assertJson(['message' => 'Successfully deleted!']);
         $response->assertSuccessful();
     }

     //TEST STARS

     public function test_user_can_edit_stars_of_customer()
     {

        //HERE WE NEED TO CREATE REQUEST
         $request = [
             'stars_number' => $this->faker->numberBetween(1,5)
         ];

         $response = $this->actingAs($this->login)->post(route('set.stars.number',['customer_id' => $this->customer->id]),$request);
         $response->assertJson(['message' => 'Successfully updated!']);
         $response->assertSuccessful();
     }

     public function test_user_can_not_set_stars_greater_than_5()
     {

       //HERE WE NEED TO CREATE REQUEST
        $request = [
            'stars_number' => $this->faker->numberBetween(6,10000)
        ];

        $response = $this->actingAs($this->login)->post(route('set.stars.number',['customer_id' => $this->customer->id]),$request);
        $response->assertJson(['message' => 'The stars number may not be greater than 5.']);
        $response->assertStatus(200);
     }

     public function test_user_can_not_set_stars_smaller_than_1()
     {

       //HERE WE NEED TO CREATE REQUEST
        $request = [
            'stars_number' => $this->faker->numberBetween(-2000,0)
        ];

        $response = $this->actingAs($this->login)->post(route('set.stars.number',['customer_id' => $this->customer->id]),$request);
        $response->assertJson(['message' => 'The stars number must be at least 1.']);
        $response->assertStatus(200);
     }

     //TEST VALIDATION OF CUSTOMER

     public function test_customers_validation_if_unique()
     {


        // TEST UNIQUE EMAIL
        $test_customer = [
            'name' => $this->faker->name,
            'email' => $this->customer->email,
            'phone' => $this->faker->phonenumber,
            'customer_type_id' => '1',
            'branch_id' => ['1'],
            'user_id' => $this->user->id,
        ];
        $response = $this->actingAs($this->login)->post('/customers', $test_customer);
        $response->assertJson(['message' => 'The email has already been taken.']);
        $response->assertSuccessful();

        // TEST UNIQUE PHONE
         $test_customer = [
             'name' => $this->faker->name,
             'email' => $this->faker->email  . str_random(20),
             'phone' => $this->person->phone,
             'customer_type_id' => '1',
             'branch_id' => ['1'],
             'user_id' => $this->user->id,
         ];
         $response = $this->actingAs($this->login)->post('/customers', $test_customer);
         $response->assertJson(['message' => 'The phone has already been taken.']);
         $response->assertSuccessful();

     }

     public function test_customers_validation_if_required()
     {
     //
     //
     //    // TEST required NAME
     //    $test_customer = [
     //        'name' => null,
     //        'email' => $this->faker->email  . str_random(20),
     //        'phone' => $this->faker->phonenumber,
     //        'customer_type_id' => '1',
     //        'branch_id' => ['1'],
     //        'user_id' => $this->user->id,
     //    ];
     //    $response = $this->actingAs($this->login)->post('/customers', $test_customer);
     //    $response->assertJson(['message' => 'The name field is required.']);
     //    $response->assertSuccessful();
     //
     //
     //    // TEST required EMAIL
     //    $test_customer = [
     //        'name' => $this->faker->name,
     //        'email' => null,
     //        'phone' => $this->faker->phonenumber,
     //        'customer_type_id' => '1',
     //        'branch_id' => ['1'],
     //        'user_id' => $this->user->id,
     //    ];
     //    $response = $this->actingAs($this->login)->post('/customers', $test_customer);
     //    $response->assertJson(['message' => 'The email field is required.']);
     //    $response->assertSuccessful();
     //
     //
     //    // TEST required PHONE
     //    $test_customer = [
     //        'name' => $this->faker->name,
     //        'email' => $this->faker->email  . str_random(20),
     //        'phone' => null,
     //        'customer_type_id' => '1',
     //        'branch_id' => ['1'],
     //        'user_id' => $this->user->id,
     //    ];
     //    $response = $this->actingAs($this->login)->post('/customers', $test_customer);
     //    $response->assertJson(['message' => 'The phone field is required.']);
     //    $response->assertSuccessful();
     //
     //
     //    // TEST required customer_type_id
     //    $test_customer = [
     //        'name' => $this->faker->name,
     //        'email' => $this->faker->email  . str_random(20),
     //        'phone' => $this->faker->phonenumber,
     //        'customer_type_id' => null,
     //        'branch_id' => ['1'],
     //        'user_id' => $this->user->id,
     //    ];
     //    $response = $this->actingAs($this->login)->post('/customers', $test_customer);
     //    $response->assertJson(['message' => 'The customer type id field is required.']);
     //    $response->assertSuccessful();
     //
     //
     //    // TEST required branch_id
     //    $test_customer = [
     //        'name' => $this->faker->name,
     //        'email' => $this->faker->email  . str_random(20),
     //        'phone' => $this->faker->phonenumber,
     //        'customer_type_id' => '1',
     //        'branch_id' => null,
     //        'user_id' => $this->user->id,
     //    ];
     //    $response = $this->actingAs($this->login)->post('/customers', $test_customer);
     //    $response->assertJson(['message' => 'The branch id field is required.']);
     //    $response->assertSuccessful();
     //

        // TEST required user_id
        $test_customer = [
            'name' => $this->faker->name,
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'customer_type_id' => '1',
            'branch_id' => ['1'],
            'user_id' => null,
        ];
        // $response = $this->actingAs($this->login)->post('/customers', $test_customer);
        // $response->assertJson(['message' => 'The user id field is required.']);
        // $response->assertSuccessful();

        $this->checkValidationIfRequired($test_customer,$this->login);

     }


}
