<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Submodel;
// use Modules\Goods\GoodsData\gsm;


class SubmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($model_id)
    {
        $submodels = Submodel::where('model_id',$model_id)->get();
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
    public function store(Request $request)
    {

        $existing_submodel = Submodel::where([['name','=', $request->name],['model_id','=', $request->model_id]])->first();

        if($existing_submodel){
          return response()->json(['message' => 'This submodel already exists for this model'], 200);
        }

        $submodel = new Submodel();
        $submodel->store($request);

        return response()->json(['message' => 'Successfully added!', 'submodel' => $submodel], 200);
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
