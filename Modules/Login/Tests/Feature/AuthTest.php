<?php

namespace Tests\Feature;

use Modules\Login\Entities\Login;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_logged_in_user_can_not_see_login_form()
    {
        $response = $this->post('/login', [
            'username' => 'person',
            'password' => '123456789',
        ]);
        $response->assertRedirect('/dashboard');
    }

    public function test_not_logged_in_user_can_not_see_dashboard()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('login::login_form');
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = factory(Login::class)->create();
        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => '123456789',
        ]);
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_email_sent_to_new_user_after_registration()
    {
        Notification::fake();
      
        $user = factory(User::class)->create();
      
        $response = $this->post('/register', [
            'email' => $user->email,
        ]);
    }
}
