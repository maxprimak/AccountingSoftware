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
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Submodel;
use Modules\Goods\Entities\Part;
use Modules\Goods\Entities\Color;
use Modules\Orders\Entities\OrderStatus;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\SalesOrder;
use Modules\Orders\Entities\RepairOrder;
use Modules\Orders\Entities\PaymentType;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;

        public function makeNewLogin(){

          $login = factory('Modules\Login\Entities\Login')->create([
            'username' => $this->faker->firstName()
          ]);

          return $login;

        }

        public function makeNewSalesOrder($login){

          Passport::actingAs($login);

          $response = $this->json('POST', route('orders.sales.store'),[
              'accept_date' => $this->faker->date('Y-m-d', '1461067200'),
              'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 1000),
              'branch_id' => $this->getBranchesOfLogin($login)->first()->id,
              'article_description' => $this->faker->text(50),
              'payment_type_id' => $this->faker->numberBetween(1,2)
          ])->assertJsonStructure([
              'status',
              'order' => [
                  'id',
                  'accept_date',
                  'price',
                  'branch_id',
                  'article_description',
                  'payment_type_id',
                  'created_at',
                  'updated_at',
                  'created_by',
              ]
          ])->assertStatus(200);

          $order = SalesOrder::find($response->decodeResponseJson()['order']['id']);

          return $order;

        }

        public function makeNewRepairOrder($login){

          Passport::actingAs($login);

          $response = $this->json('POST', route('orders.repair.store'), [
            'accept_date' => $this->faker->date('Y-m-d', '1461067200'),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 1000),
            'branch_id' => $this->getBranchesOfLogin($login)->first()->id,
            'order_nr' => $this->faker->swiftBicNumber(),
            'customer_name' => $this->faker->name(),
            'customer_phone' => $this->faker->phoneNumber(),
            'defect_description' => $this->faker->text(50),
            'comment' => $this->faker->text(50),
            'prepay_sum' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 19)
          ])->assertJsonStructure([
              'status',
              'order' => [
                  'id',
                  'accept_date',
                  'price',
                  'branch_id',
                  'order_nr',
                  'customer_name',
                  'customer_phone',
                  'defect_description',
                  'comment',
                  'prepay_sum',
                  'status_id',
                  'created_at',
                  'updated_at',
                  'created_by',
              ]
          ])->assertStatus(200);

          $order = RepairOrder::find($response->decodeResponseJson()['order']['id']);

          return $order;

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

          if(OrderStatus::all()->count() == 0){


            $statuses = [
              ['Accepted for repair',1],
              ['In progress',2],
              ['Order parts',3],
              ['Waiting for parts',4],
              ['Repaired',5],
              ['Not repairable',6],
              ['Called to client',7],
              ['Returned to client',8],
              ['Warranty',9],
          ];

          foreach($statuses as $status){

            $ord_status = new OrderStatus();
            $ord_status->name = $status[0];
            $ord_status->id = $status[1];
            $ord_status->save();
            
          }


          }

          if(PaymentType::all()->count() == 0){
            factory(PaymentType::class)->create(['name' => 'Cash', 'id' => 1]);
            factory(PaymentType::class)->create(['name' => 'Card', 'id' => 2]);
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

        //Goods GET
        public function getBrands($login){
          $brands = Brand::all();
          if(!empty($brands)){
            $this->storeBrands($login,5);
            $brands = Brand::all();
          }
          return $brands;
        }

        public function getModels($login,$brand_id){
          $models = Models::where('brand_id',$brand_id)->get();
          if(!empty($models)){
            $this->storeModels($login,4);
            $models = Models::all();
          }
          return $models;
        }

        public function getSubmodels($login,$model_id){
          $sub_models = Submodel::where('model_id',$model_id)->get();
          if(!empty($sub_models)){
            $this->storeSubmodels($login,$model_id,3);
            $sub_models = Submodel::all();
          }
          return $sub_models;
        }

        public function getParts($login){
          $parts = Part::all();
          if(!empty($parts)){
            $this->storeParts($login,5);
            $parts = Part::all();
          }
          return $parts;
        }

        public function getColors($login){
          $colors = Color::all();
          if(!empty($colors)){
            $this->storeColors($login, 4);
            $colors = Color::all();
          }
          return $colors;
        }


        //Goods STORE
        public function storeBrands($login,$amount){
          Passport::actingAs($login);
          for($i = 0; $i < $amount; $i++){

            $name = $this->faker->unique()->name;
            $logo = $this->faker->unique()->name;
            $response = $this->json('POST', route('brands.store'), [
              'name' => $name,
              'logo' => $logo
            ])->assertStatus(200);
            $response = $this->assertDatabaseHas('brands', [
              'name' => $name,
              'logo' => $logo
            ]);
          }
        }

        public function storeModels($login,$amount){
          Passport::actingAs($login);

          for($i = 0; $i < $amount; $i++){

            $brand_id = $this->getBrands($login)->random(1)->first()->id;
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

        public function storeSubmodels($login,$model_id,$amount){
          Passport::actingAs($login);

          for($i = 0; $i < $amount; $i++){
            $name = $this->faker->unique()->name;
            $response = $this->json('POST', route('submodels.store'), [
              'model_id' => $model_id,
              'name' => $name
            ])->assertStatus(200);

            $response = $this->assertDatabaseHas('submodels', [
              'model_id' => $model_id,
              'name' => $name
            ]);
          }
        }

        public function storeParts($login,$amount){
          Passport::actingAs($login);

          for($i = 0; $i < $amount; $i++){
            $name = $this->faker->unique()->name;
            $response = $this->json('POST', route('parts.store'), [
              'name' => $name
            ])->assertStatus(200);

            $response = $this->assertDatabaseHas('parts', [
              'name' => $name
            ]);
          }
        }

        public function storeColors($login,$amount){
          Passport::actingAs($login);

          for($i = 0; $i < $amount; $i++){
            $name = $this->faker->unique()->name;
            $response = $this->json('POST', route('colors.store'), [
              'name' => $name
            ])->assertStatus(200);

            $response = $this->assertDatabaseHas('colors', [
              'name' => $name
            ]);
          }
        }
}
