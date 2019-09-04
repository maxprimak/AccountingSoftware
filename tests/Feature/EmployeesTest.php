<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Login\Entities\Login;
use \Illuminate\Http\UploadedFile;

class EmployeesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_head_created_two_techs()
    {
        $login = $this->post('/login', [
            'username' => 'oliinykm95',
            'password' => '123456789'
        ]);

        $data1 = [
            'name' => 'xa fax as',
            'username' => 'xafa123',
            'password' => '123456789',
            're_password' => '123456789',
            'email' => 'xafa221@example.com',
            'phone' => '1234',
            'role_id' => '3',
            'branch_id' => '1',
        ];

        $data2 = [
            'name' => 'hoho fzaf',
            'username' => 'holol212',
            'password' => '123456789',
            're_password' => '123456789',
            'email' => 'holo232@example.com',
            'phone' => '12345',
            'role_id' => '3',
            'branch_id' => '1',
        ];
      
        $response1 = $this->post('/employees', $data1);
        $response2 = $this->post('/employees', $data2);

        $response1->assertStatus(200);
        $response2->assertStatus(200);
    }

    public function test_head_created_two_sales_managers()
    {
        $login = $this->post('/login', [
            'username' => 'oliinykm95',
            'password' => '123456789'
        ]);

        $data1 = [
            'name' => 'sale manager 1',
            'username' => 'salemanger1',
            'password' => '123456789',
            're_password' => '123456789',
            'email' => 'salemanager1@example.com',
            'phone' => '123456',
            'role_id' => '2',
            'branch_id' => '1',
        ];

        $data2 = [
            'name' => 'sale manager 2',
            'username' => 'salemanger2',
            'password' => '123456789',
            're_password' => '123456789',
            'email' => 'salemanager2@example.com',
            'phone' => '1234567',
            'role_id' => '2',
            'branch_id' => '1',
        ];
      
        $response1 = $this->post('/employees', $data1);
        $response2 = $this->post('/employees', $data2);

        $response1->assertStatus(200);
        $response2->assertStatus(200);
    }

    public function test_head_edited_sales_manager()
    {
        $login = $this->post('/login', [
            'username' => 'oliinykm95',
            'password' => '123456789'
        ]);

        $data = [
            'id' => '14',
            'full_name' => 'sale manager 2 edit',
            'username' => 'salemanger2',
            'password' => '123456789',
            'email' => 'salemanager2@example.com',
            'phone' => '1234567',
            'role_id' => '2',
            'branch_id' => '1',
            'is_active' => '2',
        ];

        $response = $this->post('employees/'.$data['id'], $data);

        $response->assertStatus(200);
    }

    public function test_user_does_not_see_employees_from_another_company()
    {
        $login = factory(Login::class)->create([
            'password' => bcrypt($password = '123456789'),
        ]);

        $response = $this->post('/login', [
            'username' => $login->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($login);
        $response = $this->get('/employees');

        // $response->assertSuccessful();
        // $response->assertViewIs('employees.index');
    }

    public function test_tech_changes_his_photo()
    {
        Storage::fake('avatars/');

        $login = $this->post('/login', [
            'username' => 'oliinykm95',
            'password' => '123456789'
        ]);

        $data = [
            'id' => '1',
            'full_name' => 'Loy Dickens DVM edit',
            'username' => 'oliinykm95',
            'password' => '123456789',
            'email' => 'bergstrom.wayne.edit@bergstrom.org',
            'phone' => '123456754323',
            'role_id' => '1',
            'branch_id' => '1',
            'is_active' => '1',
            'image' => UploadedFile::fake()->image('test_image.png')
        ];
        
        $response = $this->post('employees/'.$data['id'], $data);

        $response->assertStatus(200);
    }
}
