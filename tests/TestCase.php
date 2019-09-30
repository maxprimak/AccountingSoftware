<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Entities\User;
use Modules\Login\Entities\Login;
use Modules\Employees\Entities\Employee;
use Modules\Employees\Entities\Role;
use Modules\Users\Entities\UserHasBranch;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Entities\CustomerHasBranch;
use Modules\Users\Entities\People;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Currency;
use Modules\Companies\Entities\Branch;
use Modules\Customers\Entities\CustomerType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;

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

    /////////////////////////////////////////////

        public function makeNewLogin(){

          $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->firstName()
          ]);

          return $login;

        }

        public function makeNewLoginWithCompanyAndBranch(){

          $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->firstName()
          ]);
        
          Passport::actingAs($login);

          $this->json('POST', route('registration.store'),[
            'company_name' => $this->faker->name(),
            'company_phone' => $this->faker->phoneNumber(),
            'company_address' => $this->faker->address(),
            'currency_id' => 1,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address()
          ])->assertStatus(200);

          return $login;

        }

        public function getUserOfLogin($login){
          return User::where('login_id', $login->id)->first();
        }

        public function getCompanyOfLogin($login){
          return Company::find(User::where('login_id', $login->id)->firstOrFail()->company_id);
        }

        public function getBranchesOfLogin($login){
          $user = $this->getUserOfLogin($login);
          return Branch::whereIn('id', UserHasBranch::where('user_id', $user->id)->pluck('branch_id')->toArray())->get();
        }

        public function getCustomersOfLogin($login){

          $user = $this->getUserOfLogin($login);
          $branch_ids = $this->getBranchesOfLogin($login)->pluck('id')->toArray();

          $customers = Customer::whereIn('id', CustomerHasBranch::whereIn('branch_id', $branch_ids)->pluck('customer_id')->toArray())->get();

          return $customers;

        }

        public function getEmployeesOfLogin($login){

          $user = $this->getUserOfLogin($login);
          $branch_ids = $this->getBranchesOfLogin($login)->pluck('id')->toArray();

          $employees = Employee::whereIn('user_id', UserHasBranch::whereIn('branch_id', $branch_ids)->pluck('user_id')->toArray())->get();

          return $employees;

        }

        public static function setUpEnvironment(){

          Artisan::call('passport:install');

          if(Currency::all()->count() == 0){
            factory(Currency::class)->create(['name' => 'Ukrainian HRYVNA', 'symbol' => 'UAH', 'id' => 1]);
          }
  
          if(Role::all()->count() == 0){
            factory(Role::class)->create(['name' => 'Head', 'id' => 1]);
            factory(Role::class)->create(['name' => 'Top Manager', 'id' => 2]);
            factory(Role::class)->create(['name' => 'Tech', 'id' => 3]);
            factory(Role::class)->create(['name' => 'Sales Manager', 'id' => 4]);
            factory(Role::class)->create(['name' => 'Courier', 'id' => 5]);
          }

          if(CustomerType::all()->count() == 0){
            factory(CustomerType::class)->create(['name' => 'Person', 'id' => 1]);
            factory(CustomerType::class)->create(['name' => 'Company', 'id' => 2]);
          }

        }

        public function addBranchesToLogin($login, $number_of_branches){

          Passport::actingAs($login);

          for($i = 0; $i < $number_of_branches; $i++){

            $response = $this->json('POST', route('branches.store'),[
              'name' => $this->faker->unique()->firstName(),
              'color' => '#F64272'
            ])->assertJsonStructure(['message', 'branch']);
            $response->assertStatus(200);

          }

        }

        public function checkValidationRequired($data, $route, $response){

          foreach($data as $key => $value){
    
              $data[$key] = null;

              $response->json('POST', $route, $data)->assertStatus(422);

              $data[$key] = $value;

          }
    
        }

        public function checkValidationUnique($not_unique_data, $required_data, $route, $response){

          foreach($required_data as $key => $value){
    
            if(array_key_exists($key, $not_unique_data)){

              $required_data[$key] = $not_unique_data[$key];

              $response->json('POST', $route, $required_data)->assertStatus(422);

              $required_data[$key] = $value;

            };

          }

        }

        public function addEmployeesToBranch($branch, $login, $number_of_employees, $role_id = 1){

          Passport::actingAs($login);

          for($i = 0; $i < $number_of_employees; $i++){

            $response = $this->json('POST', route('employees.store'), [
              'name' => $this->faker->name,
              'username' => $this->faker->name,
              'password' => '123456789',
              're_password' => '123456789',
              'email' => $this->faker->safeEmail,
              'phone' => $this->faker->phoneNumber,
              'role_id' => $role_id, 
              'branch_id' => array($branch->id)
            ])->assertStatus(200);

          }

        }

        public function addCustomersToBranch($branch, $login, $number_of_customers, $customer_type_id = 1){

          Passport::actingAs($login);

          for($i = 0; $i < $number_of_customers; $i++){

            $response = $this->json('POST', route('customers.store'), [
              'name' => $this->faker->name,
              'email' => $this->faker->safeEmail,
              'phone' => $this->faker->phoneNumber,
              'customer_type_id' => $customer_type_id,
              'branch_id' => array($branch->id),
              'user_id' => $this->getUserOfLogin($login)->id
            ])->assertStatus(200);

          }

        }

}
