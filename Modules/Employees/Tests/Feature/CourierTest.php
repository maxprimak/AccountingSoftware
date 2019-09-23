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

class CourierTest extends TestCase
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
            'role_id' => '5'  //role courier
        ]);

        // //login courier
        // $this->post('/login', [
        //     'username' => $this->login->username,
        //     'password' => '123456789'
        // ]);

    }

    public function tearDown(): void
    {
        $head_login = Login::find(1);
        $this->actingAs($head_login)->delete('employees/'.$this->employee->id);
    }

    public function test_courier_can_not_access_any_page()
    {
        //-------------COMPANIES ROUTE----------------
        //Courier can not ACCESS my_company_page
        $response = $this->actingAs($this->login)->get(route('companies.index'));
        $response->assertStatus(302);

        //Courier can not CREATE my_company_page
        $response = $this->actingAs($this->login)->post(route('companies.create'));
        $response->assertStatus(302);
        $response = $this->actingAs($this->login)->post(route('companies.store'));
        $response->assertStatus(302);

        //Courier can not UPDATE my_company_page
        $response = $this->actingAs($this->login)->post(route('companies.update', '1'));
        $response->assertStatus(302);
        

        //-------------EMPLOYEES ROUTE----------------
        //Courier can not ACCESS employees_page
        $response = $this->actingAs($this->login)->get(route('employees.index'));
        $response->assertStatus(302);

        //Courier can not CREATE employees_page
        $response = $this->actingAs($this->login)->post(route('employees.create'));
        $response->assertStatus(302);
        $response = $this->actingAs($this->login)->post(route('employees.store'));
        $response->assertStatus(302);

        //Courier can not UPDATE employees_page
        $response = $this->actingAs($this->login)->post(route('employees.update', '1'));
        $response->assertStatus(302);


        //-------------CUSTOMERS ROUTE----------------
        //Courier can not ACCESS customers_page
        $response = $this->actingAs($this->login)->get(route('customers.index'));
        $response->assertStatus(302);

        //Courier can not CREATE customers_page
        $response = $this->actingAs($this->login)->post(route('customers.create'));
        $response->assertStatus(302);
        $response = $this->actingAs($this->login)->post(route('customers.store'));
        $response->assertStatus(302);

        //Courier can not UPDATE customers_page
        $response = $this->actingAs($this->login)->post(route('customers.update', '1'));
        $response->assertStatus(302);
    }
}
