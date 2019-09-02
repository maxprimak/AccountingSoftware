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
        
        try{
            $user = User::where('login_id', auth()->id())->firstOrFail();
            $employees = BranchesService::getEmployeesUserCanSee($user->id);#
            $branches = BranchesService::getUserBranches($user->id);
            $roles = Role::all();
        }catch(\Exception $e){
            return abort(500);
        }

        return view('employees::index')->with(compact('employees', 'roles', 'branches'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        try{
            $user = User::where('login_id', auth()->id())->firstOrFail();
            $branches = BranchesService::getUserBranches($user->id);
            $roles = Role::all();
        }catch(\Exception $e){
            return abort(500);
        }

        return view('employees::create', compact('branches', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreEmployeeRequest $request)
    {       

            $employee = CreateUsersService::createEmployee($request);

            return response()->json(['message' => 'Successfully created!']);
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
        $employee = Employee::find($id);
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
