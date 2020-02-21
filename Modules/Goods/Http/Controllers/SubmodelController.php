<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Submodel;
use Modules\Goods\Http\Requests\StoreSubmodelRequest;
use DB;
// use Modules\Goods\GoodsData\gsm;


class SubmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($model_id)
    {

        $company = auth('api')->user()->getCompany();
        $submodels = Submodel::where('model_id',$model_id)->where('is_custom',0)->get();
        $submodels_of_company = DB::table('company_has_submodels')
                    ->join('submodels', 'submodels.id', '=', 'company_has_submodels.submodel_id')
                    ->select('submodels.*')
                    ->where('company_has_submodels.company_id',$company->id)
                    ->where('submodels.model_id',$model_id)
                    ->get();
        foreach ($submodels_of_company as $submodel_of_company) {
          $submodels->push($submodel_of_company);
        }

        return response()->json($submodels);

        //FOR FUTURE USE UPDATE SUBMODELS WITH API
        // $brand_id = Models::find($model_id)->brand_id;
        // $brand_name = Brand::find($brand_id)->name;
        // $gsm = new gsm();
        // $data_all = $gsm->search($brand_name);
        // $unsorted_devices = array();
        // $watches = array();
        // $tablets = array();
        // $smartphones = array();
        // // dd($data_all);
        // foreach ($data_all as $item => $devices) {
        //   if($item == "data"){
        //     foreach ($devices as $device => $values){
        //         foreach ($values as $key => $value){
        //           if($key == "title"){
        //             if(strpos($value, "atch")){
        //               array_push($watches,$value);
        //             }elseif(strpos($value, "Pad") || strpos($value, "Tab")){
        //               array_push($tablets,$value);
        //             }else{
        //               array_push($smartphones,$value);
        //             }
        //           }
        //         }
        //     }
        //   }
        // }
        // dd($smartphones,$tablets,$watches);
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
    public function store(StoreSubmodelRequest $request)
    {
        $existing_submodel = Submodel::where([['name','=', $request->name],['model_id','=', $request->model_id]])->first();
        if($existing_submodel){
          $exists = $existing_submodel->checkIfExistsInCompany();
          if(!$exists){
            $existing_submodel->addToCompany($request);
            $language_id = auth('api')->user()->getCompany()->language_id;
            $message = ($language_id == 1) ? 'Successfully added!' : "Erfolgreich hinzugefügt!" ;
            return response()->json(['message' => $message, 'submodel' => $existing_submodel], 200);
          }else{
            return response()->json(['message' => 'This submodel already exists for this model'], 200);
          }
        }

        $submodel = new Submodel();
        $submodel->store($request);

        $language_id = auth('api')->user()->getCompany()->language_id;
        $message = ($language_id == 1) ? 'Successfully added!' : "Erfolgreich hinzugefügt!" ;

        return response()->json(['message' => $message, 'submodel' => $submodel], 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $submodel = Submodel::find($id);

        return response()->json([
            'submodel' => $submodel,
            'good_name' => $submodel->getName(),
            'brand_name' => $submodel->getBrandName(),
            'model_name' => $submodel->getModelName(),
            'submodel_name' => $submodel->getSubmodelName(),
        ]);
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
