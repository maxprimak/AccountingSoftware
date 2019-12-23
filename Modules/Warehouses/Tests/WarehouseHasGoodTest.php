<?php

namespace Modules\Warehouses\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Warehouses\Entities\Warehouse;
use Laravel\Passport\Passport;

class WarehouseHasGoodTest extends TestCase
{
  use RefreshDatabase;
  use WithFaker;

  public function setUp(): void
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


}
