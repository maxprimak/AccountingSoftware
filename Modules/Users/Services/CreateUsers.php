<?php
namespace Modules\Users\Services;

use Modules\Employees\Http\Requests\StoreEmployeeRequest;
use Modules\Users\Entities\People;
use Modules\Users\Entities\User;
use Modules\Login\Entities\Login;
use Modules\Employees\Entities\Employee;
use Illuminate\Foundation\Http\FormRequest;

class CreateUsers{

    public function createEmployee(Request $request){
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
        
        $user = new User();
        $user = $user->store($login, $person, $request);

        $employee = new Employee();
        $employee = $employee->store(['user_id' => $user->id,'role_id' => 1]);

        return $employee;
}

    public function createCustomer(){
        return 2;
    }

}