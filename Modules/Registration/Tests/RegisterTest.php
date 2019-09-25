<?php

namespace Modules\Registration\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Modules\Login\Entities\Login;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;

class RegisterTest extends TestCase
{

    use WithFaker,
    RefreshDatabase;

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
}