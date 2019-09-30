<?php

namespace Modules\Employees\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Login\Entities\Login;
use Modules\Users\Entities\User;
use Modules\Employees\Entities\Employee;
use Modules\Companies\Entities\Branch;
use \Illuminate\Http\UploadedFile;
use Laravel\Passport\Passport;
use Faker\Factory as Faker;

class EmployeesTest extends TestCase
{   

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();

    }


    public function test_head_created_two_techs()
    {

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $branch = $this->getBranchesOfLogin($login)->first();

        $this->addEmployeesToBranch($branch, $login, 2, 3);

    }

    public function test_head_created_two_sales_managers()
    {
       
        $login = $this->makeNewLoginWithCompanyAndBranch();
        $branch = $this->getBranchesOfLogin($login)->first();

        $this->addEmployeesToBranch($branch, $login, 2, 4);

    }
      
    public function test_user_can_not_be_created_with_password_less_than_8_characters()
    {
       
        $login = $this->makeNewLoginWithCompanyAndBranch();
        $branch = $this->getBranchesOfLogin($login)->first();
        Passport::actingAs($login);

        $response = $this->json('POST', route('employees.store'), [
            'name' => $this->faker->name,
            'username' => $this->faker->name,
            'password' => '12',
            're_password' => '12',
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'role_id' => 1, 
            'branch_id' => array($branch->id)
          ])->assertStatus(422);

    }
     
    public function test_head_can_not_be_created_with_password_doesnt_match_re_password()
    {
        
        $login = $this->makeNewLoginWithCompanyAndBranch();
        $branch = $this->getBranchesOfLogin($login)->first();
        Passport::actingAs($login);

        $response = $this->json('POST', route('employees.store'), [
            'name' => $this->faker->name,
            'username' => $this->faker->name,
            'password' => '123456789',
            're_password' => '123456780',
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'role_id' => 1, 
            'branch_id' => array($branch->id)
          ])->assertStatus(422);

    }

    public function test_head_edited_sales_manager()
    {
        
        $login = $this->makeNewLoginWithCompanyAndBranch();
        $branch = $this->getBranchesOfLogin($login)->first();

        $this->addEmployeesToBranch($branch, $login, 1, 4);
        $employees = $this->getEmployeesOfLogin($login);
        $sales_manager = $employees->where('role_id', 4)->first();

        Passport::actingAs($login);

        $response = $this->json('POST', route('employees.update', ['employee_id' => $sales_manager->id]), [
            'name' => $this->faker->name,
            'username' => $this->faker->name,
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'role_id' => 4, 
            'branch_id' => array($branch->id),
            'is_active' => 1
          ])->assertJsonStructure(['message', 'employee']);
        $response->assertStatus(200);

    }

    public function test_user_does_not_see_employees_from_another_company(){

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $new_login = $this->makeNewLoginWithCompanyAndBranch();

        $branch = $this->getBranchesOfLogin($login)->first();
        $new_branch = $this->getBranchesOfLogin($new_login)->first();

        $this->addEmployeesToBranch($branch, $login, 3, 4);
        $this->addEmployeesToBranch($new_branch, $new_login, 3, 4);

        Passport::actingAs($login);

        $this->assertEquals(8, Employee::all()->count());

        $response = $this->json('GET', route('employees.index'))->assertStatus(200);
        $this->assertEquals(4, substr_count($response->getContent(), 'email')); 

    }

    //WARNING: only head and top manager can access employees routes => it means that they can not edit their own profiles!!!
    public function test_top_manager_changes_his_photo(){

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $branch = $this->getBranchesOfLogin($login)->first();
        $this->addEmployeesToBranch($branch, $login, 1, 2);
        $employees = $this->getEmployeesOfLogin($login);
        $top_manager = $employees->where('role_id', 2)->first();
        $top_login = Login::find(User::find($top_manager->user_id)->login_id);

        Passport::actingAs($top_login);

        $response = $this->json('POST', route('employees.update', ['employee_id' => $top_manager->id]), [
            'id' => '1',
            'name' => 'Loy Dickens DVM edit',
            'username' => 'oliinykm95',
            'password' => '123456789',
            'email' => 'bergstrom.wayne.edit@bergstrom.org',
            'phone' => '123456754323',
            'role_id' => '1',
            'branch_id' => array($branch->id),
            'is_active' => true,
            'image' => UploadedFile::fake()->image('test_image.png')
          ])->assertJsonStructure(['message', 'employee']);
        $response->assertStatus(200);

    }

    //test_validation_stops_request_if_branch_id_is_not_an_array
    //test_head_created_two_top_managers
    //test_head_created_two_couriers

}
