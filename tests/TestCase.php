<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Entities\User;
use Modules\Login\Entities\Login;
use Modules\Employees\Entities\Employee;
use Modules\Employees\Entities\Role;
use Modules\Users\Entities\UserHasBranch;
use Modules\Users\Entities\People;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Currency;
use Modules\Companies\Entities\Branch;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Entities\CustomerType;
use Modules\Customers\Entities\CustomerHasBranch;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;

      public function setUpLogin(){
         $login = factory(Login::class)->create([
              'username' => $this->faker->unique()->firstName(),
              'password' => Hash::make('123456789'),
              'email' => $this->faker->email(),
          ]);
          return $login;
      }

      public function setUpPerson(){
        $person = factory(People::class)->create();
        return $person;
      }

      public function setUpCurrency(){
        $this->currency = factory(Currency::class)->create(['name' => $this->faker->currencyCode . str_random(10), 'symbol' => $this->faker->countryCode . str_random(10)]);
        return $this->currency;
      }

      public function setUpCompany($currency){
         $this->company = factory(Company::class)->create(['name'=> $this->faker->name . str_random(10),'currency_id' => $currency->id]);
         return $this->company;
      }

      public function setUpBranch($company){
         $this->branch = factory(Branch::class)->create(['name' => $this->faker->name . str_random(10),'company_id' => $company->id]);
         return $this->branch;
      }

      public function setUpUser($login,$person,$company){
        $this->user = factory(User::class)->create([
             'login_id' => $login->id,
             'person_id' => $person->id,
             'company_id' => $company->id,
         ]);
         return $this->user;
      }

      public function setUpUserHasBranch($user,$branch){
        $this->user_has_branch = factory(UserHasBranch::class)->create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
        ]);
        return $this->user_has_branch;
      }

      public function setUpRole(){
        $this->role = factory(Role::class)->create([
            'name' => 'Head',
        ]);
        return $this->role;
      }

      public function setUpEmployee($user,$role,$branch){
        $employee = factory(Employee::class)->create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
        return $employee;
      }

      public function setUpCustomerType(){
        $this->type = factory(CustomerType::class)->create([
            'name' => 'Person',
        ]);
        return $this->type;
      }

      public function setUpCustomer($type,$person,$company,$user){
        $this->customer = factory(Customer::class)->create([
            'person_id' => $this->person->id,
            'email' => $this->faker->email  . str_random(20),
            'type_id' => $this->type->id,
            'company_id' => $this->company->id,
            'created_by' => $this->user->id
        ]);
        return $this->customer;
      }

      public function setUpCustomerHasBranch($customer,$branch){
        $this->customer_has_branch = factory(CustomerHasBranch::class)->create([
            'customer_id' => $this->customer,
            'branch_id' => $this->branch->id,
        ]);
        return $this->customer_has_branch;
      }

    public function checkValidationIfRequired($data, $login,$route,$keys_not_required = array()){

        foreach($data as $key => $value){
            if(in_array($key, $keys_not_required)) continue;

            $data[$key] = null;
            $response = $this->actingAs($login)->json('POST', route($route),$data);
            $response->assertStatus(422);

            $data[$key] = $value;
        }
      }

        public function makeResponseWithNewAuthLogin(){

          $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->firstName()
          ]);
        
          $tokenResult = $login->createToken('Personal Access Token');

          $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$tokenResult->accessToken
          ]);

          return $response;

        }


}
