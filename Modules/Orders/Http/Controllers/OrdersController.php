<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function showRepairOrdersPage()
    {
        return view('orders::RepairOrders');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function createRepairOrder()
    {
        return view('orders::CreateRepairOrders');
    }

    public function index(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('orders::show');
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
