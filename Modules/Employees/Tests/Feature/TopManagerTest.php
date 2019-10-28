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

class TopManagerTest extends TestCase
{   

    use RefreshDatabase;
    use WithFaker;

    private $top_login;
    private $branch;

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
        $this->branch = $this->getBranchesOfLogin($login)->first();
        $this->addEmployeesToBranch($this->branch, $login, 1, 2);

        $employees = $this->getEmployeesOfLogin($login);
        $top_manager = $employees->where('role_id', 2)->first();
        $this->top_login = Login::find(User::find($top_manager->user_id)->login_id);

    }

    public function test_top_manager_can_create_all_types_of_employees()
    {

        $this->addEmployeesToBranch($this->branch, $this->top_login, 1, 1);
        $this->addEmployeesToBranch($this->branch, $this->top_login, 1, 2);
        $this->addEmployeesToBranch($this->branch, $this->top_login, 1, 3);
        $this->addEmployeesToBranch($this->branch, $this->top_login, 1, 4);
        $this->addEmployeesToBranch($this->branch, $this->top_login, 1, 5);

        $this->assertEquals(2, $this->getEmployeesOfLogin($this->top_login)->where('role_id', 1)->count());
        $this->assertEquals(2, $this->getEmployeesOfLogin($this->top_login)->where('role_id', 2)->count());
        $this->assertEquals(1, $this->getEmployeesOfLogin($this->top_login)->where('role_id', 3)->count());
        $this->assertEquals(1, $this->getEmployeesOfLogin($this->top_login)->where('role_id', 4)->count());
        $this->assertEquals(1, $this->getEmployeesOfLogin($this->top_login)->where('role_id', 5)->count());

    }

    public function test_top_manager_can_edit_employee(){

        $this->addEmployeesToBranch($this->branch, $this->top_login, 1, 3);
        $employees = $this->getEmployeesOfLogin($this->top_login);
        $employee = $employees->where('role_id', 3)->first();

        Passport::actingAs($this->top_login);

        $response = $this->json('POST', route('employees.update', ['employee_id' => $employee->id]), [
            'name' => $this->faker->name,
            'username' => $this->faker->name,
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'role_id' => 4, 
            'branch_id' => array($this->branch->id),
            'is_active' => 1
        ])->assertJsonStructure(['message', 'employee']);
        $response->assertStatus(200);

    }

}
