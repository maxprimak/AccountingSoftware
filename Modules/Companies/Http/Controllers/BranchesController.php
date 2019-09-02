<?php

namespace Modules\Companies\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Currency;
use Modules\Companies\Entities\Branch;
use Modules\Companies\Http\Requests\StoreBranchRequest;
use Modules\Companies\Http\Requests\UpdateBranchRequest;

class BranchesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {   
        return view('companies::branches.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreBranchRequest $request)
    {
        $branch = new Branch();
        $branch = $branch->store($request);

        return response()->json([
            'message' => 'Successfully created!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateBranchRequest $request, $id)
    {
        $branch = Branch::find($id);
        $branch = $branch->storeUpdated($request);

        return response()->json([
            'message' => 'Successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $branch = Branch::find($id);
        $branch->delete();

        return response()->json([
            'message' => 'Successfully deleted!'
        ]);
    }
}
