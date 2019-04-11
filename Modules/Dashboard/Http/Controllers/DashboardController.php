<?php

namespace Modules\Dashboard\Http\Controllers;

use Modules\Dashboard\Entities\Kostenvoranschlag;
use Modules\Dashboard\Entities\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function showDashboard()
    {
        return view('dashboard::dashboard');
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

    public function showRechnungHandDif(){
        return view('dashboard::rechnung_handy_differenz');
    }

    public function showKostenvoranschlag($id){
        $kostenvoranschlag = Kostenvoranschlag::find($id);
        $items = Item::where('kostenvoranschlag_id', $id)->get();

        $price = ($kostenvoranschlag->kost29 == 1) ? 29 : 0;
        foreach($items as $item){
            $price += $item->preis;
        }

        return view('dashboard::kostenvoranschlag', compact('kostenvoranschlag','items','price'));
    }

    public function showAllKostenvoranschlage(){
        $kostenvoranschlage = Kostenvoranschlag::all()->sortByDesc("id");;
        return view('dashboard::all_kostenvoranschlage', compact('kostenvoranschlage'));
    }

    public function showKaufvertrag(){
        return view('dashboard::kaufvertrag');
    }

    public function createKostenvoranschlag(){
        
        $kostenvoranschlag = Kostenvoranschlag::create([
            'date' => 'Datum: ' . date('d.m.y'),
            'shop' => 'Neubau Phone Factory',
            'shop_tel' => '+43(0)1 5223397',
            'shop_email' => 'neubau@phonefactory.at', 
            'web' => 'www.phonefactory.at', 
            'kundenbetreuer' => 'The Phone Factory Team',
            'zahlungsmodalitat' => 'Bar',
            'kunde' => 'Vorname Nachname',
            'kunde_tel' => '+43 12345678290',
            'kunde_email' => 'example@mail.at', 
            'text_head' => 'Sehr geehrte Damen und Herren,',
            'text_body' => 'Für nachfolgend angeführte Produkte erlauben wir wie folgt Rechnung zu legen. Alle Produkte bleiben bis zu ihrer vollständigen Bezahlung unser Eigentum. Es gelten die AGB.'
        ]);

        return redirect()->back();
    }

    public function updateKostenvoranschlag(Request $data, $id){
        
        Kostenvoranschlag::where('id', $id)->update([
            'date' => $data['date'],
            'shop' => $data['shop'],
            'shop_tel' => $data['shop_tel'],
            'shop_email' => $data['shop_email'],
            'web' => $data['web'],
            'kundenbetreuer' => $data['kundenbetreuer'],
            'zahlungsmodalitat' => $data['zahlungsmodalitat'],
            'kunde' => $data['kunde'],
            'kunde_tel' => $data['kunde_tel'],
            'kunde_email' => $data['kunde_email'],
            'text_head' => $data['text_head'],
            'text_body' => $data['text_body'],
            'kost29' => $data['kost29']
        ]);
        
        $kostenvoranschlag = Kostenvoranschlag::find($id);
        $items = array();

        if($data->has(['artikelbeschreibung', 'menge', 'preis']))
        $items = $this->createItems($data['artikelbeschreibung'], $data['menge'], $data['preis']);
        
        $this->addItems($items, $kostenvoranschlag);

        return redirect()->back();
    }

    public function addItems($items, $kostenvoranschlag){
        Item::where('kostenvoranschlag_id', $kostenvoranschlag->id)->delete();

        foreach($items as $item){
            $item->kostenvoranschlag_id = $kostenvoranschlag->id;
            $item->save();
        }
    }

    public function createItems($artikelbeschreibungen, $mengen, $preise){
        $items = array();
        for($i=0; $i < sizeof($artikelbeschreibungen); $i++){
            $item = Item::create([
                'artikelbeschreibung' => $artikelbeschreibungen[$i],
                'menge' => $mengen[$i],
                'preis' => $preise[$i]
            ]);
            array_push($items, $item);
        }
        return $items;
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
