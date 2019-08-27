<?php

namespace Modules\Employees\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
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
        $employees = Employee::join('users', 'users.id', '=', 'employees.user_id')
                                ->leftJoin('logins', 'logins.id', '=', 'users.login_id')
                                ->leftJoin('people', 'people.id', '=', 'users.login_id')
                                ->select('employees.id', 'employees.user_id', 'employees.role_id',
                                 'logins.username', 'logins.password', 'logins.email', 'people.name',
                                 'people.phone')
                                ->paginate(20);

        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $branches = Branch::all('id','name');
        $roles = Role::all('id', 'name');


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
        $employee = new Employee;
        $employee->user_id = $user->id;
        $employee->role_id = $request->role_id;
        $employee->save();

        return response()->json('create employee successfully', $employee);
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
        $e = Employee::join('users', 'users.id', '=', 'employees.user_id')
                        ->leftjoin('logins', 'logins.id', '=', 'users.login_id')
                        ->leftjoin('people', 'people.id', '=', 'users.person_id')
                        // ->where('employees.id',$id)
                        ->select('employees.id', 'employees.user_id', 'employees.role_id', 'users.branch_id',
                                 'logins.username', 'logins.password', 'logins.email', 'people.name',
                                 'people.phone')
                        ->find($id);
                        // dd($e);
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
        $user = Employee::join('users', 'users.id', '=', 'employees.user_id')
                                ->select('users.id', 'employees.role_id', 'users.login_id', 'users.person_id')
                                ->find($id);

        // dd($user);
        // update Person
        People::find($user->person_id)->update([
            'name' => $request->new_full_name,
            'phone' => $request->new_phone,
            'address' => $request->new_address
        ]);
        // update Login
        Login::find($user->login_id)->update([
            'username' => $request->new_username,
            'password' => Hash::make($request->new_password),
            'email' => $request->new_email
        ]);

        // update User
        User::find($user->id)->update(['branch_id' => $request->new_branch]);
        
        //update Employee
        Employee::find($id)->update(['role_id' => $request->role_id]);

        return response()->json('Update employee successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
