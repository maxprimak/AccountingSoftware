<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Goods\Entities\Good;
use Modules\Goods\Http\Requests\StoreGoodRequest;
use Modules\Goods\Http\Requests\UpdateGoodRequest;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($branch_id)
    {
        $goods_id = Good::where('branch_id',$branch_id)->pluck('id')->toArray();
        $goods = DB::table('goods')
                    ->join('brands', 'brands.id', '=', 'goods.brand_id')
                    ->join('models', 'models.id', '=', 'goods.model_id')
                    ->join('submodels', 'submodels.id', '=', 'goods.submodel_id')
                    ->join('parts','parts.id', '=', 'goods.part_id')
                    ->join('colors','colors.id', '=', 'goods.color_id')
                    ->select('goods.id as id', 'brands.name as brand_name' ,'models.name as model_name',
                    'submodels.name as submodel_name', 'parts.name as part_name','colors.name as color_name','goods.amount')
                    ->whereIn('goods.id',$goods_id)
                    ->get();
        return response()->json($goods);
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
    public function store(StoreGoodRequest $request)
    {
      //IF THIS GOOD ALREADY EXIST THEN WE NEED TO ADD ONLY AMOUNT AND PRICE FROM REQUEST
      //IF GOOD DOES NOT EXIST CREATE A NEW ONE
        $existing_good = Good::where([['branch_id','=', $request->branch_id],['brand_id','=', $request->brand_id],
                                      ['color_id','=', $request->color_id],['model_id','=', $request->model_id],
                                      ['submodel_id','=', $request->submodel_id],['part_id','=', $request->part_id]
                                      ])->first();

        if($existing_good){
          $existing_good->amount += $request->amount;
          $existing_good->price = $request->price;
          $existing_good->save();

          return response()->json(['message' => 'Amount was added to good id:' .$existing_good->id, 'good' => $existing_good], 200);
        }

        $good = new Good();
        $good = $good->store($request);

        return response()->json(['message' => 'Successfully added!', 'good' => $good], 200);
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
    public function update(UpdateGoodRequest $request, $id)
    {
      try {
        $good = Good::findOrFail($id);
        $good = $good->edit($request);
      } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
      }
      return response()->json(['message' => 'Successfully updated!', 'good' => $good]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Good::findOrFail($id)->delete();
        return response()->json(['message' => 'Successfully deleted!']);
    }
}
