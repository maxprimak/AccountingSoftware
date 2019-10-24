<?php

namespace Modules\Orders\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Modules\Orders\Entities\Order;

class SalesOrdersTest extends TestCase
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

    /*
    public function test_user_can_create_sales_orders(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $response = $this->json('POST', route('orders.sales.store'),[
            'accept_date' => $this->faker->date('Y-m-d', '1461067200'),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 1000),
            'branch_id' => $this->getBranchesOfLogin($login)->first()->id,
            'article_description' => $this->faker->text(),
            'payment_type_id' => $this->faker->numberBetween(1,2)
        ])->assertJsonStructure([
            'status',
            'order' => [
                'id',
                'accept_date',
                'price',
                'branch_id',
                'article_description',
                'payment_type_id',
                'created_at',
                'updated_at',
                'created_by',
            ]
        ])->assertStatus(200);

    }
    */


    public function test_user_can_update_sales_orders(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $order = $this->makeNewSalesOrder($login);

        $response = $this->json('POST', route('orders.sales.update', ['order_id' => $order->id]),[
            'accept_date' => $this->faker->date('Y-m-d', '1461067200'),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 1000),
            'article_description' => $this->faker->text(),
            'payment_type_id' => $this->faker->numberBetween(1,2)
        ])->assertJsonStructure([ //GIVES ERROR SOMETIMES
            'status',
            'order' => [
                'id',
                'accept_date',
                'price',
                'branch_id',
                'article_description',
                'payment_type_id',
                'created_at',
                'updated_at',
                'created_by',
            ]
        ])->assertStatus(200);

    }


    /*
    public function test_user_can_see_orders_of_branch(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $order = $this->makeNewSalesOrder($login);

        $this->json('GET', route('orders.sales.branch.index', ['branch_id' => $this->getBranchesOfLogin($login)->first()->id]), [])
            ->assertJson(['article_description'])->assertStatus(200);

    }
    */

}
