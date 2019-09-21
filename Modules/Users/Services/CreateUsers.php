<?php
namespace Modules\Users\Services;

use Modules\Employees\Http\Requests\StoreEmployeeRequest;
use Modules\Users\Entities\People;
use Modules\Users\Entities\User;
use Modules\Login\Entities\Login;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Branch;
use Modules\Employees\Entities\Employee;
use Modules\Customers\Entities\Customer;
use Illuminate\Foundation\Http\FormRequest;

use BranchesService;
use CustomerServiceFacad;
use File;

class CreateUsers{

//CREATE PART
    public function createPerson(FormRequest $request){
      $person = new People();
      $person = $person->store($request);
      return $person;
    }

    public function createLogin(FormRequest $request){
      $login = new Login();
      $login = $login->store($request);
      return $login;
    }

    public function createUser(FormRequest $request){

      $person = $this->createPerson($request);

      $login = $this->createLogin($request);

      $user = new User();
      $user = $user->store($login, $person, $request);

      return $user;
    }

    public function createEmployee(FormRequest $request){

            $user = $this->createUser($request);

            $employee = new Employee();
            $employee = $employee->store(['user_id' => $user->id,'role_id' => $request->role_id]);

            return $employee;
    }


//UPDATE PART
    public function updatePerson(FormRequest $request,$user){
        People::findOrFail($user->person_id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
    }

    public function updateLogin(FormRequest $request,$user){
        if($request->password){
            Login::findOrFail($user->login_id)->update([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'email' => $request->email
            ]);
        }else {
            Login::findOrFail($user->login_id)->update([
                'username' => $request->username,
                'email' => $request->email
            ]);
        }
    }

    public function updateUser(FormRequest $request,$user){
        $user = User::findOrFail($user->user_id);
        $user->is_active = $request->is_active;
        $user->save();
        return $user;
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

    public function loginIsActive($login_id){
        try{
            $user = User::where('login_id', $login_id)->firstOrFail();
        }catch(\Exception $e){
            return true;
        }

        return $user->is_active;
    }

    public function updateEmployee(FormRequest $request, $employee_id){

        $employee = Employee::join('users', 'users.id', '=', 'employees.user_id')
                                ->select('employees.user_id', 'employees.role_id', 'users.login_id', 'users.person_id')
                                ->find($employee_id);

        $this->updatePerson($request,$employee);

        $this->updateLogin($request,$employee);

        $user = $this->updateUser($request,$employee);

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
