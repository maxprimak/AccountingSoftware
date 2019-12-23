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
use Modules\Goods\Entities\Brand;
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

        $response = $this->assertDatabaseHas('warehouse_has_goods', [
          'warehouse_id' => $this->warehouse->id,
          'amount' => 3,
          'vendor_code' => "VEN:3432",
        ]);

        $good = Good::where([
        ['part_id',$this->part->id],
        ['brand_id',$this->brand->id],['model_id',$this->model->id],
        ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
        ])->first();

        $response = $this->assertDatabaseHas('branch_has_goods', [
          'branch_id' => $this->warehouse->getBranchId(),
          'good_id' => $good->id
        ]);

        $response = $this->assertDatabaseHas('good_has_prices', [
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


    public function test_user_can_delete_warehouse_has_good(){
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
    }

    public function test_user_can_edit_good(){

        Passport::actingAs($this->login);

        $request = $this->test_user_can_add_goods();
        $good = Good::where([
        ['part_id',$this->part->id],
        ['brand_id',$this->brand->id],['model_id',$this->model->id],
        ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
        ])->first();
        $new_color = $this->getColors($this->login)->random(1)->first();
        $warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$this->warehouse->id)->first();
        $old_branch_has_good = BranchHasGood::where('good_id',$good->id)->where('branch_id',$this->warehouse->getBranchId())->first();

        $request['color_id'] = $new_color->id;
        $request['warehouse_has_good_id'] = $warehouse_has_good->id;

        $response = $this->json('POST', route('goods.update',['good_id' => $good->id]), $request);
        $response = $this->assertDatabaseMissing('goods', [
          'id' => $good->id,
          'color_id' => $new_color->id,
        ]);

        $updated_good = Good::where('color_id',$new_color->id)->first();

        $response = $this->assertDatabaseHas('goods', [
          'id' => $updated_good->id,
          'color_id' => $new_color->id
        ]);

        $response = $this->assertDatabaseMissing('warehouse_has_goods', [
          'id' => $warehouse_has_good->id,
          'good_id' => $good->id,
        ]);

        $response = $this->assertDatabaseHas('warehouse_has_goods', [
          'warehouse_id' => $this->warehouse->id,
          'good_id' => $updated_good->id
        ]);
        // $response = $this->assertDatabaseMissing('branch_has_goods', [
        //   'good_id' => $good->id,
        //   'branch_id' => $this->warehouse->getBranchId()
        // ]);
        // dd($good->id,$updated_good->id);

        $updated_branch_has_good = BranchHasGood::where('good_id',$updated_good->id)->where('branch_id',$this->warehouse->getBranchId())->first();
        $response = $this->assertDatabaseHas('branch_has_goods', [
          'id' => $updated_branch_has_good->id,
          'good_id' => $updated_good->id,
          'branch_id' => $this->warehouse->getBranchId()
        ]);

        $response = $this->assertDatabaseHas('good_has_prices', [
          'branch_has_good_id' => $updated_branch_has_good->id,
        ]);

        // $response = $this->assertDatabaseMissing('good_has_prices', [
        //   'branch_has_good_id' => $old_branch_has_good->id,
        // ]);

    }

    public function test_user_can_see_only_goods_of_his_company(){

      $login = $this->makeNewLoginWithCompanyAndBranch();
      $login2 = $this->makeNewLoginWithCompanyAndBranch();
      $request = $this->test_user_can_add_goods();

      Passport::actingAs($login);

      $this->json('GET', route('goods.index', ['warehouse_id' => $this->getWarehousesOfLogin($login)->first()->id]), [])
          ->assertStatus(200);

      $this->json('GET', route('goods.index', ['warehouse_id' => $this->getWarehousesOfLogin($login2)->first()->id]), [])
          ->assertStatus(403);

  }

  public function test_user_can_add_brand(){
      Passport::actingAs($this->login);
      $new_name = $this->faker->name();
      $request = ['name' => $new_name,'logo'  => "https://cdn1.iconfinder.com/data/icons/startup-2/64/BRAND-512.png"];

      $response = $this->json('POST', route('brands.store'), $request)->assertStatus(200);

      $response = $this->assertDatabaseHas('brands', [
        'name' => $new_name,
        'logo' => "https://cdn1.iconfinder.com/data/icons/startup-2/64/BRAND-512.png"
      ]);
      $new_brand = Brand::where('name',$new_name)->where('logo',"https://cdn1.iconfinder.com/data/icons/startup-2/64/BRAND-512.png")->firstOrFail();
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
    }
  }

  public function test_user_can_move_goods(){
    Passport::actingAs($this->login);
    $request = $this->test_user_can_add_goods();
    $good = Good::where([
    ['part_id',$this->part->id],
    ['brand_id',$this->brand->id],['model_id',$this->model->id],
    ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
    ])->first();

    $warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$this->warehouse->id)->first();
    $login2 = $this->makeNewLoginWithCompanyAndBranch();
    $amount_which_we_should_move = $warehouse_has_good->amount - 1;
    $target_warehouse = $this->getWarehousesOfLogin($login2)->first();
    $target_warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$target_warehouse->id)->first();

    if(!$target_warehouse_has_good){
      $request_for_store = new Request();
      $request_for_store->good_id = $good->id;
      $request_for_store->warehouse_id = $target_warehouse->id;
      $request_for_store->amount = 5;

      $target_warehouse_has_good = new WarehouseHasGood();
      $target_warehouse_has_good = $target_warehouse_has_good->store($request_for_store);
    }

    $expected_our_amount = $warehouse_has_good->amount - $amount_which_we_should_move;
    if($target_warehouse_has_good){
      $expected_target_warehouse_amount = $target_warehouse_has_good->amount + $amount_which_we_should_move;
    }else{
      $expected_target_warehouse_amount = $amount_which_we_should_move;
    }
    $request = ['warehouse_id' => $target_warehouse->id,'warehouse_has_good_id' => $warehouse_has_good->id,'stock_amount' => $warehouse_has_good->amount,'amount' => $amount_which_we_should_move];
    $response = $this->json('POST', route('warehouse_has_good.moveGoodToWarehouse'), $request)->assertStatus(200);

    //Check Results
    $warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$this->warehouse->id)->first();
    $target_warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$target_warehouse->id)->first();
    //check that our warehouse lost amount which we moved
    $this->assertEquals(
            $expected_our_amount,
            $warehouse_has_good->amount,
            "actual amount in our warehouse is not equals to expected amount after moving goods"
        );

    //check that our warehouse lost amount which we moved
    $this->assertEquals(
            $expected_target_warehouse_amount,
            $target_warehouse_has_good->amount,
            "actual amount in warehouse,where we have moved goods is not equals to expected amount"
        );
  }

  public function test_user_can_not_move_more_goods_then_in_stock(){
      Passport::actingAs($this->login);
      $request = $this->test_user_can_add_goods();
      $good = Good::where([
      ['part_id',$this->part->id],
      ['brand_id',$this->brand->id],['model_id',$this->model->id],
      ['submodel_id',$this->submodel->id],['color_id',$this->color->id]
      ])->first();

      $warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$this->warehouse->id)->first();
      $login2 = $this->makeNewLoginWithCompanyAndBranch();
      $amount_which_we_should_move = $warehouse_has_good->amount + 2;
      $target_warehouse = $this->getWarehousesOfLogin($login2)->first();
      $target_warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$target_warehouse->id)->first();
      if(!$target_warehouse_has_good){
        $request_for_store = new Request();
        $request_for_store->good_id = $good->id;
        $request_for_store->warehouse_id = $target_warehouse->id;
        $request_for_store->amount = 5;

        $target_warehouse_has_good = new WarehouseHasGood();
        $target_warehouse_has_good = $target_warehouse_has_good->store($request_for_store);
      }

      $old_amount_our_warehouse = $warehouse_has_good->amount;
      $old_amount_target_warehouse = $target_warehouse_has_good->amount;

      $request = ['warehouse_id' => $target_warehouse->id,'warehouse_has_good_id' => $warehouse_has_good->id,'stock_amount' => $warehouse_has_good->amount,'amount' => $amount_which_we_should_move];
      $response = $this->json('POST', route('warehouse_has_good.moveGoodToWarehouse'), $request)->assertStatus(422);

      //Check Results
      $warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$this->warehouse->id)->first();
      $target_warehouse_has_good = WarehouseHasGood::where('good_id',$good->id)->where('warehouse_id',$target_warehouse->id)->first();

      //check that our warehouse has same amount like before we moved
      $this->assertEquals(
              $old_amount_our_warehouse,
              $warehouse_has_good->amount,
              "amount has been changed but it is wrong"
          );

      //check that target warehouse has same amount like before we moved
      $this->assertEquals(
              $old_amount_target_warehouse,
              $target_warehouse_has_good->amount,
              "amount has been changed but it is wrong"
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
