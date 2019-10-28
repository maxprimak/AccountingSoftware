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
use Laravel\Passport\Passport;
use Faker\Factory as Faker;

class CourierTest extends TestCase
{   

    use RefreshDatabase;
    use WithFaker;

    private $courier_login;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        TestCase::setUpEnvironment();

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $branch = $this->getBranchesOfLogin($login)->first();
        $this->addEmployeesToBranch($branch, $login, 1, 5);

        $employees = $this->getEmployeesOfLogin($login);
        $courier = $employees->where('role_id', 5)->first();
        $this->courier_login = Login::find(User::find($courier->user_id)->login_id);

    }

    public function test_courier_can_not_access_companies_routes(){

        Passport::actingAs($this->courier_login);

        $response = $this->json('GET', route('companies.index'))->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);
        $response = $this->json('POST', route('companies.update', ['company_id' => 1]), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);

        $response = $this->json('GET', route('branches.index'))->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);
        $response = $this->json('POST', route('branches.store'), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);
        $response = $this->json('POST', route('branches.update', ['branch_id' => 1]), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);
        $response = $this->json('DELETE', route('branches.destroy', ['branch_id' => 1]), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);

        $response = $this->json('GET', route('currencies.index'), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);

    }

    public function test_courier_can_not_access_registration_routes(){

        Passport::actingAs($this->courier_login);

        $response = $this->json('POST', route('registration.store'), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);

    }

    public function test_courier_can_not_access_employees_routes(){

        Passport::actingAs($this->courier_login);

        $response = $this->json('GET', route('employees.index'))->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);
        $response = $this->json('POST', route('employees.store'), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);
        $response = $this->json('POST', route('employees.update', ['employee_id' => 1]), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);
        $response = $this->json('DELETE', route('employees.destroy', ['employee_id' => 1]), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);

        $response = $this->json('GET', route('roles.index'))->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);

    }

    public function test_courier_can_not_access_customers_routes(){

        Passport::actingAs($this->courier_login);

        $response = $this->json('GET', route('customers.index'), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);
        $response = $this->json('POST', route('customers.store'), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);
        $response = $this->json('POST', route('customers.update', ['customer_id' => 1]), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);
        $response = $this->json('DELETE', route('customers.destroy', ['customer_id' => 1]), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);

        $response = $this->json('POST', route('set.stars.number', ['customer_id' => 1]), [])->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);

        $response = $this->json('GET', route('customer_types.index'))->assertJson(["message" => "Courier does not have permission to access this route"])->assertStatus(403);

    }

}
