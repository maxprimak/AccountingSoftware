<?php

namespace Modules\Customers\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Modules\Login\Entities\Login;
use Modules\Users\Entities\People;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;
use Modules\Companies\Entities\Currency;
use Modules\Companies\Entities\Branch;
use Modules\Companies\Entities\Company;
use Modules\Customers\Entities\CustomerType;
use Modules\Employees\Entities\Employee;
use Modules\Customers\Entities\Customer;
use Faker\Factory as Faker;

class SalesManagerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp(): void
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

        $this->type = factory(CustomerType::class)->create(['name' => $this->faker->name . str_random(10)]);

        $this->user = factory(User::class)->create([
            'login_id' => $this->login->id,
            'person_id' => $this->person->id,
            'company_id' => $this->company->id,
        ]);

        $user_has_branch = factory(UserHasBranch::class)->create([
            'user_id' => $this->user->id,
            'branch_id' => $this->branch->id,
        ]);

    }

    // public function tearDown(): void
    // {
    //     $head_login = Login::find(1);
    //     $this->actingAs($head_login)->delete('employees/'.$this->employee->id);
    // }

    public function test_tech_can_create_and_edit_customers()
    {
        $customer = [
            'name' => $this->faker->name,
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'customer_type_id' => $this->type->id,
            'branch_id' => [$this->branch->id],
            'user_id' => $this->user->id,
        ];
        //Create customer
        $response = $this->actingAs($this->login)->post('/customers', $customer);
        $response->assertJson(['message' => 'Successfully created!']);
        $response->assertSuccessful();

        $customer_id = Customer::where('email', $customer['email'])->first()->id;

        $customer_edit = [
            'id' => $customer_id,
            'name' => $this->faker->name,
            'email' => $this->faker->email . str_random(20),
            'phone' => $this->faker->phonenumber,
            'type_id' => $this->type->id,
            'branch_id' => [$this->branch->id],
        ];

        //Edit customer
        $response = $this->actingAs($this->login)->post('customers/'.$customer_edit['id'], $customer_edit);
        $response->assertJson(['message' => 'Successfully updated!']);
        $response->assertSuccessful();

        $this->actingAs($this->login)->delete('customers/' . $customer_id);
    }
}
