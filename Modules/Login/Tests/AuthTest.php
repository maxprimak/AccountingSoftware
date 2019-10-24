<?php

namespace Modules\Login\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Login\Entities\Login;
use Laravel\Passport\Passport;

class AuthTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    private $login;

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();

        $this->login = $this->makeNewLogin();

    }

    public function test_user_can_login_with_valid_credentials(){

        //register new user
        $response = $this->json('POST', route('register'), [
            'username' => 'newuser',
            'email' => 'newemail@mail.com',
            'password' => '123456789',
            'repassword' => '123456789'
        ])->assertJsonStructure(['access_token', 'token_type', 'expires_in'])->assertStatus(200);

        $response = $this->json('POST', route('login'), [
            'username' => 'newuser',
            'password' => '123456789'
        ])->assertJsonStructure(['access_token', 'token_type', 'expires_in'])->assertStatus(200);

    }

    public function test_user_can_not_login_with_invalid_credentials(){

        //register new user
        $response = $this->json('POST', route('register'), [
            'username' => 'newuser',
            'email' => 'newemail@mail.com',
            'password' => '123456789',
            'repassword' => '123456789'
        ])->assertJsonStructure(['access_token', 'token_type', 'expires_in'])->assertStatus(200);

        $response = $this->json('POST', route('login'), [
            'username' => 'newuser1',
            'password' => '123456789'
        ])->assertJson(['error' => 'invalid_credentials'])->assertStatus(401);

        $response = $this->json('POST', route('login'), [
            'username' => 'newuser',
            'password' => '1234567891'
        ])->assertJson(['error' => 'invalid_credentials'])->assertStatus(401);

        $response = $this->json('POST', route('login'), [
            'username' => 'newuser1',
            'password' => '1234567891'
        ])->assertJson(['error' => 'invalid_credentials'])->assertStatus(401);

    }
    
    public function test_user_gets_auth_user_response(){

        Passport::actingAs($this->login);

        $response = $this->json('GET', route('user'))->assertJsonStructure(['username', 'id', 'email'])->assertStatus(200);

    }

    public function test_not_logged_in_user_does_not_get_auth_user_response(){

        $response = $this->json('GET', route('user'))->assertJson(["error" => "Unauthorized"])->assertStatus(401);

    }
    
    public function test_new_user_can_register(){

        $response = $this->json('POST', route('register'), [
            'username' => 'newuser',
            'email' => 'newemail@mail.com',
            'password' => '123456789',
            'repassword' => '123456789'
        ])->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
        $response->assertStatus(200);

        $this->assertDatabaseHas('logins', ['username' => 'newuser']);

    }
    
    public function test_user_can_logout(){

        Passport::actingAs($this->login);

        $response = $this->json('POST', route('logout'))->assertJson(['status' => 'logged_out'])->assertStatus(200);

    }

    public function test_not_logged_in_user_can_not_logout(){

        $response = $this->json('POST', route('logout'))->assertJson(['status' => 'not_logged_in'])->assertStatus(401);

    }

    public function test_not_active_user_can_not_login(){

        //register new user
        $response = $this->json('POST', route('register'), [
            'username' => 'newuser',
            'email' => 'newemail@mail.com',
            'password' => '123456789',
            'repassword' => '123456789'
        ])->assertJsonStructure(['access_token', 'token_type', 'expires_in'])->assertStatus(200);

        $login = Login::where('username', 'newuser')->first();
        $login->is_active = 0;
        $login->save();

        $response = $this->json('POST', route('login'), [
            'username' => 'newuser',
            'password' => '123456789'
        ])->assertJson(['error' => 'invalid_credentials'])->assertStatus(401);

    }

    //test_user_can_not_access_login_and_register_route_when_he_is_logged_in
    //test_new_user_gets_email_after_registration
    //test_login_validation_works
    //test_register_validation_works

}
