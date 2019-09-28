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

class CustomersTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

     public function setUp() : void
     {
         parent::setUp();

        $this->faker = Faker::create();

        $this->login = factory(Login::class)->create([
             'username' => $this->faker->username . str_random(10),
             'password' => Hash::make('123456789'),
             'email' => $this->faker->email,
         ]);

        $this->person = factory(People::class)->create();

        $this->currency = factory(Currency::class)->create(['name' => $this->faker->currencyCode . str_random(10), 'symbol' => $this->faker->countryCode . str_random(10)]);

        $this->company = factory(Company::class)->create(['name'=> $this->faker->name . str_random(10),'currency_id' => $this->currency->id]);

        $this->branch = factory(Branch::class)->create(['name' => $this->faker->name . str_random(10),'company_id' => $this->company->id]);

        $this->user = factory(User::class)->create([
             'login_id' => $this->login->id,
             'person_id' => $this->person->id,
             'company_id' => $this->company->id,
         ]);

         $this->user_has_branch = factory(UserHasBranch::class)->create([
             'user_id' => $this->user->id,
             'branch_id' => $this->branch->id,
         ]);

         $this->type = factory(CustomerType::class)->create(['name' => $this->faker->name . str_random(10)]);

         $this->customer = factory(Customer::class)->create([
             'person_id' => $this->person->id,
             'email' => $this->faker->email  . str_random(20),
             'type_id' => $this->type->id,
             'company_id' => $this->company->id,
             'created_by' => $this->user->id
         ]);

         $this->customer_has_branch = factory(CustomerHasBranch::class)->create([
             'customer_id' => $this->customer,
             'branch_id' => $this->branch->id,
         ]);

     }

     // public function tearDown(): void
     // {
     //
     // }

     //TEST DELETE

     public function test_user_can_delete_customers()
     {
        //FIRST WE NEED TO CREATE THIS USER DO DELETE HIM
         $customer = [
             'name' => $this->faker->name,
             'email' => $this->faker->email  . str_random(20),
             'phone' => $this->faker->phonenumber,
             'customer_type_id' => $this->type->id,
             'branch_id' => [$this->branch->id],
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

        $response = $this->actingAs($this->login)->json('POST',route('set.stars.number',['customer_id' => $this->customer->id]),$request);
        // $response->assertJson(['message' => 'The stars number may not be greater than 5.']);
        $response->assertStatus(422);
     }

     public function test_user_can_not_set_stars_smaller_than_1()
     {

       //HERE WE NEED TO CREATE REQUEST
        $request = [
            'stars_number' => $this->faker->numberBetween(-2000,0)
        ];

        $response = $this->actingAs($this->login)->json('POST',route('set.stars.number',['customer_id' => $this->customer->id]),$request);
        // $response->assertJson(['message' => 'The stars number must be at least 1.']);
        $response->assertStatus(422);
     }

     //TEST VALIDATION OF CUSTOMER

     public function test_customers_validation_if_unique()
     {


        // TEST UNIQUE EMAIL
        $test_customer = [
            'name' => $this->faker->name,
            'email' => $this->customer->email,
            'phone' => $this->faker->phonenumber,
            'customer_type_id' => $this->type->id,
            'branch_id' => [$this->branch->id],
            'user_id' => $this->user->id,
        ];
        $response = $this->actingAs($this->login)->json('POST','/customers', $test_customer);
        // $response->assertJson(['message' => 'The email has already been taken.']);
        $response->assertStatus(422);

        // TEST UNIQUE PHONE
         $test_customer = [
             'name' => $this->faker->name,
             'email' => $this->faker->email  . str_random(20),
             'phone' => $this->person->phone,
             'customer_type_id' => $this->type->id,
             'branch_id' => [$this->branch->id],
             'user_id' => $this->user->id,
         ];
         $response = $this->actingAs($this->login)->json('POST','/customers', $test_customer);
         $response->assertStatus(422);

     }

     public function test_customers_validation_if_required()
     {

        // TEST required user_id
        $test_customer = [
            'name' => $this->faker->name,
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'customer_type_id' => '1',
            'branch_id' => ['1'],
            'user_id' => null,
        ];

        $this->checkValidationIfRequired($test_customer,$this->login,'customers.store');

     }

     //test_new_customer_added_to_branch

     public static function tearDownAfterClass()
     {
     shell_exec('php artisan migrate:fresh --seed');
     print "\nMigration was done\n";
     parent::tearDownAfterClass();
     }

     //test_validation_stops_request_if_branch_id_is_not_an_array
}
