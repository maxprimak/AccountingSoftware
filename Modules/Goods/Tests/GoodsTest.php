<?php

namespace Modules\Goods\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Modules\Goods\Entities\Good;
use Modules\Goods\Entities\BranchHasGood;
use Modules\Warehouses\Entities\WarehouseHasGood;
use Modules\Warehouses\Entities\Warehouse;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Models;
use Illuminate\Http\Request;



class GoodsTest extends TestCase
{
     use WithFaker;
     use RefreshDatabase;

     private $login;
     private $branch;

      public function setUp() : void
      {
         parent::setUp();
         TestCase::setUpEnvironment();

         $this->login = $this->makeNewLoginWithCompanyAndBranch();
         $this->branch = $this->getBranchesOfLogin($this->login)->first();
         $this->warehouse = $this->getWarehousesOfLogin($this->login)->first();
         $this->brand = $this->getBrands($this->login)->random(1)->first();
         $this->model = $this->getModels($this->login,$this->brand->id)->random(1)->first();
         $this->submodel = $this->getSubmodels($this->login,$this->model->id)->random(1)->first();
         $this->part = $this->getParts($this->login)->random(1)->first();
         $this->color = $this->getColors($this->login)->random(1)->first();
      }

    public function test_user_can_add_goods()
    {
        $request = [
          'part_id' => $this->part->id,
          'brand_id' => $this->brand->id,
          'model_id' => $this->model->id,
          'submodel_id' => $this->submodel->id,
          'color_id' => $this->color->id,
          //for WarehouseHasGood
          'warehouse_id' => $this->warehouse->id,
          'amount' => 3,
          'vendor_code' => "VEN:3432",
          //for Prices
          'retail_price' => 423,
          'wholesale_price' => 425,
        ];

        Passport::actingAs($this->login);

        $response = $this->json('POST', route('goods.store'), $request);
        $response->assertSuccessful();
        $response = $this->assertDatabaseHas('goods', [
          'part_id' => $this->part->id,
          'brand_id' => $this->brand->id,
          'model_id' => $this->model->id,
          'submodel_id' => $this->submodel->id,
          'color_id' => $this->color->id,
        ]);

        $good = Good::where([
        ['part_id',$this->part->id],
        ['brand_id',$this->brand->id],['model_id',$this->model->id],
        ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
        ])->first();

        $response = $this->assertDatabaseHas('warehouse_has_goods', [
          'good_id' => $good->id,
          'warehouse_id' => $this->warehouse->id,
          'amount' => 3,
          'vendor_code' => "VEN:3432",
        ]);
        $branch_id = $this->warehouse->getBranchId();

        $response = $this->assertDatabaseHas('good_has_prices', [
          'branch_id' => $branch_id,
          'good_id' => $good->id,
          'retail_price' => 423,
          'wholesale_price' => 425
        ]);

        return $request;
    }

    public function test_user_can_not_add_goods_if_required(){
        Passport::actingAs($this->login);

        $request = [
          'part_id' => $this->part->id,
          'brand_id' => $this->brand->id,
          'model_id' => $this->model->id,
          'submodel_id' => $this->submodel->id,
          'color_id' => $this->color->id,
        ];

        $route = route('goods.store');
        $response = $this;

        $this->checkValidationRequired($request, $route, $response);
    }


    public function test_user_can_delete_good(){
        Passport::actingAs($this->login);

        $request = $this->test_user_can_add_goods();
        $good = Good::where([
        ['part_id',$this->part->id],
        ['brand_id',$this->brand->id],['model_id',$this->model->id],
        ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
        ])->first();

        $warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$this->warehouse->id)->first();

        $response = $this->json('DELETE', route('warehouse_has_good.delete', ['warehouse_has_good_id' => $warehouse_has_good->id]));

        $response = $this->assertDatabaseMissing('warehouse_has_goods', [
          'id' => $warehouse_has_good->id,
          'good_id' => $good->id,
          'amount' => $warehouse_has_good->amount,
          'vendor_code' => $warehouse_has_good->vendor_code,
        ]);

