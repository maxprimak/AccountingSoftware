<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\CompanyHasModels;
use Modules\Goods\Http\Requests\StoreModelRequest;
use DB;

class ModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($brand_id)
    {
        $company = auth('api')->user()->getCompany();
        $models = Models::where('brand_id',$brand_id)->where('is_custom',0)->get();
        $models_of_company = DB::table('company_has_models')
                    ->join('models', 'models.id', '=', 'company_has_models.model_id')
                    ->select('models.id as id', 'models.name as name','models.logo as logo')
                    ->where('company_has_models.company_id',$company->id)
                    ->where('models.brand_id',$brand_id)
                    ->get();

        foreach ($models_of_company as $model_of_company) {
          $models->push($model_of_company);
        }
        return response()->json($models);
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
    public function store(StoreModelRequest $request)
    {
        if(is_null($request->logo)){
          $request->logo = "https://cdn1.iconfinder.com/data/icons/browser-user-interface-1/240/responsive-devices-ipad-iphone-512.png";
        }
        $company = auth('api')->user()->getCompany();

        $model = new Models();
        $model->store($request);
        $company_has_models = new CompanyHasModels();
        $company_has_models = $company_has_models->store($company->id,$model->id);
        $language_id = auth('api')->user()->getCompany()->language_id;
        $message = ($language_id == 1) ? 'Successfully added!' : "Erfolgreich hinzugefügt!" ;
        return response()->json(['message' => $message, 'model' => $model], 200);
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
