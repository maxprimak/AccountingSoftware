@extends('layouts.master')
@section('page-css')
  <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
  <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
  <link rel="stylesheet" href="{{asset('assets/styles/vendor/dropzone.min.css')}}">
@endsection

@section('main-content')
    <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab"
                                aria-controls="invoice" aria-selected="true">Invoice</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit"
                                aria-selected="false">Edit</a>
                        </li>

                    </ul>
                    <div class="card">

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                                <div class="d-sm-flex mb-5" data-view="print">
                                    <span class="m-auto"></span>
                                    <button id="doc-without-logo" style="margin-left: 5px;" class="btn btn-primary">Doc without logo</button>
                                    <button id="doc-with-logo" style="margin-left: 5px; display:none" class="btn btn-primary">Doc with logo</button>
                                    <button style="margin-left: 5px;" class="btn btn-primary mb-sm-0 mb-3 print-invoice">Print Invoice</button>
                                </div>
                                <!---===== Print Area =======-->
                                <div id="print-area">
                                <center><img id="image-doc" src="{{asset('assets/images/logo_phone_factory_2.jpg')}}" style="margin-bottom: 30px;"></center>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="font-weight-bold">Rechnung Handy Differenz @if($rechnungHandDif->number != null)# {{$rechnungHandDif->number}}</h3>@endif
                                            @if($rechnungHandDif->date != null)<p style="font-size: 14px;">{{$rechnungHandDif->date}}</p>@endif
                                        </div>
                                        <div class="col-md-6 text-sm-right">
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row mb-5">
                                        <div class="col-md-6 mb-3 mb-sm-0">
                                            <h4 class="font-weight-bold">Von:</h4>
                                            <span style="white-space: pre-line; font-size: 14px;">
                                                @if($rechnungHandDif->shop != null)<strong class="">Shop:</strong> {{$rechnungHandDif->shop}}<br>@endif
                                                @if($rechnungHandDif->shop_tel != null)<strong class="">Tel:</strong> {{$rechnungHandDif->shop_tel}}<br>@endif
                                                @if($rechnungHandDif->shop_email != null)<strong class="">Email:</strong> {{$rechnungHandDif->shop_email}}<br>@endif
                                                @if($rechnungHandDif->web != null)<strong class="">Web:</strong> {{$rechnungHandDif->web}}<br>@endif
                                                
                                                @if($rechnungHandDif->kundenbetreuer != null)
                                                <strong class="">Ihr Kundenbetreuer:</strong>
                                                {{$rechnungHandDif->kundenbetreuer}}
                                                @endif

                                                @if($rechnungHandDif->zahlungsmodalitat != null)
                                                <strong class="">Zahlungmodalität:</strong>
                                                {{$rechnungHandDif->zahlungsmodalitat}}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="col-md-6 text-sm-right">
                                            <h4 class="font-weight-bold">An:</h4>
                                            <span style="white-space: pre-line; font-size:14px;">
                                            @if($rechnungHandDif->kunde != null)<strong class="">Kunde:</strong> {{$rechnungHandDif->kunde}}<br>@endif
                                            @if($rechnungHandDif->kunde_tel != null)<strong class="">Telefon:</strong> {{$rechnungHandDif->kunde_tel}}<br>@endif
                                            @if($rechnungHandDif->kunde_email != null)<strong class="">Email:</strong> {{$rechnungHandDif->kunde_email}}<br>@endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                    @if($rechnungHandDif->text_head != null)<p style="font-size: 16px;">{{$rechnungHandDif->text_head}}<br>@endif
                                    @if($rechnungHandDif->text_body != null){{$rechnungHandDif->text_body}}@endif
                                    <br>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table style="font-size: 14px;" class="table table-hover mb-4">
                                                <thead class="bg-gray-300">
                                                    <tr>
                                                        <th scope="col">Artikelbeschreibung</th>
                                                        <th scope="col">Menge</th>
                                                        <th scope="col">Preis</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(sizeof($items) == 0)
                                                    <tr>
                                                        <td scope="row"></th>
                                                        <td>No items yet</td>
                                                        <td></td>
                                                    </tr>
                                                    @else
                                                    @foreach($items as $item)
                                                    <tr>
                                                        <td scope="row">{{$item->artikelbeschreibung}}</th>
                                                        <td>{{$item->menge}}</td>
                                                        <td>{{number_format($item->preis, 2, '.', '')}}€</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="invoice-summary">
                                                <h5 class="font-weight-bold">Gesamt:<span>{{number_format($price, 2, ".", "")}}</span>€</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--==== / Print Area =====-->
                            </div>
                            <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                                <!--==== Edit Area =====-->
                                    <form action="/rechnung_hand_dif/update/{{$rechnungHandDif->id}}"  method="POST">
                                    <div class="d-flex mb-5">
                                    <span class="m-auto"></span>
                                    <button style="margin-left: 5px;" class="btn btn-primary">Save</button>
                                </div>
                                    <center><img id="image-edit" src="{{asset('assets/images/logo_phone_factory_2.jpg')}}" style="margin-bottom: 30px;"></center>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3 class="font-weight-bold">Rechnung Handy Differenz #</h3><input type="text" placeholder="Leave empty to hide field" name="number" style="font-size: 14px;" class="form-control col-md-6" value="{{$rechnungHandDif->number}}" />
                                            <br>
                                            <input placeholder="Leave empty to hide field"  class="form-control" name="date" style="font-size: 14px;" value="{{$rechnungHandDif->date}}" />
                                        </div>
                                        <div class="col-md-6 text-sm-right">
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row mb-5">
                                        <div class="col-md-8 mb-3 mb-sm-0">
                                            <h4 class="font-weight-bold">Von:</h4>
                                            <div class="col-md-5">
                                            <span style="white-space: pre-line; font-size: 14px;">
                                                <strong class="">Shop:</strong><input placeholder="Leave empty to hide field" type="text" name="shop" class="form-control" value="{{$rechnungHandDif->shop}}"/>
                                                <strong class="">Tel:</strong><input placeholder="Leave empty to hide field" type="text" name="shop_tel" class="form-control" value="{{$rechnungHandDif->shop_tel}}" />
                                                <strong class="">Email:</strong><input placeholder="Leave empty to hide field" type="text" name="shop_email" class="form-control" value="{{$rechnungHandDif->shop_email}}" />
                                                <strong class="">Web:</strong><input placeholder="Leave empty to hide field" type="text" name="web" class="form-control" value="{{$rechnungHandDif->web}}" />

                                                <strong class="">Ihr Kundenbetreuer:</strong>
                                                <input placeholder="Leave empty to hide field" type="text" class="form-control" name="kundenbetreuer" value="{{$rechnungHandDif->kundenbetreuer}}" />

                                                <strong class="">Zahlungmodalität:</strong>
                                                <select name="zahlungsmodalitat" class="form-control">
                                                    <option selected hidden value="{{$rechnungHandDif->zahlungsmodalitat}}">{{$rechnungHandDif->zahlungsmodalitat}}</option>
                                                    <option value="Karte">Karte</option>
                                                    <option value="Bar">Bar</option>
                                                </select>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-sm-right">
                                            <h4 class="font-weight-bold">An:</h4>
                                            <span style="white-space: pre-line; font-size:14px;">
                                            <strong>Kunde:</strong><input placeholder="Leave empty to hide field" type="text" name="kunde" width="50%" class="form-control" value="{{$rechnungHandDif->kunde}}" />
                                            <strong >Telefon:</strong><input placeholder="Leave empty to hide field" type="text" name="kunde_tel" class="form-control" value="{{$rechnungHandDif->kunde_tel}}" />
                                            <strong >Email:</strong><input placeholder="Leave empty to hide field" type="text" name="kunde_email" class="form-control" value="{{$rechnungHandDif->kunde_email}}" />
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                    <input placeholder="Leave empty to hide field"  style="font-size: 16px;" class="form-control col-md-4" name="text_head" value="{{$rechnungHandDif->text_head}}" />
                                    <br>
                                    <textarea placeholder="Leave empty to hide field" style="font-size: 16px;" name="text_body" cols="10" rows="5" class="form-control">{{$rechnungHandDif->text_body}}</textarea>
                                    <br>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-hover mb-3">
                                                <thead class="bg-gray-300">
                                                    <tr>
                                                        <th scope="col" width="50%">Artikelbeschreibung</th>
                                                        <th scope="col">Menge</th>
                                                        <th scope="col">Preis</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody-item">
                                                    @foreach($items as $item)
                                                    <tr>
                                                        <td>
                                                            <textarea required class="form-control"
                                                                placeholder="Item Name" name="artikelbeschreibung[]">{{$item->artikelbeschreibung}}</textarea>
                                                        </td>
                                                        <td>
                                                            <input required type="number" step="0.01" class="form-control"
                                                                placeholder="Unit Price" name="menge[]" value="{{$item->menge}}">
                                                        </td>
                                                        <td>
                                                            <input required class="form-control preis-input" step="0.01" type="number"
                                                                placeholder="Unit" name="preis[]" value="{{number_format($item->preis, 2, '.', '')}}">
                                                        </td>
                                                        <td>
                                                            <button  onclick="$(this).parent().parent().remove()" type="button" class="btn btn-outline-secondary float-right delete-item">Delete</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary float-right mb-4" type="button" id="add-item">Add Item</button>
                                            <button class="btn btn-primary float-right mb-4 mr-1">Save</button>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="invoice-summary">
                                            <button type="button" id="show-prices" class="btn">Show Final Prices</button>
                                                <br><br>
                                                <div id="final-prices" style="display: none">
                                                <h5 class="font-weight-bold">Gesamt:<span id="gesamt">00.00</span>€</h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                                <!--==== / Edit Area =====-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>



