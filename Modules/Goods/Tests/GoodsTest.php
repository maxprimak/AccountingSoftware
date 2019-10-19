<?php

namespace Modules\Goods\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;


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
          'branch_id' =>  $this->branch->id,
          'brand_id' => $this->brand->id,
          'model_id' => $this->model->id,
          'submodel_id' => $this->submodel->id,
          'color_id' => $this->color->id,
          'amount' => 30,
          'price' => 233.78
        ];

        Passport::actingAs($this->login);

        $response = $this->json('POST', route('goods.store'), $request);
        $response->assertSuccessful();
        $response = $this->assertDatabaseHas('goods', [
          'part_id' => $this->part->id,
          'branch_id' =>  $this->branch->id,
          'brand_id' => $this->brand->id,
          'model_id' => $this->model->id,
          'submodel_id' => $this->submodel->id,
          'color_id' => $this->color->id,
          'amount' => 30,
          'price' => 233.78
        ]);
    }

    public function test_user_can_not_add_goods_if_required(){
        Passport::actingAs($this->login);

        $request = [
          'part_id' => $this->part->id,
          'branch_id' =>  $this->branch->id,
          'brand_id' => $this->brand->id,
          'model_id' => $this->model->id,
          'submodel_id' => $this->submodel->id,
          'color_id' => $this->color->id,
          'amount' => 500,
          'price' => 233.67
        ];

        $route = route('goods.store');
        $response = $this;

        $this->checkValidationRequired($request, $route, $response);
    }

}
