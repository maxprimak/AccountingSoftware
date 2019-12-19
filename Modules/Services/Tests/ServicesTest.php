<?php

namespace Modules\Services\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServicesTest extends TestCase
{

    public function setUp(): void
    {

        parent::setUp();
        TestCase::setUpEnvironment();

        $this->login = $this->makeNewLoginWithCompanyAndBranch();
        $this->company = $this->getCompanyOfLogin($login);
        $this->part = $this->getParts($this->login)->random(1)->first();

        Passport::actingAs($this->login);

    }

    private function createNewServiceAs(/*$login, $parts_number = 0,*/ $name = "Service"){

        $response = $this->json('POST', route('services.store'), [
            'name' => $name,
            'part_id' => $this->part->id
        ]);//->assertJsonStructure([
           // 'message'
        //]);//->assertStatus(200);
        
        return $response;
    }

    private function updateServiceAs($service_id, $name = "Johnson"){

        $response = $this->json('POST', route('services.update'), [
            'name' => $name,
            'part_id' => $this->part->id
        ])->assertJsonStructure([
            'message'
        ])->assertStatus(200);

    }

    private function getAllServicesAsLogin(){

        $response = $this->json('GET', route('services.index'))
        ->assertJson([
            '*' => [
                'id',
                'name',
            ]
        ])->assertStatus(200);

        return $response;

    }

    public function test_user_can_see_all_services_of_his_company()
    {
        
        $this->createNewServiceAs();

        $response = $this->getAllServicesAsLogin();

        $response->dump();
        //TODO: get size of services of $this->company
        //TODO: get size of services of response
        //TODO: assertEquals(size of services of $this->company, size of response + size of default services)
    }

    /*
    public function test_user_can_see_all_default_services()
    {

        $response = $this->getAllServicesAsLogin();

        //TODO: get size of services of $this->company
        //TODO: get size of services of response
        //TODO: assertEquals(size of services of $this->company, size of default services, size of response)
    }

    public function test_user_can_not_see_services_of_another_companies()
    {
        
        $login2 = $this->makeNewLoginWithCompanyAndBranch();
        $company2 = $this->getCompanyOfLogin($login2);

        $this->createNewServiceAs($login2, 0, "Service1");
        $this->createNewServiceAs($login2, 0, "Service2");
        $this->createNewServiceAs($login2, 0, "Service3");

        $response = $this->getAllServicesAsLogin();

        //TODO: get size of services of response
        //TODO: assertEquals(size of default services, size of response)

    }

    public function test_user_can_create_new_service_with_one_or_more_parts()
    {

      $this->createNewServiceAs($login, 1, "Service1");
      $this->createNewServiceAs($login, 2, "Service2");
      $this->createNewServiceAs($login, 3, "Service3");
      $this->createNewServiceAs($login, 4, "Service4");

      //TODO: check that everything in DB

    }

    public function test_user_can_create_new_service_without_parts()
    {

        $this->createNewServiceAs($login, 0, "Service1");
        $this->createNewServiceAs($login, 0, "Service2");
        $this->createNewServiceAs($login, 0, "Service3");
        $this->createNewServiceAs($login, 0, "Service4");

      //TODO: check that everything in DB 

    }

    public function test_user_can_not_set_name_of_existing_service_to_another_service()
    {

        $service1 = $this->createNewServiceAs($login, 0, "Service1");
        $service2 = $this->createNewServiceAs($login, 0, "Service2");

        $this->updateServiceAs($login, $service2->id, "Service1");
        //TODO: error handling

        $this->updateServiceAs($login, $service1->id, "Service1");
        //this should work
    }

    public function test_user_can_set_new_name_to_service(){

        $service1 = $this->createNewServiceAs($login, 0, "Service1");
        
        $this->updateServiceAs($login, $service1->id, "ServiceNew");
        //TODO: error handling

    }

    public function test_user_can_not_make_a_copy_of_existing_service()
    {

        $service1 = $this->createNewServiceAs($login, 0, "Service1");

        $service2 = $this->createNewServiceAs($login, 0, "Service1");
        //last should return error

    }

    public function test_company_can_create_copy_of_service_if_this_service_belongs_to_another_company()
    {
        
        //create new login with another company and branch

        $service1 = $this->createNewServiceAs($login, 0, "Service1");

        $service2 = $this->createNewServiceAs($login2, 0, "Service1");
        //last should not return error

    }

    */
}
