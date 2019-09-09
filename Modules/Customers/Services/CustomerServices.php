<?php

namespace Modules\Customers\Services;

use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;
use Modules\Customers\Entities\CustomerHasBranch;
use Modules\Customers\Entities\Customer;
use Modules\Companies\Entities\Branch;
use Modules\Employees\Entities\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class CustomerServices{

    public function getCustomerUserCanSee($user_id){

        $user_branches_ids = UserHasBranch::where('user_id', $user_id)->pluck('branch_id')->toArray();
        $customer_ids = CustomerHasBranch::whereIn('branch_id',$user_branches_ids)->pluck('customer_id')->toArray();

        $customers = DB::table('customers')
                    ->join('people', 'people.id', '=', 'customers.person_id')
                    ->join('customer_types', 'customer_types.id', '=', 'customers.type_id')
                    ->join('companies', 'companies.id', '=', 'customers.company_id')
                    ->select('customers.*', 'companies.id','people.name',
                    'people.phone', 'people.address')
                    ->whereIn('customers.id',$customer_ids)
                    ->get();

        foreach($customers as $customer){

            $permissions = CustomerHasBranch::where('customer_id', $customer->id)->pluck('branch_id')->toArray();
            $customer->branch_id = $permissions;
        }
        return $customers;
    }

    public function addCustomerToBranches($customer_id, $branch_id){
        if(!empty($branch_id) && is_array($branch_id))
        foreach($branch_id as $id){
            $permission = new CustomerHasBranch();
            $permission->customer_id = $customer_id;
            $permission->branch_id = $id;
            $permission->save();
        }
    }

    public function deleteCustomerFromAllBranches($customer_id){

        $permissions = CustomerHasBranch::where('customer_id', $customer_id);
        $permissions->delete();

    }

}
