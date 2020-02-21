<?php

namespace Modules\Services\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Services\Http\Requests\StoreServiceRequest;
use Modules\Services\Http\Requests\UpdateServiceRequest;
use Modules\Services\Entities\Service;
use Modules\Goods\Entities\Part;
use Modules\Services\Entities\ServicesTranslation;
use Modules\Services\Entities\ServiceHasPart;
use Modules\Services\Entities\CompanyHasService;


class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {   
        $company = auth('api')->user()->getCompany();
        $services_of_company_ids = CompanyHasService::where('company_id', $company->id)
                                                    ->pluck('service_id')->toArray();
        
        $services = Service::whereIn('id', $services_of_company_ids)
                    ->OrWhere('is_custom', 0)->orderBy('id', 'DESC')->get();


        $response = array();

        foreach($services as $service){

            $language_id = auth('api')->user()->getCompany()->language_id;

            $service_json = [
                'id' => $service->id,
                'name' => $service->getTranslatedName($language_id),
                'part_id' => $service->getPartId(),
                'part_name' => ($service->getPartId() == null) ? Part::getWithoutPartText() : Part::find($service->getPartId())->getTranslatedName($language_id)
            ];

            array_push($response, $service_json);

        }

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('services::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreServiceRequest $request)
    {

        if(!$request->nameUnique()){
            return response()->json([
                "message" => "Name of service is not unique",
                "errors" => [
                    "name" => ["Name is not unique"]
                ]
            ], 422);
        }

        $service = new Service();
        $service = $service->store($request);

        return response()->json([
            "message" => "service created",
            "service" => [
                'id' => $service->id,
                'name' => $service->getTranslatedName(auth('api')->user()->getCompany()->language_id),
                'part_id' => $service->getPartId()
            ]
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('services::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('services::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateServiceRequest $request, $id)
    {
        
        if(!$request->nameUnique()){
            return response()->json([
                "message" => "The given data was invalid",
                "errors" => [
                    "name" => ["Name is not unique"]
                ]
            ], 422);
        }

        $service = Service::find($id);
        $service->storeUpdated($request);

        return response()->json([
            "message" => "service updated"
        ]);
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
