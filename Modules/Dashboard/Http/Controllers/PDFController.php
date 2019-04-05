<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
use PDF;
use File;
use Storage;
use App\Order;
use App\OrderProduct;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('dashboard::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('dashboard::create');
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
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard::edit');
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

    /**
     * 
     * 
     * 
     */
    public function checkboxToRequest($value, Request $request){
        if(!$request->has($value)){
            $request->request->add([$value => null]);
        }
    }

    /**
     * 
     * 
     */
    public function rechnungHandDif(Request $request){
        $pdf = PDF::loadView('dashboard::rechnung_handy_differenz', $request);
        redirect()->back();
        return $pdf->stream('RechnungHandyDiff_' . date('d.m.y') .'.pdf', array("Attachment" => 0));
    }

    /**
     * 
     * 
     */
    public function kaufVertrag(Request $request){
        $this->checkboxToRequest('is_mobil', $request);
        $this->checkboxToRequest('is_tablet', $request);
        $pdf = PDF::loadView('dashboard::kaufvertrag', $request);
        redirect()->back();
        return $pdf->stream('Kaufvertrag_' . date('d.m.y') .'.pdf', array("Attachment" => 0));
    }

    /**
     * 
     * 
     */
    public function kostenVoranschlag(Request $request){
        $pdf = PDF::loadView('dashboard::kostenvoranschlag', $request);
        redirect()->back();
        return $pdf->stream('Kaufvertrag_' . date('d.m.y') .'.pdf', array("Attachment" => 0));
    }
}
