<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Goods\Entities\Good;
use Modules\Goods\Http\Requests\StoreGoodRequest;
use Modules\Goods\Http\Requests\UpdateGoodRequest;
use Modules\Warehouses\Entities\WarehouseHasGood;
use Modules\Goods\Entities\GoodHasPrices;
use Modules\Warehouses\Entities\Warehouse;
use Modules\Goods\Entities\BranchHasGood;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($warehouse_id)
    {
        $warehouse = Warehouse::find($warehouse_id);
        $branch_id = $warehouse->getBranchId();
        $goods_id = WarehouseHasGood::where('warehouse_id',$warehouse_id)->pluck('good_id')->toArray();
        $warehouse_has_goods_ids = WarehouseHasGood::where('warehouse_id',$warehouse_id)->pluck('id')->toArray();
        $branch_has_goods_ids = BranchHasGood::whereIn('good_id',$goods_id)->where('branch_id',$branch_id)->pluck('id')->toArray();
        $goods_has_prices = GoodHasPrices::whereIn('branch_has_good_id',$branch_has_goods_ids)->get();

        $goods = DB::table('warehouse_has_goods')
                ->join('goods','goods.id', '=', 'warehouse_has_goods.good_id')
                ->join('brands', 'brands.id', '=', 'goods.brand_id')
                ->join('models', 'models.id', '=', 'goods.model_id')
                ->join('submodels', 'submodels.id', '=', 'goods.submodel_id')
                ->join('parts','parts.id', '=', 'goods.part_id')
                ->join('colors','colors.id', '=', 'goods.color_id')
                ->select('goods.id as id', 'brands.name as brand_name','brands.id as brand_id' ,'models.name as model_name','models.id as model_id',
                        'submodels.name as submodel_name','submodels.id as submodel_id' ,'parts.name as part_name','parts.id as part_id','colors.name as color_name',
                        'colors.id as color_id','warehouse_has_goods.id as warehouse_has_good_id','warehouse_has_goods.vendor_code as vendor_code',
                        'warehouse_has_goods.amount as amount')
                ->whereIn('warehouse_has_goods.id',$warehouse_has_goods_ids)
                ->get();
        $new_good = new Good();
        $result_of_goods = $new_good->combineGoodsWithPrices($goods_has_prices,$goods);

        return response()->json($result_of_goods);
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
        $existing_good = new Good();
        $existing_good = $existing_good->check_if_exists($request);

        if($existing_good){
          $exists = $existing_good->checkIfExistsOnWarehouse($request);
          if(!$exists){
            $existing_good->addToBranch($request);
            return response()->json(['message' => 'Successfully added!', 'good' => $existing_good], 200);
          }else{
            return response()->json(['message' => 'This good already exists in chosen Warehouse'], 422);
          }
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
        $good = Good::find($id);
        $request->brand_id = $good->brand_id;
        $request->model_id = $good->model_id;
        $request->submodel_id = $good->submodel_id;

        $existing_good = new Good();
        $existing_good = $existing_good->check_if_exists($request);
        if(!$existing_good){
          $warehouse_has_good = WarehouseHasGood::find($request->warehouse_has_good_id);
          $request->warehouse_id = $warehouse_has_good->id;

          $good = new Good();
          $good = $good->store($request);

          //remove from warehouse has good

          $warehouse_has_good->delete();

          //remove from branch has good
          $branch_id = Warehouse::find($warehouse_has_good->warehouse_id)->getBranchId();
          $branch_has_good = BranchHasGood::where('branch_id',$branch_id)->where('good_id',$id)->first();
          //remove from good has prices
          $good_has_prices = GoodHasPrices::where('branch_has_good_id',$branch_has_good->id)->first();
          $good_has_prices->delete();
          $branch_has_good->delete();

          return response()->json(['message' => 'Successfully added!', 'good' => $good], 200);
        }else{
          if($existing_good->id != $id){
            $request->good_id = $id;
            $good = $existing_good->edit($request);
          }else{
            return response()->json(['message' => 'Successfully updated!', 'good' => $good]);
          }
          return response()->json(['message' => 'Successfully updated!', 'good' => $good]);
        }
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
    // public function destroy($id)
    // {
    //
    //     return response()->json(['message' => 'Successfully deleted!']);
    // }
}
