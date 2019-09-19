<?php

namespace Modules\Employees\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Modules\Login\Entities\Login;
use Modules\Users\Entities\People;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;
use Modules\Employees\Entities\Employee;
use Faker\Factory as Faker;

class TechTest extends TestCase
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
            'role_id' => '3'
        ]);

        //login tech
        $this->post('/login', [
            'username' => $this->login->username,
            'password' => '123456789'
        ]);

    }

    public function tearDown(): void
    {
        $response = $this->get('/logout');
        $response = $this->post('/login', [
            'username' => 'oliinykm95',
            'password' => '123456789'
        ]);
        $response = $this->delete('employees/'.$this->employee->id);
    }

    public function test_tech_can_not_access_my_company_page()
    {
        $response = $this->get('/companies');
        $response->assertStatus(302);
    }

    public function test_tech_can_not_access_employees_page()
    {
        $response = $this->get('/employees');
        $response->assertStatus(302);
    }

    public function test_tech_can_create_and_edit_customers()
    {
        $customer = [
            'name' => $this->faker->name,
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'customer_type_id' => '1',
            'branch_id' => ['1'],
            'user_id' => $this->user->id,
        ];
        $response = $this->post('/customers', $customer);
        $response->assertJson(['message' => 'Successfully created!']);
        $response->assertSuccessful();
    }
}
