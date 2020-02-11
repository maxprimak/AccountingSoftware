<?php

namespace Modules\Customers\Services;

use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;
use Modules\Customers\Entities\CustomerHasBranch;
use Modules\Customers\Entities\Customer;
use Modules\Companies\Entities\Branch;
use Modules\Devices\Entities\Device;
use Modules\Devices\Entities\CustomerHasDevice;
use Modules\Employees\Entities\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

use BranchesService;
use CreateUsersService;

class CustomerServices{

    public function createCustomer($request,$company_id){

        $person = CreateUsersService::createPerson($request);

        $customer = new Customer();
        $customer->person_id = $person->id;
        $customer->email = $request->email;
        $customer->type_id = $request->customer_type_id;
        $customer->company_id = $company_id;
        $customer->created_by = User::where('login_id', auth('api')->user()->id)->first()->id;
        $customer->save();

        //$branch_id = $request->branch_id;
        $branch_id = Branch::where('company_id',$company_id)->pluck('id')->toArray();

        BranchesService::addCustomerToBranches($customer->id,$branch_id);
        return $customer;
    }


    public function updateCustomer(FormRequest $request, $customer_id){
        try {
          $customer = Customer::findOrFail($customer_id);

          //$branch_id = $request->branch_id;
          $branch_id = Branch::where('company_id',$customer->company_id)->pluck('id')->toArray();

          CreateUsersService::updatePerson($request,$customer);

          BranchesService::deleteCustomerFromAllBranches($customer_id);
          BranchesService::addCustomerToBranches($customer_id, $branch_id);

          $customer = $customer->storeUpdated($request);

          return $customer;
        } catch (\Exception $e) {
          throw new \Exception($e->getMessage());
        }
    }

    public function storeStarsNumber(FormRequest $request,$customer_id){
        $customer = Customer::findOrFail($customer_id);
        $customer->saveStarsNumber($request);
    }

    public function getCustomerUserCanSee($user_id){

        $user_branches_ids = UserHasBranch::where('user_id', $user_id)->pluck('branch_id')->toArray();
        $customer_ids = CustomerHasBranch::whereIn('branch_id',$user_branches_ids)->pluck('customer_id')->toArray();
        $customers = DB::table('customers')
                    ->join('people', 'people.id', '=', 'customers.person_id')
                    ->join('customer_types', 'customer_types.id', '=', 'customers.type_id')
                    ->join('companies', 'companies.id', '=', 'customers.company_id')
                    ->select('customers.id as id','customers.*', 'companies.id as company_id' ,'people.name',
                    'people.phone', 'people.address')
                    ->whereIn('customers.id',$customer_ids)->orderBy('id')
                    ->get();

        foreach($customers as $customer){
            $permissions = CustomerHasBranch::where('customer_id', $customer->id)->pluck('branch_id')->toArray();
            $customer->branch_id = $permissions;
            
            $devices_ids = CustomerHasDevice::where('customer_id', $customer->id)->pluck('device_id')->toArray();
            $devices = Device::whereIn('id', $devices_ids)->orderBy('id', 'DESC')->get();
    
            foreach($devices as $device){
                $device->status_name = $device->getStatus()['name'];
                $device->status_hexcode = $device->getStatus()['hexcode'];
                $device->last_request = $device->getStatus()['last_request'];
            }

            $customer->devices = $devices;



        }
        return $customers;
    }

}
