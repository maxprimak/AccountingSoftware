<?php

namespace Modules\Employees\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Login\Entities\Login;
use \Illuminate\Http\UploadedFile;
use Faker\Factory as Faker;

class EmployeesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function login(){
        $response = $this->post('/login', [
            'username' => 'oliinykm95',
            'password' => '123456789'
        ]);
    }

    public function test_head_created_two_techs()
    {
        $this->login();

        $this->faker = Faker::create();

        $data1 = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . 'user',
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email,
            'phone' => $this->faker->phonenumber,
            'role_id' => '3',
            'branch_id' => ['1'],
        ];

        $data2 = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . 'user',
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email,
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

        $response2 = $this->post('/employees', $data2);
        $response2->assertJson(['message' => 'Successfully created!']);
        $this->assertDatabaseHas('logins', [
            'username' => $data2['username'],
            'email' => $data2['email'],
        ]);
        $response2->assertStatus(200);

    }

    public function test_head_created_two_sales_managers()
    {
        $this->login();

        $this->faker = Faker::create();

        $data1 = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . 'user',
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email,
            'phone' => $this->faker->phonenumber,
            'role_id' => '2',
            'branch_id' => ['1'],
        ];

        $data2 = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . 'user',
            'password' => '123456789',
            're_password' => '123456789',
            'email' => $this->faker->email,
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
        $this->login();

        $this->faker = Faker::create();

        $data = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . 'user',
            'password' => '123',  //password uncorrect
            're_password' => '12345678',
            'email' => $this->faker->email,
            'phone' => $this->faker->phonenumber,
            'role_id' => '3',
            'branch_id' => ['1'],
        ];

        $response = $this->post('/employees', $data);
        $response->assertJson(['error' => 'The password must be at least 8 characters.']);
    }

    public function test_head_can_not_created_with_password_doesnt_match_re_password()
    {
        $this->login();

        $this->faker = Faker::create();

        $data = [
            'name' => $this->faker->name,
            'username' => $this->faker->username . 'user',
            'password' => '12345678',
            're_password' => 'adasdasdsa',  //password doesnt match re_password
            'email' => $this->faker->email,
            'phone' => $this->faker->phonenumber,
            'role_id' => '3',
            'branch_id' => ['1'],
        ];

        $response = $this->post('/employees', $data);
        $response->assertJson(['error' => 'The re password and password must match.']);
    }

    public function test_head_edited_sales_manager()
    {
        $this->login();

        $data = [
            'id' => '4',
            'full_name' => 'sale manager 2 edit',
            'username' => 'salemanger2',
            'password' => '123456789',
            'email' => 'salemanager2.edit@example.com',
            'phone' => '1234567',
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
    }

    public function test_user_does_not_see_employees_from_another_company()
    {
        $this->login();

        $response = $this->get('/employees');

        $response->assertSuccessful();

        $response = $response->original->getData()['employees'];

        foreach ($response as $item) {
            $this->assertEquals('1', $item->branch_id[0]);
        }
    }

    public function test_tech_changes_his_photo()
    {
        $this->login();

        $data = [
            'id' => '1',
            'full_name' => 'Loy Dickens DVM edit',
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
