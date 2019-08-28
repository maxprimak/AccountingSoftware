<?php

namespace Modules\Companies\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\People;
use Modules\Employees\Entities\Role;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Currency;
use Modules\Companies\Entities\Branch;
use Modules\Users\Entities\User;
use Modules\Login\Entities\Login;
use Modules\Companies\Http\Requests\StoreCompanyRequest;
use Modules\Companies\Http\Requests\UpdateCompanyRequest;

class CompaniesController extends Controller
{   

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {   
        $user = User::where('login_id', auth()->user()->id)->first();
        $branch_of_user = Branch::find($user->branch_id);
        $company = Company::find($branch_of_user->company_id);

        $currencies = Currency::all();
        
        $branches = Branch::where('company_id', $company->id)->get();

        return view('companies::companies.index')->with(compact('company', 'currencies', 'branches'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('companies::companies.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreCompanyRequest $request)
    {   
        $company = new Company();
        $company = $company->store($request);

        return response()->json($company);
    }
    
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::find($id);
        $company = $company->storeUpdated($request);

        return response()->json('Successfully updated!');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('companies::companies.edit')->with(compact('company'));
    }


    /////////////////////////DELETE THEN//////////////////////////////
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function showRegSteps()
    {
        return view('companies::reg_steps');
    }

    public function submitRegSteps(Request $data){

        $person = $this->createPerson($data);
        $company = $this->createCompany($data);

        $this->addBranches($company, $data);

        $response = array(
            'status' => 'success',
            'company_id' => $company->id
        );
        return response()->json($response);
    }

    public function createPerson($data){

        $person = People::create([
            'name' => $data['name_user'],
            'phone' => $data['phone_user'],
            'address' => $data['address_user']
        ]);
        
        return $person; 

    }

    public function createCompany($data){

        $company = Company::create([
            'name' => $data['name_company'],
            'phone' => $data['phone_company'],
            'address' => $data['address_company']
        ]);
        
        return $company;

    }

    public function addBranches($company, $data){

        foreach($data['name_branch'] as $branch){
            Branch::create([
                'name' => $branch,
                'company_id' => $company->id
            ]);
        }

    }

    public function showAddEmployees($id){

        $company = Company::find($id);
        $branches = Branch::where('company_id', $id)->get();
        $roles = Role::all();

        return view('companies::add_employees', compact('company', 'branches', 'roles'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('companies::show');
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
