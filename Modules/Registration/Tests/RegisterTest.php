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

    public function test_new_user_can_not_access_companies_module_routes_without_registration(){

        $response = $this->makeResponseWithNewAuthLogin();
        
        $response->json('GET', route('companies.index'))->assertStatus(403);
        $response->json('POST', route('companies.update', ['company_id' => 1]),[])->assertStatus(403);

        $response->json('GET', route('branches.index'))->assertStatus(403);
        $response->json('POST', route('branches.store'),[])->assertStatus(403);
        $response->json('POST', route('branches.update', ['branch_id' => 1]),[])->assertStatus(403);
        $response->json('DELETE', route('branches.destroy', ['branch_id' => 1]),[])->assertStatus(403);

        $response->json('GET', route('currencies.index'))->assertStatus(403);

    }

    public function test_new_user_can_not_access_employees_module_routes_without_registration(){

        $response = $this->makeResponseWithNewAuthLogin();

        $response->json('GET', route('employees.index'))->assertStatus(403);
        $response->json('POST', route('employees.store'),[])->assertStatus(403);
        $response->json('POST', route('employees.update', ['employee_id' => 1]),[])->assertStatus(403);
        $response->json('DELETE', route('employees.destroy', ['employee_id' => 1]),[])->assertStatus(403);

        $response->json('GET', route('roles.index'))->assertStatus(403);

    }

    //test_new_user_can_not_access_customers_module_routes_without_registration()
}

/*

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

    public static function tearDownAfterClass()
    {
    shell_exec('php artisan migrate:fresh --seed');
    print "\nMigration was done\n";
    parent::tearDownAfterClass();
    }

}
    /*
