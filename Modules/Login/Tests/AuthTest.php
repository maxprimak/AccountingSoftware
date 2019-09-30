<?php

namespace Modules\Login\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;

class AuthTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();

    }

    //test_user_can_login_with_valid_credentials
    //test_user_can_not_login_with_invalid_credentials
    //test_user_gets_auth_user_response
    //test_user_can_not_access_login_and_register_route_when_he_is_logged_in
    //test_user_can_access_login_and_register_route_when_he_is_logged_out
    //test_new_user_can_register
    //test_user_can_logout
    //test_not_logged_in_user_can_not_logout
    //test_login_validation_works
    //test_register_validation_works

}
