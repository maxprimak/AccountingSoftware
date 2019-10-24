<?php

namespace Modules\Orders\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Modules\Orders\Entities\Order;

class RepairOrdersTest extends TestCase
{   

    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();

    }

    //guest_can_not_access_routes(){}
    //validator works for create
    //validator works for update
    //prepaysum > price
    
    /*
    public function test_user_can_create_repair_order(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $response = $this->json('POST', route('orders.repair.store'), [
            'accept_date' => $this->faker->date('Y-m-d', '1461067200'),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 1000),
            'branch_id' => $this->getBranchesOfLogin($login)->first()->id,
            'order_nr' => $this->faker->swiftBicNumber(),
            'customer_name' => $this->faker->name(),
            'customer_phone' => $this->faker->phoneNumber(),
            'defect_description' => $this->faker->text(),
            'comment' => $this->faker->text(),
            'prepay_sum' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 1000)
        ])->assertJsonStructure([
            'status',
            'order' => [
                'id',
                'accept_date',
                'price',
                'branch_id',
                'order_nr',
                'customer_name',
                'customer_phone',
                'defect_description',
                'comment',
                'prepay_sum',
                'status_id',
                'created_at',
                'updated_at',
                'created_by',
            ]
        ])->assertStatus(200);

    }
    */

    public function test_user_can_update_repair_order(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $order = $this->makeNewRepairOrder($login);

        $this->json('POST', route('orders.repair.update', ['order_id' => $order->id]), [
            'accept_date' => $this->faker->date('Y-m-d', '1461067200'),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 1000),
            'order_nr' => $this->faker->swiftBicNumber(),
            'customer_name' => $this->faker->name(),
            'customer_phone' => $this->faker->phoneNumber(),
            'defect_description' => $this->faker->text(),
            'comment' => $this->faker->text(),
            'status' => 'Called',
            'prepay_sum' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 1000)
        ])->dump();
        
        /*->assertJsonStructure([
            'status',
            'order' => [
                'id',
                'accept_date',
                'price',
                'branch_id',
                'order_nr',
                'customer_name',
                'customer_phone',
                'defect_description',
                'comment',
                'prepay_sum',
                'status',
                'created_at',
                'updated_at',
                'created_by',
            ]
        ])->assertStatus(200);

        $this->assertEquals(1, Order::all()->count());*/

    }

    /*
    public function test_user_can_see_orders_of_branch(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $order = $this->makeNewRepairOrder($login);

        $this->json('GET', route('orders.repair.branch.index', ['branch_id' => $this->getBranchesOfLogin($login)->first()->id]), [])
            ->assertJson(['prepay_sum'])->assertStatus(200);

    }
    */

}
