<?php

namespace Modules\Devices\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Companies\Entities\Branch;
use Modules\Customers\Entities\Customer;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Submodel;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Color;
use Modules\Devices\Entities\Device;
use Modules\Devices\Entities\CustomerHasDevice;

class DevicesTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();

        $this->login = $this->makeNewLoginWithCompanyAndBranch();
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

    private function createDevice($serial_nr){

        $response = $this->json('POST', route('devices.store', ['customer_id' => $this->customer->id]), [
        'submodel_id' => $this->submodel->id,
        'color_id' => $this->color->id,
        'serial_nr' => $serial_nr,
        'condition' => $this->faker->name
        ]);

        return $response;

    }

    private function updateDevice($device_id, $serial_nr, $condition){

        $response = $this->json('POST', route('devices.update', ['device_id' => $device_id]), [
            'submodel_id' => $this->submodel->id,
            'color_id' => $this->color->id,
            'serial_nr' => $serial_nr,
            'condition' => $condition
            ]);
    
            return $response;

    }

    private function getDevicesOfCustomer($customer_id){

        $response = $this->json('GET', route('customers.devices.index', ['customer_id' => $this->customer->id]));

        return $response;

    }

    public function test_device_can_be_created(){

        $response = $this->createDevice($this->faker->name);

        $response->assertJson(["message" => "device created"]);
        $response->assertStatus(200);

    }

    public function test_device_can_not_be_created_with_same_serial_nr(){

        $same_name = "sameSerialNr";

        $response = $this->createDevice($same_name);
        $response->assertStatus(200);
        $response = $this->createDevice($same_name);
        $response->assertStatus(422);

    }

    public function test_device_can_not_be_created_without_submodel(){

        $response = $this->json('POST', route('devices.store', ['customer_id' => $this->customer->id]), [
            'color_id' => $this->color->id,
            'serial_nr' => $this->faker->name,
            'condition' => $this->faker->name
        ]);
        
        $response->assertStatus(422);
    
    }

    public function test_device_can_be_created_without_condition(){

        $response = $this->json('POST', route('devices.store', ['customer_id' => $this->customer->id]), [
            'submodel_id' => $this->submodel->id,
            'color_id' => $this->color->id,
            'serial_nr' => "serialNr",
        ]);
    
        $response->assertStatus(200);

    }

    public function test_device_can_be_edited(){

        $this->createDevice("serialNr");

        $device = Device::where('serial_nr', "serialNr")->first();

        $response = $this->updateDevice($device->id, "NewSerialNr", "NewCondition");
        $response->assertStatus(200);

        $device = Device::find($device->id);

        $this->assertEquals($device->serial_nr, "NewSerialNr");
        $this->assertEquals($device->condition, "NewCondition");

    }

    public function test_user_can_see_all_devices_of_customer(){

        $response = $this->createDevice($this->faker->name);
        $response = $this->createDevice($this->faker->name);
        $response = $this->createDevice($this->faker->name);

        $response = $this->getDevicesOfCustomer($this->customer->id);

        $response->assertStatus(200);

    }


}
