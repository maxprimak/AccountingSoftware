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

  }

}
