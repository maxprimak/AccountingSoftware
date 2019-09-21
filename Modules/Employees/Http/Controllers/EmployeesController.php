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
use Illuminate\Database\Eloquent\ModelNotFoundException;

use BranchesService;
use CreateUsersService;
use File;


class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

            $user = User::where('login_id', auth()->id())->firstOrFail();
            $employees = BranchesService::getEmployeesUserCanSee($user->id);
            $branches = BranchesService::getUserBranches($user->id);
            $roles = Role::all();

        return view('employees::index')->with(compact('employees', 'roles', 'branches'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        $user = User::where('login_id', auth()->id())->firstOrFail();
        $branches = BranchesService::getUserBranches($user->id);
        $roles = Role::all();

        return view('employees::create', compact('branches', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreEmployeeRequest $request
     * @return Response
     */
    public function store(StoreEmployeeRequest $request)
    {
            $employee = CreateUsersService::createEmployee($request);

            return response()->json(['message' => 'Successfully created!']);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateEmployeeRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {

        $employee = CreateUsersService::updateEmployee($request, $id);

        return response()->json(['message' => 'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try{
            $employee = Employee::join('users', 'users.id', '=', 'employees.user_id')
            ->select('employees.user_id', 'users.login_id', 'users.person_id')
            ->findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }

        Employee::find($id)->delete();

        User::find($employee->user_id)->delete();

        Login::find($employee->login_id)->delete();

        People::find($employee->person_id)->delete();

        return response()->json(['message' => 'Successfully deleted!']);
    }
}
