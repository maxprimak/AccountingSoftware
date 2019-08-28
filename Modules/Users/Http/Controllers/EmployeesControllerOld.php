<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\People;
use Modules\Users\Entities\User;
use Modules\Users\Entities\Role;
use Modules\Login\Entities\Login;


class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {   $people = People::all();
        $users = User::all();
        $roles = Role::all();
        $logins = Login::all();
        return view('users::employees_index',compact('people','users','roles'));
        //return response()->json($people);
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        // new Person
        $person = new People;
        $person->name = $request->new_full_name;
        $person->phone = $request->new_phone;
        $person->save();
        // new Login
        $login = new Login;
        $login->username = $request->new_login;
        $login->password = $request->new_password;
        $login->email = $request->new_email;
        $login->save();
        // new User
        $user = new User;
        $user->login_id = $login->id;
        $user->person_id = $person->id;
        $user->role_id = $request->new_role;
        $user->branch_id = 1;
        $user->save();

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('employees::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Request $request)
    {

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
