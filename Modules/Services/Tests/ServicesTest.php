<?php

namespace Modules\Services\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Services\Entities\Service;
use Modules\Services\Entities\ServicesTranslation;

class ServicesTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();

        $this->login = $this->makeNewLoginWithCompanyAndBranch();
        $this->company = $this->getCompanyOfLogin($this->login);
        $this->part = TestCase::createPart("Part1");

        Passport::actingAs($this->login);

    }

    private function createNewServiceAs($login, $name = "Service", $parts_number = 1){

        Passport::actingAs($login);

        $data = ($parts_number == 1) ? [
            'name' => $name,
            'part_id' => $this->part->id
        ] : [
            'name' => $name,
        ];

        $response = $this->json('POST', route('services.store'), $data)->assertJsonStructure([
           'message'
        ]);

        Passport::actingAs($this->login);
        
        return $response;
    }

    private function updateServiceAs($login, $service_id, $name = "Johnson"){

        $response = $this->json('POST', route('services.update', ['service_id' => $service_id]), [
            'name' => $name,
            'part_id' => $this->part->id
        ])->assertJsonStructure([
            'message'
        ]);

        return $response;

    }

    private function getAllServicesAsLogin(){

        $response = $this->json('GET', route('services.index'))
                    ->assertStatus(200);

        return $response;

    }

    public function test_user_can_see_all_services_of_his_company()
    {
        $this->createNewServiceAs($this->login, "MyService1");
        $this->createNewServiceAs($this->login, "MyService2");

        $response = $this->getAllServicesAsLogin();

        //user should get 5 services => 3 default + 2 custom
        $this->assertEquals(5, sizeof($response->decodeResponseJson()));
    }

    public function test_user_can_see_all_default_services()
    {

        $response = $this->getAllServicesAsLogin();

        //user should get 3 services => 3 default + 0 custom
        $this->assertEquals(3, sizeof($response->decodeResponseJson()));
    }

    public function test_user_can_not_see_services_of_another_companies()
    {
        
        $login2 = $this->makeNewLoginWithCompanyAndBranch();
        $company2 = $this->getCompanyOfLogin($login2);

        $this->createNewServiceAs($this->login, "MyService1");
        $this->createNewServiceAs($this->login, "MyService2");

        $this->createNewServiceAs($login2, "OtherService1");
        $this->createNewServiceAs($login2, "OtherService2");
        $this->createNewServiceAs($login2, "OtherService3");

        $response = $this->getAllServicesAsLogin();

        //user should get 5 services => 3 default + 2 custom
        $this->assertEquals(5, sizeof($response->decodeResponseJson()));

    }

    public function test_user_can_create_new_service_with_one_part()
    {

        $service_name = "ServiceWithOnePart";
        $this->createNewServiceAs($this->login, $service_name, 1);

        $this->assertDatabaseHas('services_translations', [
            'name' => $service_name
        ]);

    }

    public function test_user_can_create_new_service_without_parts()
    {
        $service_name = "ServiceWithoutParts";
        $this->createNewServiceAs($this->login, $service_name, 0);

        $this->assertDatabaseHas('services_translations', [
            'name' => $service_name
        ]);

    }

    public function test_user_can_not_set_name_of_existing_service_to_another_service()
    {

        $this->createNewServiceAs($this->login, "Service1");
        $this->createNewServiceAs($this->login, "Service2");

        $service1 = Service::find(ServicesTranslation::where('name', "Service1")->first()->service_id);
        $service2 = Service::find(ServicesTranslation::where('name', "Service2")->first()->service_id);

        $response = $this->updateServiceAs($this->login, $service2->id, "Service1");
        $response->assertStatus(422);

        $response = $this->updateServiceAs($this->login, $service1->id, "Service1");
        $response->assertStatus(200);
    }

    public function test_user_can_set_new_name_to_service(){

        $this->createNewServiceAs($this->login, "Service1");
        $service1 = Service::find(ServicesTranslation::where('name', "Service1")->first()->service_id);

        $response = $this->updateServiceAs($this->login, $service1->id, "ServiceNew");
        $response->assertStatus(200);

    }

    public function test_user_can_not_make_a_copy_of_existing_service()
    {

        $response = $this->createNewServiceAs($this->login,"Service1");
        $response->assertStatus(200);

        $response = $this->createNewServiceAs($this->login,"Service1");
        $response->assertStatus(422);

    }

    public function test_company_can_create_copy_of_service_if_this_service_belongs_to_another_company()
    {   
        $login2 = $this->makeNewLoginWithCompanyAndBranch();
        
        $response = $this->createNewServiceAs($this->login,"Service1");
        $response->assertStatus(200);

        $response = $this->createNewServiceAs($login2, "Service1");
        $response->assertStatus(200);

    }

}
