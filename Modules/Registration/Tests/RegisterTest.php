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

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_new_user_redirects_to_registration_page_on_companies_routes(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->unique()->firstName()
        ]);

        $response = $this->actingAs($login)->get(route('companies.index'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->post(route('companies.store'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->get(route('companies.create'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->post(route('companies.update', ['company_id' => 1]))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->get(route('companies.edit' , ['company_id' => 1]))->assertRedirect(route('registration.index'));

        $response = $this->actingAs($login)->get(route('branches.create'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->post(route('branches.store'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->delete(route('branches.destroy', ['branch_id' => 1]))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->post(route('branches.update', ['branch_id' => 1]))->assertRedirect(route('registration.index'));

    }

    public function test_new_user_redirects_to_registration_page_on_employees_routes(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->unique()->firstName()
        ]);

        $response = $this->actingAs($login)->get(route('employees.index'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->post(route('employees.store'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->get(route('employees.create'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->post(route('employees.update', ['employee_id' => 1]))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->delete(route('employees.destroy', ['employee_id' => 1]))->assertRedirect(route('registration.index'));

    }

    public function test_new_user_redirects_to_registration_page_on_customers_routes(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->unique()->firstName()
        ]);

        $response = $this->actingAs($login)->get(route('customers.index'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->get(route('customers.create'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->post(route('customers.store'))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->post(route('customers.update', ['customer_id' => 1]))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->delete(route('customers.destroy', ['customer_id' => 1]))->assertRedirect(route('registration.index'));
        $response = $this->actingAs($login)->post(route('set.stars.number', ['customer_id' => 1]))->assertRedirect(route('registration.index'));

    }

    public function test_new_user_can_register(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->unique()->firstName()
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

    }

    public function test_user_can_not_register_for_second_time(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->unique()->firstName()
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

    public function test_existing_user_can_not_access_registration_routes(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->unique()->firstName()
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

        $response = $this->actingAs($login)->get(route('registration.index'));
        $response->assertStatus(302);

        $response = $this->actingAs($login)->post(route('registration.store'));
        $response->assertStatus(302);

    }

    public function test_registration_validation_rules(){

        $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->unique()->firstName()
        ]);
        
        $data = [
            'company_name' => $this->faker->name(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_address' => $this->faker->address(),
            'currency_id' => 1,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address()
        ];

        $this->checkValidationIfRequired($data, $login);

    }

}
