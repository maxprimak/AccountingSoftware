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

        // //login top manager
        // $this->post('/login', [
        //     'username' => $this->login->username,
        //     'password' => '123456789'
        // ]);

    }

    public function tearDown(): void
    {
        $this->delete('employees/'.$this->employee->id);
    }

    public function get_employee($username){
        $employee_id = Login::where('username', $username)
                            ->join('users', 'users.login_id', "=", 'logins.id')
                            ->join('employees', 'employees.user_id', '=', 'users.id')
                            ->select('employees.id')
                            ->first();

        return $employee_id->id;
    }

    public function test_top_manager_can_create_all_types_of_employees()
    {
        //Create head
        $head = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '1', //role head
            'branch_id' => ['1'],
        ];
        $response = $this->actingAs($this->login)->post('/employees', $head);
        $response->assertJson(['message' => 'Successfully created!']);
        $response->assertSuccessful();
        $id_employee = $this->get_employee($head['username']);
        $this->delete('employees/'.$id_employee);

        //Create top manager
        $top_manager = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '2', //role top manager
            'branch_id' => ['1'],
        ];
        $response = $this->actingAs($this->login)->post('/employees', $top_manager);
        $response->assertJson(['message' => 'Successfully created!']);
        $response->assertSuccessful();
        $id_employee = $this->get_employee($top_manager['username']);
        $this->delete('employees/'.$id_employee);

        //Create tech
        $tech = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '3', //role tech
            'branch_id' => ['1'],
        ];
        $response = $this->actingAs($this->login)->post('/employees', $tech);
        $response->assertJson(['message' => 'Successfully created!']);
        $response->assertSuccessful();
        $id_employee = $this->get_employee($tech['username']);
        $this->delete('employees/'.$id_employee);

        //Create sale manager
        $sale_manager = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '4', //role sale manager
            'branch_id' => ['1'],
        ];
        $response = $this->actingAs($this->login)->post('/employees', $sale_manager);
        $response->assertJson(['message' => 'Successfully created!']);
        $response->assertSuccessful();
        $id_employee = $this->get_employee($sale_manager['username']);
        $this->delete('employees/'.$id_employee);

        //Create courier
        $courier = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '5', //role courier
            'branch_id' => ['1'],
        ];
        $response = $this->actingAs($this->login)->post('/employees', $courier);
        $response->assertJson(['message' => 'Successfully created!']);
        $response->assertSuccessful();
        $id_employee = $this->get_employee($courier['username']);
        $this->delete('employees/'.$id_employee);

    }

    public function test_top_manager_can_edit_employees()
    {
        $employee = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '3',
            'branch_id' => ['1'],
        ];
        $response = $this->actingAs($this->login)->post('/employees', $employee);
        $id_employee = $this->get_employee($employee['username']);

        $employee_edit = [
            'id' => $id_employee,
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '2',
            'branch_id' => ['1'],
            'is_active' => true,
        ];

        $response = $this->actingAs($this->login)->post('employees/'.$employee_edit['id'], $employee_edit);
        $response->assertJson(['message' => 'Successfully updated!']);
        $response->assertSuccessful();

        $this->delete('employees/'.$employee_edit['id']);
    }

}
