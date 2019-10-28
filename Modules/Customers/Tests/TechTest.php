<?php

namespace Modules\Customers\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Modules\Login\Entities\Login;
use Modules\Users\Entities\People;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Currency;
use Modules\Companies\Entities\Branch;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Entities\CustomerType;
use Faker\Factory as Faker;
use Laravel\Passport\Passport;

class TechTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    private $tech_login;
    private $branch;

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $this->branch = $this->getBranchesOfLogin($login)->first();

        $this->addEmployeesToBranch($this->branch, $login, 1, 3);
        $employees = $this->getEmployeesOfLogin($login);
        $tech = $employees->where('role_id', 3)->first();
        $this->tech_login = Login::find(User::find($tech->user_id)->login_id);

        Passport::actingAs($this->tech_login);

    }

    public function test_tech_can_create_edit_and_delete_customers()
    {   

        $customer = [
            'name' => $this->faker->name,
            'email' => $this->faker->email  . str_random(20),
            'phone' => $this->faker->phonenumber,
            'customer_type_id' => $this->faker->numberBetween(1,2),
            'branch_id' => array($this->branch->id),
            'user_id' => $this->getUserOfLogin($this->tech_login)->id,
        ];

        //Create customer
        $response = $this->json('POST', route('customers.index'), $customer);
        $response->assertJson(['message' => 'Successfully created!']);
        $response->assertSuccessful();

        $customer_id = Customer::where('email', $customer['email'])->first()->id;

        $customer_edit = [
            'id' => $customer_id,
            'name' => $this->faker->name,
            'email' => $this->faker->email . str_random(20),
            'phone' => $this->faker->phonenumber,
            'type_id' =>  $this->faker->numberBetween(1,2),
            'branch_id' => array($this->branch->id)
        ];

        //Edit customer
        $response = $this->json('POST', route('customers.update', ['customer_id' => $customer_id]), $customer_edit);
        $response->assertJson(['message' => 'Successfully updated!']);
        $response->assertSuccessful();

        //Delete customer
        $response = $this->json( 'DELETE', route('customers.destroy', ['customer_id' => $customer_id]));
        $response->assertJson(['message' => 'Successfully deleted!']);
        $response->assertSuccessful();

        $this->assertDatabaseMissing('customers', ['id' => $customer_id]);

    }

}
