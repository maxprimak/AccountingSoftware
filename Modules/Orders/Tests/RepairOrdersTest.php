<?php

namespace Modules\Orders\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Modules\Orders\Entities\Order;
use Modules\Devices\Tests\DevicesTest;
use Modules\Companies\Entities\Branch;
use Modules\Customers\Entities\Customer;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Submodel;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Color;
use Modules\Orders\Entities\Warranty;
use Modules\Orders\Entities\DiscountCode;
use Modules\Orders\Entities\OrderStatusesTranslation;
use Modules\Orders\Entities\OrderStatus;
use Modules\Orders\Entities\RepairOrder;

class RepairOrdersTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();
        $this->login = $this->makeNewLoginWithCompanyAndBranch();
        $this->makeWarrantyForCompanyOfLogin($this->login);
        $this->makeDiscountCodeForCompanyOfLogin($this->login);
        $this->company = $this->getCompanyOfLogin($this->login);

        $this->branch = Branch::whereIn('id', $this->getBranchesOfLogin($this->login))->first();
        $this->addCustomersToBranch($this->branch, $this->login, 1);
        $this->customer = Customer::whereIn('id', $this->getCustomersOfLogin($this->login))->first();

        Passport::actingAs($this->login);

        $this->storeBrands($this->login, 1);
        $this->storeModels($this->login, 1);
        $model_id = Models::first()->id;
        $this->storeSubmodels($this->login,$model_id,1);
        $this->storeColors($this->login, 1);

        $this->submodel = Submodel::first();
        $this->color = Color::first();

    }

    public function test_user_can_create_repair_order(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $repair_order = $this->makeNewRepairOrder($login);

        $this->assertNotEquals($repair_order, null);

    }

    public function test_user_can_update_repair_order(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $order = $this->makeNewRepairOrder($login);

        $number = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 1000);
        $order_nr = $this->faker->swiftBicNumber();
        $comment = $this->faker->text(50);
        $prepay_sum = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 19);

        $this->json('POST', route('orders.repair.update', ['order_id' => $order->id]), [
            'price' => $number,
            'order_nr' => $order_nr,
            'comment' => $comment,
            'prepay_sum' => $prepay_sum
        ])->assertJsonStructure([
            'status', 'order'
        ])->assertStatus(200);

        $this->assertEquals(1, Order::all()->count());

    }

    /*
    public function test_user_can_see_orders_of_branch(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $order = $this->makeNewRepairOrder($login);

        $this->json('GET', route('orders.repair.branch.index', ['branch_id' => $this->getBranchesOfLogin($login)->first()->id]), [])
            ->assertStatus(200);

    }

    public function test_user_can_see_only_orders_of_his_company(){

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $login2 = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $this->json('GET', route('orders.repair.branch.index', ['branch_id' => $this->getBranchesOfLogin($login)->first()->id]), [])
            ->assertStatus(200);

        $this->json('GET', route('orders.repair.branch.index', ['branch_id' => $this->getBranchesOfLogin($login2)->first()->id]), [])
            ->assertStatus(403);

    }

    public function test_user_can_delete_repair_order(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $order = $this->makeNewRepairOrder($login);

        $this->json('DELETE', route('orders.repair.destroy', ['branch_id' => $order->id]), [])
        ->assertJson(["status" => "Successfully deleted"])->assertStatus(200);
    }

    public function test_validator_create(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $response = $this;

        $data = [
            'accept_date',
            'price',
            'branch_id',
            'order_nr',
            'customer_name',
            'customer_phone',
            'defect_description',
        ];

        $this->checkValidationRequired($data, route('orders.repair.store'),$response);

    }

    public function test_validator_update(){

        $login = $this->makeNewLoginWithCompanyAndBranch();

        Passport::actingAs($login);

        $order = $this->makeNewRepairOrder($login);

        $response = $this;

        $data = [
            'accept_date',
            'price',
            'order_nr',
            'customer_name',
            'customer_phone',
            'defect_description',
            'status',
        ];

        $this->checkValidationRequired($data, route('orders.repair.update', ['order_id' => $order->id]),$response);

        $order = $this->makeNewRepairOrder($login);

    }
    */

}
