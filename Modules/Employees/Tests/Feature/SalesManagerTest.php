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
use Modules\Customers\Entities\Customer;
use Laravel\Passport\Passport;
use Faker\Factory as Faker;

class SalesManagerTest extends TestCase
{   

    use RefreshDatabase;
    use WithFaker;

    private $sales_login;

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
        $this->addEmployeesToBranch($branch, $login, 1, 4);

        $employees = $this->getEmployeesOfLogin($login);
        $sales_manager = $employees->where('role_id', 4)->first();
        $this->sales_login = Login::find(User::find($sales_manager->user_id)->login_id);

    }

    public function test_sales_manager_can_not_access_companies_routes()
    {
        
        Passport::actingAs($this->sales_login);

        $response = $this->json('GET', route('companies.index'))->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);
        $response = $this->json('POST', route('companies.update', ['company_id' => 1]), [])->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);

        $response = $this->json('GET', route('branches.index'))->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);
        $response = $this->json('POST', route('branches.store'), [])->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);
        $response = $this->json('POST', route('branches.update', ['branch_id' => 1]), [])->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);
        $response = $this->json('DELETE', route('branches.destroy', ['branch_id' => 1]), [])->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);

        $response = $this->json('GET', route('currencies.index'), [])->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);

    }

    public function test_sales_manager_can_not_access_employees_routes()
    {
        
        Passport::actingAs($this->sales_login);

        $response = $this->json('GET', route('employees.index'))->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);
        $response = $this->json('POST', route('employees.store'), [])->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);
        $response = $this->json('POST', route('employees.update', ['employee_id' => 1]), [])->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);
        $response = $this->json('DELETE', route('employees.destroy', ['employee_id' => 1]), [])->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);

        $response = $this->json('GET', route('roles.index'))->assertJson(["message" => "Only top manager and head can access this route"])->assertStatus(403);

    }
}
