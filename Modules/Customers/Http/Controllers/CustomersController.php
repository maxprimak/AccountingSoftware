<?php

namespace Modules\Customers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Users\Entities\People;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasBranch;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Branch;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Entities\CustomerHasBranch;
use Modules\Customers\Entities\CustomerType;
use Modules\Devices\Entities\CustomerHasDevice;
use Modules\Devices\Entities\Device;
use Modules\Customers\Http\Requests\StoreCustomerRequest;
use Modules\Customers\Http\Requests\UpdateCustomerRequest;
use Illuminate\Routing\Controller;

use BranchesService;
use CustomerServiceFacad;
use CreateUsersService;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index()
    {
        try {
          $user = User::where('login_id',auth('api')->id())->firstOrFail();
          $customers = CustomerServiceFacad::getCustomerUserCanSee($user->id);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
        return response()->json($customers);
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCustomerRequest $request
     * @return Response
     */
    public function store(StoreCustomerRequest $request)
    {
        try {
            $user = User::where('login_id',auth('api')->id())->firstOrFail();
            $company_id = Company::findOrFail($user->company_id)->id;
            $customer = CustomerServiceFacad::createCustomer($request,$company_id);
        } catch (\Exception $e) {
          return response()->json(['message' => $e->getMessage()]);
        }
        return response()->json(['message' => 'Successfully created!', 'customer' => $customer], 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return View
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
     * @param StoreCustomerRequest $request
     * @param int $id
     * @return Response
     */
     // UpdateCustomerRequest
    public function update(UpdateCustomerRequest $request, $id)
    {
      try {
        $customer = CustomerServiceFacad::updateCustomer($request, $id);
      } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
      }
      return response()->json(['message' => 'Successfully updated!', 'customer' => $customer]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
      $customer = Customer::findOrFail($id);

      BranchesService::deleteCustomerFromAllBranches($id);

      $devices_ids = CustomerHasDevice::where('customer_id', $customer->id)->pluck('device_id')->toArray();
      CustomerHasDevice::where('customer_id', $customer->id)->delete();
      Device::whereIn('id', $devices_ids)->delete();

      Customer::findOrFail($id)->delete();
      People::findOrFail($customer->person_id)->delete();

      return response()->json(['message' => 'Successfully deleted!']);
    }
}
