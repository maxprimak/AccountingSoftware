<?php

namespace Modules\Employees\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Users\Entities\People;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Branch;
use Modules\Users\Entities\User;
use Modules\Login\Entities\Login;
use Modules\Employees\Entities\Role;
use Modules\Employees\Entities\Employee;
use Illuminate\Routing\Controller;
use Modules\Employees\Http\Requests\StoreEmployeeRequest;
use Modules\Employees\Http\Requests\UpdateEmployeeRequest;


class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        
        $user = new User;
        $company_id = $user->getCompany(auth()->user()->id);
        // dd($company_id);
        $employees = Employee::join('users', 'users.id', '=', 'employees.user_id')
                                ->join('logins', 'logins.id', '=', 'users.login_id')
                                ->join('people', 'people.id', '=', 'users.person_id')
                                ->join('branches', 'branches.id', '=', 'users.branch_id')
                                ->where('branches.company_id',$company_id)  
                                ->select('employees.id', 'employees.user_id', 'employees.role_id', 'users.branch_id',
                                'logins.username', 'users.login_id', 'users.person_id', 'logins.password', 'logins.email', 'people.name',
                                'people.phone')
                                ->paginate(20);
        dd($employees);
        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        // $branches = Branch::where('company_id', )->all('id','name');
        // $roles = Role::all('id', 'name');


        return view('employees::test');
        // return response()->json([
        //     $branches, $roles]);

        // return view('employees::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        // $input = Input::all();
        // $validation = Validator::make($input, $request->rules());

        // if ($validation->passes()){
            // new Person
            $person = new People;
            $person->name = $request->new_full_name;
            $person->phone = $request->new_phone;
            $person->address = $request->new_address;
            $person->save();
            // new Login
            $login = new Login;
            $login->username = $request->new_username;
            $login->password = Hash::make($request->new_password);
            $login->email = $request->new_email;
            $login->save();
            // new User
            $user = new User;
            $user->login_id = $login->id;
            $user->person_id = $person->id;
            $user->branch_id = $request->branch_id;
            $user->save();
            //new employee
            // $employee = new Employee;
            // $employee->user_id = $user->id;
            // $employee->role_id = $request->role_id;
            // $employee->save();
            $employee = new Employee();
            $employee = $employee->store(['user_id' => $user->id,'role_id' => $request->role_id]);
        // }

        return response()->json($employee);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        // return view('employees::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = new User;
        $company_id = $user->getCompany(auth()->user()->id);
        $e = Employee::join('users', 'users.id', '=', 'employees.user_id')
                        ->join('logins', 'logins.id', '=', 'users.login_id')
                        ->join('people', 'people.id', '=', 'users.person_id')
                        ->join('branches', 'branches.id', '=', 'users.branch_id')
                        ->where('branches.company_id', $company_id)
                        ->select('employees.id', 'employees.user_id', 'employees.role_id', 'users.branch_id',
                                 'logins.username', 'users.login_id', 'users.person_id', 'logins.password', 'logins.email', 'people.name',
                                 'people.phone')
                        ->find($id);
        if($e==null) dd('nooo');
        return view('employees::update', compact('e'));
        // return view('employees::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        
        $employee = Employee::join('users', 'users.id', '=', 'employees.user_id')
                                ->select('users.id', 'employees.role_id', 'users.login_id', 'users.person_id')
                                ->find($id);

        //check employee is auth own company
        $user = new User;
        $auth_company = $user->getCompany(auth()->user()->id);
        $user_company = $user->getCompany($employee->login_id);

        if($auth_company == $user_company){
            People::find($employee->person_id)->update([
                'name' => $request->full_name,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
            // update Login
            Login::find($employee->login_id)->update([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email
            ]);

            // update User
            User::find($employee->id)->update(['branch_id' => $request->branch_id]);
            
            //update Employee
            Employee::find($id)->update(['role_id' => $request->role_id]);
        }

        return response()->json('Update employee successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $employee = Employee::join('users', 'users.id', '=', 'employees.user_id')
                                ->select('employees.user_id', 'users.login_id', 'users.person_id')
                                ->find($id);

        $user = new User;
        $auth_company = $user->getCompany(auth()->user()->id);
        $user_company = $user->getCompany($user->login_id);
        if($auth_company == $user_company){
            dd("noooooooooooo");
        }else{
            dd($auth_company, $user_company);
        }
        // dd($user->login_id);

        Employee::find($id)->delete();

        User::find($employee->id)->delete();

        Login::find($employee->login_id)->delete();

        People::find($employee->person_id)->delete();

        return response()->json('delete employee successfully');
    }
}
