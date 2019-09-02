<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Registration\Http\Requests\RegistrationRequest;
use Modules\Companies\Database\Entities\Company;
use CreateUsersService;
//use RegistrationService;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('registration::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('registration::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(RegistrationRequest $request)
    {   
        try{
            //$company = RegistrationService::registerFirstCompanyAndBranch();
            $employee = CreateUsersService::registerFirstEmployee($request, auth()->id());

            //$company = new Company();
            //$company = $company->store($request);

        }catch( \Exception $e ){
            return response()->json($e->getMessage(), 500);
        }

        return response()->json([
            'employee' => $employee
            //'company' => $company
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('registration::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('registration::edit');
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