@endsection

@section('page-js')
<script>

    //create/delete new item in table
    //deleting in html code

    //item
    var item = "<tr>" + 
                "<td>" +
                "<textarea required class='form-control' placeholder='Item Name' name='artikelbeschreibung[]'>" +
                "</textarea>" +
                "</td>" + 
                "<td>" + 
                "<input required type='number' class='form-control'placeholder='Unit Price' step='0.01' name='menge[]'>" + 
                "</td>" + 
                "<td>" +
                "<input required type='number' class='form-control preis-input'placeholder='Unit' step='0.01' name='preis[]'>" +
                "</td>" +
                "<td>" +
                "<button type='button' onclick='$(this).parent().parent().remove()' class='btn btn-outline-secondary float-right delete-item'>Delete</button>" +
                "</td>" +
                "</tr>";

    //add item
    $("#add-item").click(function(){
        $("#tbody-item").prepend(item);
    });

</script>
<script>

    //remove/add logo
    
    //remove logo
    $("#doc-without-logo").click(function(){
        $(this).hide();
        $("#doc-with-logo").show();
        $("#image-edit").hide();
        $("#image-doc").hide();
    });

    //add logo
    $("#doc-with-logo").click(function(){
        $(this).hide();
        $("#doc-without-logo").show();
        $("#image-edit").show();
        $("#image-doc").show();
    })

</script>
<script>
    
    //function to show prices on click
    $("#show-prices").click(function(){
        var gesamt = 0;

        //sum prices of all inputs
        $(".preis-input").each(function(){
            var preis = parseFloat($(this).val());
            if(!isNaN(preis)){
                gesamt += preis;
            }
        });

        //set prices
        javascript:document.getElementById('gesamt').innerHTML= gesamt.toFixed(2);

        //edit button text
        javascript:document.getElementById('show-prices').innerHTML= "Update Final Prices";

        //show prices
        $("#final-prices").show();
    });

</script>
<script src="{{asset('assets/js/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('assets/js/dropzone.script.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>
<script src="{{asset('assets/js/invoice.script.js')}}"></script>
@endsection