        $response = $this->assertDatabaseMissing('goods', [
          'id' => $good->id,
        ]);
    }

    public function test_user_can_edit_good(){
        //After user edited good it will be created in DB
        Passport::actingAs($this->login);
        //FIRST WE ADD NEW GOOD
        $request = $this->test_user_can_add_goods();
        $good = Good::where([
        ['part_id',$this->part->id],
        ['brand_id',$this->brand->id],['model_id',$this->model->id],
        ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
        ])->first();

        $warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$this->warehouse->id)->first();
        $company = auth('api')->user()->getCompany();
        // $old_branch_has_good = BranchHasGood::where('good_id',$good->id)->where('branch_id',$this->warehouse->getBranchId())->first();

        //Define new values
        $new_color = $this->getColors($this->login)->random(1)->first();
        $new_vendor_code = "NEW_VEN";
        $new_retail_price = 878.99;
        $new_wholesale_price = 999.99;
        $new_amount = 55;

        //Make request
        $request['color_id'] = $new_color->id;

        $request['warehouse_has_good_id'] = $warehouse_has_good->id;
        $request['warehouse_id'] = null;
        $request['brand_id'] = null;
        $request['model_id'] = null;
        $request['submodel_id'] = null;
        $request['vendor_code'] = $new_vendor_code;
        $request['retail_price'] = $new_retail_price;
        $request['wholesale_price'] = $new_wholesale_price;
        $request['amount'] = $new_amount;

        $response = $this->json('POST', route('goods.update',['good_id' => $good->id]), $request)->assertSuccessful();

        $response = $response->decodeResponseJson();
        $good = $response['good'];
        //Check that DB has New Good
        $this->assertDatabaseHas('goods', [
          'id' => $good['id'],
          'part_id' => $this->part->id,
          'brand_id' => $this->brand->id,
          'model_id' => $this->model->id,
          'submodel_id' => $this->submodel->id,
          'color_id' => $new_color->id,
        ]);

        //Check That warehouse has this good and all changes which we have made
        $this->assertDatabaseHas('warehouse_has_goods', [
          'warehouse_id' => $warehouse_has_good->warehouse_id,
          'good_id' => $good['id'],
          'vendor_code' => $new_vendor_code,
          'amount' => $new_amount,
        ]);

        //Check that Good has new prices in the Branch
        $warehouse = Warehouse::find($warehouse_has_good->warehouse_id);
        $this->assertDatabaseHas('good_has_prices', [
          'good_id' => $good['id'],
          'branch_id' => $warehouse->getBranchId(),
          'retail_price' => $new_retail_price,
          'wholesale_price' => $new_wholesale_price
        ]);

    }

      public function test_user_can_see_goods(){

        $login = $this->makeNewLoginWithCompanyAndBranch();
        $login2 = $this->makeNewLoginWithCompanyAndBranch();
        $request = $this->test_user_can_add_goods();

        Passport::actingAs($login);

        $response = $this->json('GET', route('goods.index', ['warehouse_id' => $this->getWarehousesOfLogin($login)->first()->id]))
            ->assertStatus(200);

        // $response = $response->decodeResponseJson();
        // dd($response);

    }

    public function test_user_can_see_only_goods_of_his_company(){

      $login = $this->makeNewLoginWithCompanyAndBranch();
      $login2 = $this->makeNewLoginWithCompanyAndBranch();
      $request = $this->test_user_can_add_goods();

      Passport::actingAs($login);

      $this->json('GET', route('goods.index', ['warehouse_id' => $this->getWarehousesOfLogin($login)->first()->id]), [])
          ->assertStatus(200);

          //TODO::
      // $this->json('GET', route('goods.index', ['warehouse_id' => $this->getWarehousesOfLogin($login2)->first()->id]), [])
      //     ->assertStatus(403);

  }

  public function test_user_can_add_brand(){
      Passport::actingAs($this->login);
      $new_name = $this->faker->name();
      $request = ['name' => $new_name,'logo'  => "https://cdn1.iconfinder.com/data/icons/startup-2/64/BRAND-512.png"];

      $response = $this->json('POST', route('brands.store'), $request)->assertStatus(200);

      $response = $this->assertDatabaseHas('brands', [
        'name' => $new_name,
        'logo' => "https://cdn1.iconfinder.com/data/icons/startup-2/64/BRAND-512.png",
      ]);

      $new_brand = Brand::where('name',$new_name)->where('logo',"https://cdn1.iconfinder.com/data/icons/startup-2/64/BRAND-512.png")->firstOrFail();

      $company = $this->login->getCompany();

      $response = $this->assertDatabaseHas('company_has_brands', [
        'brand_id' => $new_brand->id,
        'company_id' => $company->id,
      ]);

      return $new_brand;
  }

  public function test_user_can_add_model(){
    Passport::actingAs($this->login);
    for($i = 0; $i < 2; $i++){
      $brand_id = $this->test_user_can_add_brand()->id;
      $name = $this->faker->unique()->name;
      $logo = $this->faker->unique()->name;
      $response = $this->json('POST', route('models.store'), [
        'brand_id' => $brand_id,
        'name' => $name,
        'logo' => $logo
      ])->assertStatus(200);

      $response = $this->assertDatabaseHas('models', [
        'brand_id' => $brand_id,
        'name' => $name,
        'logo' => $logo
      ]);

      $company = $this->login->getCompany();
      $new_model = Models::where('name',$name)->where('brand_id',$brand_id)->where('logo',$logo)->firstOrFail();

      $response = $this->assertDatabaseHas('company_has_models', [
        'model_id' => $new_model->id,
        'company_id' => $company->id,
      ]);
    }
  }

  public function test_user_can_move_goods(){
    Passport::actingAs($this->login);
    $request = $this->test_user_can_add_goods();
    $good_ids = Good::where([
    ['part_id',$this->part->id],
    ['brand_id',$this->brand->id],['model_id',$this->model->id],
    ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
    ])->pluck('id')->toArray();

    $warehouse_has_good = WarehouseHasGood::whereIn('good_id',$good_ids)->where('warehouse_id',$this->warehouse->id)->first();
    $login2 = $this->makeNewLoginWithCompanyAndBranch();
    $amount_which_we_should_move = $warehouse_has_good->amount - 1;
    $target_warehouse = $this->getWarehousesOfLogin($login2)->first();

    $expected_our_amount = $warehouse_has_good->amount - $amount_which_we_should_move;
    $expected_target_warehouse_amount = $amount_which_we_should_move;

    $request = ['warehouse_id' => $target_warehouse->id,'warehouse_has_good_id' => $warehouse_has_good->id,
    'amount' => $amount_which_we_should_move,'stock_amount' => $warehouse_has_good->amount];
    $response = $this->json('POST', route('warehouse_has_good.moveGoodToWarehouse'), $request)->assertStatus(200);

    //Check Results
    $good_ids = Good::where([
    ['part_id',$this->part->id],
    ['brand_id',$this->brand->id],['model_id',$this->model->id],
    ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
    ])->pluck('id')->toArray();

    $warehouse_has_good = WarehouseHasGood::whereIn('good_id',$good_ids)->where('warehouse_id',$this->warehouse->id)->first();
    $target_warehouse_has_good = WarehouseHasGood::whereIn('good_id',$good_ids)->where('warehouse_id',$target_warehouse->id)->first();
    //check that our warehouse lost amount which we moved
    $this->assertEquals(
            $expected_our_amount,
            $warehouse_has_good->amount,
            "actual amount in our warehouse is not equals to expected amount after moving goods"
        );

    //check that target warehouse has amount which we moved
    $this->assertEquals(
            $expected_target_warehouse_amount,
            $target_warehouse_has_good->amount,
            "actual amount in warehouse,where we have moved goods is not equals to expected amount"
        );

    //TEST THAT HE CAN NOT MOVE MORE PARTS THEN IN STOCK
    $amount_which_we_should_move += 10;
    $request = ['warehouse_id' => $target_warehouse->id,'warehouse_has_good_id' => $warehouse_has_good->id,
    'amount' => $amount_which_we_should_move,'stock_amount' => $warehouse_has_good->amount];
    $response = $this->json('POST', route('warehouse_has_good.moveGoodToWarehouse'), $request)->assertStatus(422);


    //test that user can move goods which already exists in target warehouse

    $amount_which_we_should_move = $warehouse_has_good->amount;
    $request = ['warehouse_id' => $target_warehouse->id,'warehouse_has_good_id' => $warehouse_has_good->id,
    'amount' => $amount_which_we_should_move,'stock_amount' => $warehouse_has_good->amount];
    $response = $this->json('POST', route('warehouse_has_good.moveGoodToWarehouse'), $request)->assertStatus(200);

    //CHAECK RESULTS
    $good_ids = Good::where([
    ['part_id',$this->part->id],
    ['brand_id',$this->brand->id],['model_id',$this->model->id],
    ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
    ])->pluck('id')->toArray();

    $expected_our_amount = $amount_which_we_should_move - $warehouse_has_good->amount;
    $expected_target_warehouse_amount = $target_warehouse_has_good->amount + $amount_which_we_should_move;
    $warehouse_has_good = WarehouseHasGood::whereIn('good_id',$good_ids)->where('warehouse_id',$this->warehouse->id)->first();
    $target_warehouse_has_good = WarehouseHasGood::whereIn('good_id',$good_ids)->where('warehouse_id',$target_warehouse->id)->first();
    //check that our warehouse lost amount which we moved

    $this->assertEquals(
            $expected_our_amount,
            $warehouse_has_good->amount,
            "actual amount in our warehouse is not equals to expected amount after moving goods"
        );

    //check that target warehouse has amount which we moved + his old amount

    $this->assertEquals(
            $expected_target_warehouse_amount,
            $target_warehouse_has_good->amount,
            "actual amount in warehouse,where we have moved goods is not equals to expected amount"
        );
  }

  public function test_user_can_update_warehouse_has_good(){
      Passport::actingAs($this->login);
      $request = $this->test_user_can_add_goods();
      $good = Good::where([
      ['part_id',$this->part->id],
      ['brand_id',$this->brand->id],['model_id',$this->model->id],
      ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
      ])->first();

      $warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$this->warehouse->id)->first();
      $old_amount = $warehouse_has_good->amount;
      $new_amount = 23;
      $new_vendor_code = "HUIPISI";
      $request = ['vendor_code' => $new_vendor_code,'amount' => $new_amount];
      $response = $this->json('POST', route('warehouse_has_good.update',$warehouse_has_good), $request)->assertStatus(200);

      $warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$this->warehouse->id)->first();

      $this->assertEquals(
              $new_amount,
              $warehouse_has_good->amount,
              "amount is wrong"
          );

      $this->assertEquals(
              $new_vendor_code,
              $warehouse_has_good->vendor_code,
              "vendor code is wrong"
          );
  }


}
