<?php

namespace Modules\Companies\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;

class BranchesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp() : void
    {

        parent::setUp();
        TestCase::setUpEnvironment();

    }

    public function test_user_can_get_all_his_branches(){

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $this->addBranchesToLogin($login, 10);
        Passport::actingAs($login);

        $response = $this->json('GET', route('branches.index'))->assertJsonStructure(['*' => ['id', 'name', 'company_id']]);
        $response->assertStatus(200);

        $this->assertEquals(11, substr_count($response->getContent(), 'name')); //check that response contains all 11 branches of user

    }

    public function test_user_can_create_new_branch(){

        $login = $this->makeNewLoginWithCompanyAndBranch();
        Passport::actingAs($login);

        $response = $this->json('POST', route('branches.store'),[
            'name' => 'branch_name_1',
            'color' => '#F64272'
        ])->assertJsonStructure(['message', 'branch']);
        $response->assertStatus(200);

        $response = $this->json('POST', route('branches.store'),[
            'name' => 'branch_name_2',
            'address' => $this->faker->address,
            'color' => '#F64272'
        ])->assertJsonStructure(['message', 'branch']);
        $response->assertStatus(200);

        $response = $this->json('POST', route('branches.store'),[
            'name' => 'branch_name_3',
            'address' => $this->faker->address,
            'phone' => $this->faker->phonenumber,
            'color' => '#F64272'
        ])->assertJsonStructure(['message', 'branch']);
        $response->assertStatus(200);

        $this->assertDatabaseHas('branches', ['name' => 'branch_name_1']);
        $this->assertDatabaseHas('branches', ['name' => 'branch_name_2']);
        $this->assertDatabaseHas('branches', ['name' => 'branch_name_3']);

    }

    public function test_user_can_edit_his_branch(){

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $branches = $this->getBranchesOfLogin($login);
        Passport::actingAs($login);

        $response = $this->json('POST',route('branches.update', ['branch_id' => $branches->first()->id]),[
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'phone' => $this->faker->phonenumber,
            'color' => '#F64272'
        ])->assertJsonStructure(['message', 'branch']);
        $response->assertStatus(200);

        $response = $this->json('POST',route('branches.update', ['branch_id' => $branches->first()->id]),[
            'name' => 'name_to_update',
            'color' => '#fff'
        ])->assertJsonStructure(['message', 'branch']);
        $response->assertStatus(200);

        $this->assertDatabaseHas('branches', ['name' => 'name_to_update']);

    }

    public function test_user_can_delete_branch(){

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $this->addBranchesToLogin($login, 3);
        $branches = $this->getBranchesOfLogin($login);
        Passport::actingAs($login);

        $response = $this->json('delete',route('branches.destroy', ['branch_id' => $branches->first()->id]))
            ->assertJson(['message' => 'Successfully deleted!']);
        $response->assertStatus(200);

    }

    public function test_user_can_not_delete_branch_with_employees(){

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $this->addBranchesToLogin($login, 1);
        $branches = $this->getBranchesOfLogin($login);
        $branch = $branches->get(1);

        $this->addEmployeesToBranch($branch, $login, 3);    

        Passport::actingAs($login);

        $response = $this->json('delete',route('branches.destroy', ['branch_id' => $branch->id]))
        ->assertJson(['message' => 'You can not delete this branch(it has employees or customers)']);
        $response->assertStatus(403);

    }

    public function test_user_can_not_delete_branch_with_customers(){
    
        $login = $this->makeNewLoginWithCompanyAndBranch();
        $this->addBranchesToLogin($login, 1);
        $branches = $this->getBranchesOfLogin($login);
        $branch = $branches->get(1);

        $this->addCustomersToBranch($branch, $login, 3);   

        Passport::actingAs($login);

        $response = $this->json('delete',route('branches.destroy', ['branch_id' => $branch->id]))
        ->assertJson(['message' => 'You can not delete this branch(it has employees or customers)']);
        $response->assertStatus(403);

    }

    //test_user_can_not_delete_last_branch
    //test_user_can_update_only_his_branches
    //test_user_can_delete_only_his_branches

}
