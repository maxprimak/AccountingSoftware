<?php

namespace Modules\Suppliers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Companies\Entities\Address;
use Modules\Companies\Entities\City;
use Modules\Companies\Entities\Country;
use Modules\Suppliers\Entities\Supplier;
use Modules\Suppliers\Entities\SupplierHasCompany;
use Modules\Suppliers\Http\Requests\StoreSupplierRequest;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $ids = SupplierHasCompany::where('company_id', auth('api')->user()->getCompany()->id)->pluck('supplier_id')->toArray();
        $suppliers = Supplier::whereIn('id', $ids)->get();

        foreach($suppliers as $supplier){
            $supplier->addAddressInfo();
        }

        return response()->json($suppliers);

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = new Supplier();
        $supplier->store($request);

    return response()->json($supplier->addAddressInfo());
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(StoreSupplierRequest $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->edit($request);

        return response()->json($supplier->addAddressInfo());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        try{
            $supplier->removeFromDB();
        }
        catch(\Exception $e){
            return response()->json(["success" => false, "message" => $e->getMessage()], 403);
        }

        return response()->json(["success" => true, "message" => "deleted"]);
    }
}
