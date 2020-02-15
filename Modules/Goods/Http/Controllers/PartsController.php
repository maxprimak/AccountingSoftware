<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Goods\Entities\Part;
use Modules\Goods\Entities\PartsTranslation;
use Modules\Goods\Http\Requests\StorePartRequest;
use DB;
class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $company = auth('api')->user()->getCompany();
        $parts_ids = Part::where('is_custom',0)->pluck('id')->toArray();
        $parts = PartsTranslation::whereIn('part_id',$parts_ids)->get();
        $parts_of_company = DB::table('company_has_parts')
                    ->join('parts', 'parts.id', '=', 'company_has_parts.part_id')
                    ->join('parts_translations', 'parts_translations.part_id', '=', 'company_has_parts.part_id')
                    ->select('parts.id as part_id','parts_translations.name as name')
                    ->where('company_has_parts.company_id',$company->id)
                    ->where('parts_translations.language_id',$company->language_id)
                    ->get();
        foreach ($parts_of_company as $part_of_company) {
          $parts->push($part_of_company);
        }

        return response()->json($parts);
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
    public function store(StorePartRequest $request)
    {
        $company = auth('api')->user()->getCompany();
        $part_translation = PartsTranslation::where('name',$request->name)->where('language_id',$company->language_id)->first();
        if($part_translation){
          $existing_part = Part::find($part_translation->part_id)->first();
        }else{
          $existing_part = null;
        }

        if($existing_part){
          $exists = $existing_part->checkIfExistsInCompany();
          if(!$exists){
            $existing_part->addToCompany($request);
            return response()->json(['message' => 'Successfully added!', 'part' => $existing_part], 200);
          }else{
            return response()->json(['message' => 'This submodel already exists for this model'], 200);
          }
          return response()->json(['message' => 'This part already exists'], 200);
        }

        $part = new Part();
        $part = $part->store($request);
        $part->name = $part->getTranslatedName();
        $part->part_id = $part->id;

        return response()->json(['message' => 'Successfully added!', 'part' => $part], 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {   
        $part = Part::find($id);
        $part->name = $part->getTranslatedName();
        return response()->json($part);
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
