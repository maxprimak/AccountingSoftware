<?php

namespace Modules\Registration\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Login\Entities\Login;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;

class RegisterTest extends TestCase
{

    use WithFaker;

    public function test_new_user_redirects_to_registration_page_on_companies_click(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->firstName()
        ]);

        $response = $this->actingAs($login)->get('/companies');

        $response->assertRedirect(route('registration.index'));

    }

    public function test_new_user_redirects_to_registration_page_on_employees_click(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->firstName()
        ]);

        $response = $this->actingAs($login)->get(route('employees.index'));

        $response->assertRedirect(route('registration.index'));

    }

    //public function test_new_user_redirects_to_registration_page_on_customers_click(){}

    //user_without_user_acc
    //user_without_employees_acc
    //user_without_company

    public function test_new_user_can_register(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->firstName()
        ]);

        $response = $this->actingAs($login)->post(route('registration.store'),[
            'company_name' => $this->faker->name(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_address' => $this->faker->address(),
            'currency_id' => 1,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address()
        ]);

        $response->assertStatus(200);

        return $login;

    }

    public function test_user_can_not_register_for_second_time(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->firstName()
        ]);

        $response = $this->actingAs($login)->post(route('registration.store'),[
            'company_name' => $this->faker->name(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_address' => $this->faker->address(),
            'currency_id' => 1,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address()
        ]);

        $response->assertStatus(200);

        $user_comp = User::where('login_id', $login->id)->first()->company_id;

        $response = $this->actingAs($login)->post(route('registration.store'),[
            'company_name' => $this->faker->name(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_address' => $this->faker->address(),
            'currency_id' => 1,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address()
        ]);

        $response->assertStatus(302);

        $user_comp_new = User::where('login_id', $login->id)->first()->company_id;

        $this->assertEquals(1, User::where('login_id', $login->id)->get()->count());
        $this->assertEquals($user_comp, $user_comp_new);

    }



    //user with comp can not register
    //validationFails

    //public function test_user_can_register_when_he_does_not_have_company(){}
    //public function test_user_can_register_when_he_does_not_have_user_account(){}

    //public function test_user_with_company_and_user_account_does_not_redirects_to_registration_page(){}
    //public function test_user_with_company_and_user_account_can_not_access_registration_page(){}

}
