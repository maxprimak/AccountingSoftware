<?php

namespace Modules\Companies\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Companies\Transformers\CompanyResource;
use Modules\Users\Entities\People;
use Modules\Employees\Entities\Role;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Currency;
use Modules\Companies\Entities\Branch;
use Modules\Companies\Entities\Address;
use Modules\Companies\Entities\City;
use Modules\Companies\Entities\Country;
use Modules\Users\Entities\User;
use Modules\Login\Entities\Login;
use Modules\Companies\Http\Requests\StoreCompanyRequest;
use Modules\Companies\Http\Requests\UpdateCompanyRequest;

use BranchesService;

class CompaniesController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = auth('api')->user()->user;
        return response()->json(new CompanyResource($user->company));
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
        return response()->json([
            'message' => 'Successfully updated',
            'company' => $company
        ]);
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
