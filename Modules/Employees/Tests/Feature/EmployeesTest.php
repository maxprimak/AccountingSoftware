<?php

namespace Modules\Employees\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Login\Entities\Login;
use Modules\Employees\Entities\Employee;
use Modules\Companies\Entities\Branch;
use \Illuminate\Http\UploadedFile;
use Faker\Factory as Faker;

class EmployeesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->login();
    }

    public function login(){
        $response = $this->post('/login', [
            'username' => 'oliinykm95',
            'password' => '123456789'
        ]);
    }

    public function get_employee($username){
        $employee_id = Login::where('username', $username)
                            ->join('users', 'users.login_id', "=", 'logins.id')
                            ->join('employees', 'employees.user_id', '=', 'users.id')
                            ->select('employees.id')
                            ->first();

        return $employee_id->id;
    }

    public function test_head_created_two_techs()
    {
        $this->faker = Faker::create();

        $data1 = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '3',
            'branch_id' => ['1'],
        ];

        $data2 = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '3',
            'branch_id' => ['1'],
        ];

        $response1 = $this->post('/employees', $data1);
        $response1->assertJson(['message' => 'Successfully created!']);
        $this->assertDatabaseHas('logins', [
            'username' => $data1['username'],
            'email' => $data1['email'],
        ]);
        $response1->assertStatus(200);

        $id_employee = $this->get_employee($data1['username']);
        $this->delete('employees/'.$id_employee);

        $response2 = $this->post('/employees', $data2);
        $response2->assertJson(['message' => 'Successfully created!']);
        $this->assertDatabaseHas('logins', [
            'username' => $data2['username'],
            'email' => $data2['email'],
        ]);
        $response2->assertStatus(200);

        $id_employee = $this->get_employee($data2['username']);
        $this->delete('employees/'.$id_employee);

    }

    public function test_head_created_two_sales_managers()
    {
        $this->faker = Faker::create();

        $data1 = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '2',
            'branch_id' => ['1'],
        ];

        $data2 = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '2',
            'branch_id' => ['1'],
        ];

        $response1 = $this->post('/employees', $data1);
        $response1->assertJson(['message' => 'Successfully created!']);
        $this->assertDatabaseHas('logins', [
            'username' => $data1['username'],
            'email' => $data1['email'],
        ]);
        $response1->assertStatus(200);

        $id_employee = $this->get_employee($data1['username']);
        $this->delete('employees/'.$id_employee);

        $response2 = $this->post('/employees', $data2);
        $response2->assertJson(['message' => 'Successfully created!']);
        $this->assertDatabaseHas('logins', [
            'username' => $data2['username'],
            'email' => $data2['email'],
        ]);
        $response2->assertStatus(200);

    }

    public function test_head_can_not_created_with_password_uncorrect()
    {
        $this->faker = Faker::create();

        $data = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123',  //password uncorrect
            're_password' => '12345678',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '3',
            'branch_id' => ['1'],
        ];

        $response = $this->post('/employees', $data);
        $response->assertJson(['error' => 'The password must be at least 8 characters.']);
    }

    public function test_head_can_not_created_with_password_doesnt_match_re_password()
    {
        $this->faker = Faker::create();

        $data = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '12345678',
            're_password' => 'adasdasdsa',  //password doesnt match re_password
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '3',
            'branch_id' => ['1'],
        ];

        $response = $this->post('/employees', $data);
        $response->assertJson(['error' => 'The re password and password must match.']);
    }

    public function test_head_edited_sales_manager()
    {
        $employee_id = Employee::select('id')->orderBy('created_at', 'desc')->first()->id;

        $this->faker = Faker::create();

        $data = [
            'id' => $employee_id,
            'name' => $this->faker->name,
            'username' => $this->faker->username . str_random(20),
            'password' => '123456789',
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'role_id' => '2',
            'branch_id' => ['1'],
            'is_active' => true,
        ];

        $response = $this->post('employees/'.$data['id'], $data);
        $response->assertJson(['message' => 'Successfully updated!']);
        $this->assertDatabaseHas('logins', [
            'username' => $data['username'],
            'email' => $data['email'],
        ]);
        $response->assertStatus(200);

        $this->delete('employees/'.$employee_id);
    }

    public function test_user_does_not_see_employees_from_another_company()
    {
        $response = $this->get('/employees');

        $response->assertSuccessful();

        $response = $response->original->getData()['employees'];

        foreach ($response as $item) {
            foreach ($item->branch_id as $id) {
                $company_id = Branch::select('company_id')->where('id', $id)->first()->company_id;
                $this->assertEquals('1', $company_id);
            }
        }
    }

    public function test_tech_changes_his_photo()
    {
        $data = [
            'id' => '1',
            'name' => 'Loy Dickens DVM edit',
            'username' => 'oliinykm95',
            'password' => '123456789',
            'email' => 'bergstrom.wayne.edit@bergstrom.org',
            'phone' => '123456754323',
            'role_id' => '1',
            'branch_id' => ['1'],
            'is_active' => true,
            'image' => UploadedFile::fake()->image('test_image.png')
        ];

        $response = $this->post('employees/'.$data['id'], $data);
        $response->assertJson(['message' => 'Successfully updated!']);
        $response->assertStatus(200);
    }
}
