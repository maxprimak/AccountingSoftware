<?php

namespace Modules\Customers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Users\Entities\People;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Branch;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Entities\CustomerHasBranch;
use Illuminate\Routing\Controller;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
          $company = User::join('branches', 'branches.id', '=', 'users.branch_id')
                                  ->select('branches.company_id')
                                  ->where('users.login_id',auth()->user()->id)
                                  ->firstOrFail();
          $company_id = $company->company_id;

          $branch_ids = UserHasBranch::where('user_id',auth()->user()->id)->pluck('branch_id')->toArray();
          $customer_ids = CustomerHasBranch::whereIn('branch_id',$branch_ids)->pluck('customer_id')->toArray();
          $customers = Customer::whereIn('id',$customer_ids)->get();
          
        } catch (\Exception $e) {

        }

        return view('customers::index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('customers::create');
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
        return view('customers::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('customers::edit');
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
