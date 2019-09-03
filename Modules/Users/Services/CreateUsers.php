<?php
namespace Modules\Users\Services;

use Modules\Employees\Http\Requests\StoreEmployeeRequest;
use Modules\Users\Entities\People;
use Modules\Users\Entities\User;
use Modules\Login\Entities\Login;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Branch;
use Modules\Employees\Entities\Employee;
use Illuminate\Foundation\Http\FormRequest;

use BranchesService;
use File;

class CreateUsers{

    public function createEmployee(FormRequest $request){

            $person = new People();
            $person = $person->store($request);

            $login = new Login();
            $login = $login->store($request);
            
            $user = new User();
            $user = $user->store($login, $person, $request);

            $employee = new Employee();
            $employee = $employee->store(['user_id' => $user->id,'role_id' => $request->role_id]);

            return $employee;
    }

    public function registerFirstEmployee(FormRequest $request, $login_id){

        $person = new People();
        $person = $person->store($request);

        $login = Login::find($login_id);

        $company = new Company();
        $company->name = $request->company_name;
        $company->address = $request->company_address;
        $company->phone = $request->company_phone;
        $company->currency_id = $request->currency_id;
        $company->save();

        $user = new User();
        $user->login_id = $login->id;
        $user->person_id = $person->id;
        $user->company_id = $company->id;
        $user->is_active = true;
        $user->save();

        $branch = new Branch();
        $branch->company_id = $company->id;
        $branch->name = $company->name . ' Main Branch';
        $branch->address = $company->address;
        $branch->phone = $company->phone;
        $branch->color = "#F64272";
        $branch->save();

        BranchesService::addUserToBranches($user->id, array($branch->id));

        $employee = new Employee();
        $employee->user_id = $user->id;
        $employee->role_id = 1;
        $employee->save();

        return $employee;
}

    public function createCustomer(){
        return 2;
    }

    public function updateEmployee(FormRequest $request, $employee_id){

        $employee = Employee::join('users', 'users.id', '=', 'employees.user_id')
                                ->select('employees.user_id', 'employees.role_id', 'users.login_id', 'users.person_id')
                                ->find($employee_id);

        People::find($employee->person_id)->update([
            'name' => $request->full_name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        // update Login
        Login::find($employee->login_id)->update([
            'username' => $request->username,
            //'password' => Hash::make($request->password),
            'email' => $request->email
        ]);

        // update User
        $user = User::find($employee->user_id);
        $user->is_active = $request->is_active;
        $user->save();

        BranchesService::deleteUserFromAllBranches($user->id);
        BranchesService::addUserToBranches($user->id, $request->branch_id);
        
        //update Employee
        $employee = Employee::find($employee_id);
        $employee = $employee->storeUpdated($request);

        //upload photo avatar
        if (! File::exists(public_path('avatars/'))) {
            File::makeDirectory(public_path('avatars/'));
        }

        if($request->get('image'))
        {
          $image = $request->get('image');
	        $name = $employee->user_id.'_avatar' . '.png';	
          \Image::make($request->get('image'))->save(public_path('avatars/').$name);
        }

        return $employee;
    }

}