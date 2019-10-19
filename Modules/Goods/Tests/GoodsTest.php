<?php

namespace Modules\Goods\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
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
         $this->brand = $this->getBrands($this->login)->random()->first();
         $this->model = $this->getModels($this->login)->random()->first();
         $this->submodel = $this->getSubmodels($this->login)->random()->first();
         $this->part = $this->getParts($this->login)->random()->first();
         $this->color = $this->getColors($this->login)->random()->first();
         // dd($this->branch);

      }

    public function test_user_can_add_goods()
    {
        $good = [
          'part_id' => $this->part->id,
          'branch_id' =>  $this->branch->id,
          'brand_id' => $this->brand->id,
          'model_id' => $this->model->id,
          'submodel_id' => $this->submodel->id,
          'color_id' => $this->color->id,
          'amount' => 30,
          'price' => 233.45
        ];

        Passport::actingAs($this->login);

        $response = $this->json('POST', route('goods.store'), $good);
        $response->assertSuccessful();
        $response = $this->assertDatabaseHas('goods', [
          'part_id' => $this->part->id,
          'branch_id' =>  $this->branch->id,
          'brand_id' => $this->brand->id,
          'model_id' => $this->model->id,
          'submodel_id' => $this->submodel->id,
          'color_id' => $this->color->id,
          'amount' => 30,
          'price' => 233.45
        ]);
    }

    public function testExample()
    {
        $this->assertTrue(true);
    }
}
