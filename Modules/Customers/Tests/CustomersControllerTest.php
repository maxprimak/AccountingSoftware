<?php

namespace Modules\Customers\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;
use Modules\Companies\Entities\Company;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Entities\CustomerHasBranch;
use Illuminate\Support\Facades\Artisan;

class CustomersControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     // use RefreshDatabase;

     protected $login;

     protected function setUp(): void{
        // $this->login = ;

      }

    // public function testUserSeesCustomersFromHisCompany()
    // {
    //     $users = factory(User::class,4)->create([
    //         'company_id' => function () {
    //             return factory(Company::class)->create()->id;
    //         }
    //     ]);
    //
    //
    //     $customers = factory(Customer::class,50)->create([
    //         'company_id' => function () {
    //             return $randomNumberForCompanyId = rand(1,Company::all()->count());
    //         }
    //     ])->toArray();
    //
    //     $branch_ids = UserHasBranch::where('user_id',auth()->user()->id)->pluck('branch_id')->toArray();
    //     $customer_ids = CustomerHasBranch::whereIn('branch_id',$branch_ids)->pluck('customer_id')->toArray();
    //     $customers = Customer::whereIn('id',$customer_ids)->get();
    //
    //     $company_id = Company::find(auth()->user()->company_id);
    //     $customers = Customer::where('company_id',$company_id)->get()->toArray();
    //     $correct_customers = array();
    //
    //     $this->assertTrue(true);
    // }
    //
    // /**
    //  * @depends testUserSeesCustomersFromHisCompany
    //  */
    // public function testUserSeesCustomersFromHisBranch()
    // {
    //
    //     $this->assertTrue(true);
    // }

}
