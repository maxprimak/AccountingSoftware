<?php

namespace Modules\Registration\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Modules\Login\Entities\Login;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;
use Modules\Companies\Entities\Currency;

class RegisterTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();

    }

    public function test_new_user_can_not_access_companies_module_routes_without_registration(){

        $response = $this->makeResponseWithNewAuthLogin();
        
        $response->json('GET', route('companies.index'))->assertStatus(403);
        $response->json('POST', route('companies.update', ['company_id' => 1]),[])->assertStatus(403);

        $response->json('GET', route('branches.index'))->assertStatus(403);
        $response->json('POST', route('branches.store'),[])->assertStatus(403);
        $response->json('POST', route('branches.update', ['branch_id' => 1]),[])->assertStatus(403);
        $response->json('DELETE', route('branches.destroy', ['branch_id' => 1]),[])->assertStatus(403);

        $response->json('GET', route('currencies.index'))->assertStatus(403);

    }

    public function test_new_user_can_not_access_employees_module_routes_without_registration(){

        $response = $this->makeResponseWithNewAuthLogin();

        $response->json('GET', route('employees.index'))->assertStatus(403);
        $response->json('POST', route('employees.store'),[])->assertStatus(403);
        $response->json('POST', route('employees.update', ['employee_id' => 1]),[])->assertStatus(403);
        $response->json('DELETE', route('employees.destroy', ['employee_id' => 1]),[])->assertStatus(403);

        $response->json('GET', route('roles.index'))->assertStatus(403);

    }

    //test_new_user_can_not_access_customers_module_routes_without_registration()

    public function test_new_user_can_register(){

        $response = $this->makeResponseWithNewAuthLogin();

        $response->json('POST', route('registration.store'),[
            'company_name' => $this->faker->name(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_address' => $this->faker->address(),
            'currency_id' => 1,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address()
        ])->assertStatus(200);

    }

    public function test_user_can_not_register_for_second_time(){

        $response = $this->makeResponseWithNewAuthLogin();

        $response->json('POST', route('registration.store'),[
            'company_name' => $this->faker->name(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_address' => $this->faker->address(),
            'currency_id' => 1,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address()
        ])->assertStatus(200);

        $response->json('POST', route('registration.store'),[
            'company_name' => $this->faker->name(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_address' => $this->faker->address(),
            'currency_id' => 1,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address()
        ])->assertStatus(403);

    }

    public function test_registration_validation_rules(){

        $data = [
            'company_name' => $this->faker->name(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_address' => $this->faker->address(),
            'currency_id' => 1,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address()
        ];

        $this->checkValidationRequired($data, 'registration.store');

    }

}