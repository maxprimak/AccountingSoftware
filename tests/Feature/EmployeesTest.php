<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Login\Entities\Login;
use Faker\Generator as Faker;

class EmployeesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_head_created_two_techs()
    {
        $response = $this->post('/login', [
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
        $response = $this->post('/login', [
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
}
