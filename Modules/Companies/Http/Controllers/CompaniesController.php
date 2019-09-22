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

use BranchesService;

class CompaniesController extends Controller
{   

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {   
        $user = User::where('login_id', auth()->user()->id)->firstOrFail();
        $company = Company::findOrFail($user->company_id);
        $currencies = Currency::all();
        $branches = BranchesService::getUserBranches($user->id);

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
        try{
            $company = Company::findOrFail($id);
            $company = $company->storeUpdated($request);
        }catch( \Exception $e){
            return response()->json($e->getMessage(), 500);
        }
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
}
