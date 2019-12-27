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
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($warehouse_id)
    {
        $company = auth('api')->user()->getCompany();
        $warehouse = Warehouse::find($warehouse_id);
        $branch_id = $warehouse->getBranchId();
        $goods_id = WarehouseHasGood::where('warehouse_id',$warehouse_id)->pluck('good_id')->toArray();
        $warehouse_has_goods_ids = WarehouseHasGood::where('warehouse_id',$warehouse_id)->pluck('id')->toArray();

        $goods_has_prices = GoodHasPrices::where('branch_id',$branch_id)->whereIn('good_id',$goods_id)->get();

        $goods = DB::table('warehouse_has_goods')
                ->join('goods','goods.id', '=', 'warehouse_has_goods.good_id')
                ->join('brands', 'brands.id', '=', 'goods.brand_id')
                ->join('models', 'models.id', '=', 'goods.model_id')
                ->join('submodels', 'submodels.id', '=', 'goods.submodel_id')
                ->join('parts','parts.id', '=', 'goods.part_id')
                ->join('parts_translations','parts_translations.part_id', '=', 'goods.part_id')
                ->join('colors','colors.id', '=', 'goods.color_id')
                ->select('goods.id as id', 'brands.name as brand_name','brands.id as brand_id' ,'models.name as model_name','models.id as model_id',
                        'submodels.name as submodel_name','submodels.id as submodel_id' ,'parts_translations.name as part_name','parts.id as part_id','colors.name as color_name',
                        'colors.id as color_id','warehouse_has_goods.id as warehouse_has_good_id','warehouse_has_goods.vendor_code as vendor_code',
                        'warehouse_has_goods.amount as amount')
                ->whereIn('warehouse_has_goods.id',$warehouse_has_goods_ids)
                ->where('parts_translations.language_id',$company->language_id)
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
        $existing_good = new Good();
        $exists = $existing_good->checkIfExistsOnWarehouse($request);

        if(!$exists){
          $good = new Good();
          $good = $good->store($request);
          return response()->json(['message' => 'Successfully added!', 'good' => $good], 200);
        }else{
          return response()->json(['message' => 'This good already exists in chosen Warehouse'], 422);
        }
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
        $good = $good->edit($request);
        return response()->json(['message' => 'Successfully updated!', 'good' => $good]);
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
