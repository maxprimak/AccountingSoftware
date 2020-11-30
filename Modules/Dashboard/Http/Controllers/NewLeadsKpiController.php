<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\Customer;

class NewLeadsKpiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index()
    {
        $user = auth('api')->user()->user;
        $customers = Customer::where('company_id', $user->company_id)
            ->where('created_at', '>=', now()->startOfMonth())->get();

        $result = [
            'value' => $customers->count()
        ];
        return response()->json($result);
    }
}
