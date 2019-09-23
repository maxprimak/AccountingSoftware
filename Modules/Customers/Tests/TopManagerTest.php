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
use Modules\Employees\Entities\Employee;
use Modules\Customers\Entities\Customer;
use Faker\Factory as Faker;

class TopManagerTest extends TestCase
{
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

        $this->user = factory(User::class)->create([
            'login_id' => $this->login->id,
            'person_id' => $this->person->id,
            'company_id' => '1',
        ]);

        $user_has_branch = factory(UserHasBranch::class)->create([
            'user_id' => $this->user->id,
            'branch_id' => '1',
        ]);

        $this->employee = factory(Employee::class)->create([
            'user_id' => $this->user->id,
            'role_id' => '2'  //role top manager
        ]);

    }

    public function tearDown(): void
    {
        $this->delete('employees/'.$this->employee->id);
    }

    public function test_top_manager_can_create_customers()
    {
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

        $customer_id = Customer::where('email', $customer['email'])->first()->id;
        $this->actingAs($this->login)->delete('customers/' . $customer_id);
    }

    public function test_top_manager_can_edit_customers()
    {
        $customer = [
            'name' => $this->faker->name,
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'customer_type_id' => '1',
            'branch_id' => ['1'],
            'user_id' => $this->user->id,
        ];
        $response = $this->actingAs($this->login)->post('/customers', $customer);
        $customer_id = Customer::where('email', $customer['email'])->first()->id;

        $customer_edit = [
            'id' => $customer_id,
            'name' => $this->faker->name,
            'email' => $this->faker->email . str_random(20),
            'phone' => $this->faker->phonenumber,
            'type_id' => '1',
            'branch_id' => ['1'],
        ];

        $response = $this->actingAs($this->login)->post('customers/'.$customer_edit['id'], $customer_edit);
        $response->assertJson(['message' => 'Successfully updated!']);
        $response->assertSuccessful();
        
        $this->actingAs($this->login)->delete('customers/' . $customer_id);
    }

}
