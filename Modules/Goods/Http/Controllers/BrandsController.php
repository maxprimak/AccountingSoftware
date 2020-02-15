<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\CompanyHasBrands;
use Modules\Goods\Http\Requests\StoreBrandRequest;
use DB;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $company = auth('api')->user()->getCompany();
      $brands = Brand::where('is_custom',0)->get();
      $brands_of_company = DB::table('company_has_brands')
                  ->join('brands', 'brands.id', '=', 'company_has_brands.brand_id')
                  ->select('brands.id as id', 'brands.name as name','brands.logo as logo')
                  ->where('company_has_brands.company_id',$company->id)
                  ->get();

      foreach ($brands_of_company as $brand_of_company) {
        $brands->push($brand_of_company);
      }
      return response()->json($brands);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('goods::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreBrandRequest $request)
    {
        if(is_null($request->logo)){
          $request->logo = "http://www.aljanh.net/data/archive/img/1878616533.png";
        }
        $company = auth('api')->user()->getCompany();
        $brand = new Brand();
        $brand = $brand->store($request);
        $company_has_brands = new CompanyHasBrands();
        $company_has_brands = $company_has_brands->store($company->id,$brand->id);
        return response()->json(['message' => 'Successfully added!', 'brand' => $brand], 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('goods::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('goods::edit');
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
