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
        $company = User::join('branches', 'branches.id', '=', 'users.branch_id')
                                ->select('branches.company_id')
                                ->where('users.login_id',auth()->user()->id)
                                ->first();
        $company = $company->company_id;

        $employees = Employee::join('users', 'users.id', '=', 'employees.user_id')
                                ->join('logins', 'logins.id', '=', 'users.login_id')
                                ->join('people', 'people.id', '=', 'users.person_id')
                                ->join('branches', 'branches.id', '=', 'users.branch_id')
                                ->where('branches.company_id',$company)  
                                ->select('employees.id', 'employees.user_id', 'employees.role_id', 'users.branch_id',
                                'logins.username', 'users.login_id', 'users.person_id', 'logins.email', 'people.name',
                                'people.phone', 'people.address')
                                ->get();
                            
        $roles = Role::all();

        return view('employees::index')->with(compact('employees', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $company = User::join('branches', 'branches.id', '=', 'users.branch_id')
                                ->select('branches.company_id')
                                ->where('users.login_id',auth()->user()->id)
                                ->first();
        $company = $company->company_id;

        $branchs = Branch::where('company_id', $company)->get('id','name');
        $roles = Role::all('id', 'name');

        return view('employees::create', compact('branchs', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreEmployeeRequest $request)
    {
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
            $employee = new Employee();
            $employee = $employee->store(['user_id' => $user->id,'role_id' => $request->role_id]);

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
        $company = User::join('branches', 'branches.id', '=', 'users.branch_id')
                                ->select('branches.company_id')
                                ->where('users.login_id',auth()->user()->id)
                                ->first();
        $company = $company->company_id;

        $e = Employee::join('users', 'users.id', '=', 'employees.user_id')
                        ->join('logins', 'logins.id', '=', 'users.login_id')
                        ->join('people', 'people.id', '=', 'users.person_id')
                        ->join('branches', 'branches.id', '=', 'users.branch_id')
                        ->where('branches.company_id', $company)
                        ->select('employees.id', 'employees.user_id', 'employees.role_id', 'users.branch_id',
                                 'logins.username', 'users.login_id', 'users.person_id', 'logins.password', 'logins.email', 'people.name',
                                 'people.phone')
                        ->where('employees.id',$id)
                        ->firstOrFail();
        return view('employees::edit', compact('e'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        dd($request);

        $employee = Employee::join('users', 'users.id', '=', 'employees.user_id')
                                ->select('employees.user_id', 'employees.role_id', 'users.login_id', 'users.person_id')
                                ->find($id);

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
        User::find($employee->user_id)->update(['branch_id' => $request->branch_id]);
        
        //update Employee
        $employee = new Employee();
        $employee = $employee->storeUpdated($request);

        return response()->json(['message' => 'Successfully updated!']);
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

        Employee::find($id)->delete();

        User::find($employee->user_id)->delete();

        Login::find($employee->login_id)->delete();

        People::find($employee->person_id)->delete();

        return response()->json(['message' => 'Successfully deleted!']);
    }
}
