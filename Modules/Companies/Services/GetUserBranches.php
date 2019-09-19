<?php

namespace Modules\Companies\Services;

use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Entities\CustomerHasBranch;
use Modules\Companies\Entities\Branch;
use Modules\Employees\Entities\Employee;
use Illuminate\Foundation\Http\FormRequest;

class GetUserBranches{

    public function getUserBranches($user_id){

        $user_branches_ids = UserHasBranch::where('user_id', $user_id)->pluck('branch_id')->toArray();
        $user_branches = Branch::whereIn('id', $user_branches_ids)->get();

        return $user_branches;
    }

    public function getEmployeesUserCanSee($user_id){

        $user_branches_ids = UserHasBranch::where('user_id', $user_id)->pluck('branch_id')->toArray();
        $employees_user_ids = UserHasBranch::whereIn('branch_id', $user_branches_ids)->pluck('user_id')->toArray();
        $employees = Employee::whereIn('user_id', $employees_user_ids);

        $employees = $employees->join('users', 'users.id', '=', 'employees.user_id')
                                ->join('logins', 'logins.id', '=', 'users.login_id')
                                ->join('people', 'people.id', '=', 'users.person_id')
                                ->join('roles', 'roles.id', '=', 'employees.role_id')
                                ->select('employees.id', 'employees.user_id', 'employees.role_id',
                                'logins.username', 'users.login_id', 'users.person_id', 'users.is_active', 'logins.email', 'people.name',
                                'people.phone', 'people.address', 'roles.name AS role_name')
                                ->get();

        foreach($employees as $employee){
            $permissions = UserHasBranch::where('user_id', $employee->user_id)->pluck('branch_id')->toArray();
            $employee->branch_id = $permissions;
        }

        return $employees;
    }

    public function addUserToBranches($user_id, $branch_id){

        if(!empty($branch_id) && is_array($branch_id))
        foreach($branch_id as $id){
            $permission = new UserHasBranch();
            $permission->user_id = $user_id;
            $permission->branch_id = $id;
            $permission->save();
        }
    }

    public function deleteUserFromAllBranches($user_id){

        $permissions = UserHasBranch::where('user_id', $user_id);
        $permissions->delete();

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
