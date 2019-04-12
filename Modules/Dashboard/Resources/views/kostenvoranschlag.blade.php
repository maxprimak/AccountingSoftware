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
                                            <h3 class="font-weight-bold">Kostenvoranschlag</h3>
                                            @if($kostenvoranschlag->date != null)<p style="font-size: 14px;">{{$kostenvoranschlag->date}}</p>@endif
                                        </div>
                                        <div class="col-md-6 text-sm-right">
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row mb-5">
                                        <div class="col-md-6 mb-3 mb-sm-0">
                                            <h4 class="font-weight-bold">Von:</h4>
                                            <span style="white-space: pre-line; font-size: 14px;">
                                                @if($kostenvoranschlag->shop != null)<strong class="">Shop:</strong> {{$kostenvoranschlag->shop}}<br>@endif
                                                @if($kostenvoranschlag->shop_tel != null)<strong class="">Tel:</strong> {{$kostenvoranschlag->shop_tel}}<br>@endif
                                                @if($kostenvoranschlag->shop_email != null)<strong class="">Email:</strong> {{$kostenvoranschlag->shop_email}}<br>@endif
                                                @if($kostenvoranschlag->web != null)<strong class="">Web:</strong> {{$kostenvoranschlag->web}}<br>@endif

                                                @if($kostenvoranschlag->kundenbetreuer != null)
                                                <strong class="">Ihr Kundenbetreuer:</strong>
                                                {{$kostenvoranschlag->kundenbetreuer}}
                                                @endif

                                                @if($kostenvoranschlag->zahlungsmodalitat != null)
                                                <strong class="">Zahlungmodalität:</strong>
                                                {{$kostenvoranschlag->zahlungsmodalitat}}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="col-md-6 text-sm-right">
                                            <h4 class="font-weight-bold">An:</h4>
                                            <span style="white-space: pre-line; font-size:14px;">
                                            @if($kostenvoranschlag->kunde != null)<strong class="">Kunde:</strong> {{$kostenvoranschlag->kunde}}<br>@endif
                                            @if($kostenvoranschlag->kunde_tel != null)<strong class="">Telefon:</strong> {{$kostenvoranschlag->kunde_tel}}<br>@endif
                                            @if($kostenvoranschlag->kunde_email != null)<strong class="">Email:</strong> {{$kostenvoranschlag->kunde_email}}<br>@endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                    @if($kostenvoranschlag->text_head != null)<p style="font-size: 16px;">{{$kostenvoranschlag->text_head}}<br>@endif
                                    @if($kostenvoranschlag->text_body != null){{$kostenvoranschlag->text_body}}@endif
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
                                                    @if($kostenvoranschlag->kost29 == 1)
                                                    <tr>
                                                        <th scope="row">Kostenvoranschlag + Arbeitszeit €29.00</th>
                                                        <td></td>
                                                        <th>29.00€</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="invoice-summary">
                                                <p>Nettobetrag: <span>{{number_format($price-$price*0.2, 2, ".", "")}}</span>€</p>
                                                <p>MwSt. 20%: <span>{{number_format($price*0.2, 2, ".", "")}}</span>€</p>
                                                <h5 class="font-weight-bold">Gesamt:<span>{{number_format($price, 2, ".", "")}}</span>€</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--==== / Print Area =====-->
                            </div>
                            <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                                <!--==== Edit Area =====-->
                                    <form action="/kostenvoranschlag/update/{{$kostenvoranschlag->id}}"  method="POST">
                                    <div class="d-flex mb-5">
                                    <span class="m-auto"></span>
                                    <button style="margin-left: 5px;" class="btn btn-primary">Save</button>
                                </div>
                                    <center><img id="image-edit" src="{{asset('assets/images/logo_phone_factory_2.jpg')}}" style="margin-bottom: 30px;"></center>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3 class="font-weight-bold">Kostenvoranschlag</h3>
                                            <input class="form-control" name="date" placeholder="Leave empty to hide field"  style="font-size: 14px;" value="{{$kostenvoranschlag->date}}"" />
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
                                                <strong class="">Shop:</strong><input placeholder="Leave empty to hide field"  type="text" name="shop" class="form-control" value="{{$kostenvoranschlag->shop}}"/>
                                                <strong class="">Tel:</strong><input placeholder="Leave empty to hide field"  type="text" name="shop_tel" class="form-control" value="{{$kostenvoranschlag->shop_tel}}" />
                                                <strong class="">Email:</strong><input placeholder="Leave empty to hide field"  type="text" name="shop_email" class="form-control" value="{{$kostenvoranschlag->shop_email}}" />
                                                <strong class="">Web:</strong><input placeholder="Leave empty to hide field"  type="text" name="web" class="form-control" value="{{$kostenvoranschlag->web}}" />

                                                <strong class="">Ihr Kundenbetreuer:</strong>
                                                <input type="text" class="form-control" name="kundenbetreuer" placeholder="Leave empty to hide field"  value="{{$kostenvoranschlag->kundenbetreuer}}" />

                                                <strong class="">Zahlungmodalität:</strong>
                                                <select name="zahlungsmodalitat" class="form-control">
                                                    <option selected hidden value="{{$kostenvoranschlag->zahlungsmodalitat}}">{{$kostenvoranschlag->zahlungsmodalitat}}</option>
                                                    <option value="Karte">Karte</option>
                                                    <option value="Bar">Bar</option>
                                                </select>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-sm-right">
                                            <h4 class="font-weight-bold">An:</h4>
                                            <span style="white-space: pre-line; font-size:14px;">
                                            <strong>Kunde:</strong><input type="text" placeholder="Leave empty to hide field"  name="kunde" width="50%" class="form-control" value="{{$kostenvoranschlag->kunde}}" />
                                            <strong >Telefon:</strong><input type="text" placeholder="Leave empty to hide field"  name="kunde_tel" class="form-control" value="{{$kostenvoranschlag->kunde_tel}}" />
                                            <strong >Email:</strong><input type="text" placeholder="Leave empty to hide field"  name="kunde_email" class="form-control" value="{{$kostenvoranschlag->kunde_email}}" />
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                    <input placeholder="Leave empty to hide field"  style="font-size: 16px;" class="form-control col-md-4" name="text_head" value="{{$kostenvoranschlag->text_head}}" />
                                    <br>
                                    <textarea placeholder="Leave empty to hide field"  style="font-size: 16px;" name="text_body" cols="10" rows="5" class="form-control">{{$kostenvoranschlag->text_body}}</textarea>
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
                                                    @if($kostenvoranschlag->kost29 == 1)
                                                    <tr id="kost29-tr">
                                                        <th scope="row">Kostenvoranschlag + Arbeitszeit €29.00</th>
                                                        <td></td>
                                                        <td>
                                                            <input class=" form-control preis-input" type="number"
                                                                placeholder="Unit" value="29.00" name="preis[]">
                                                        </td>
                                                        <td>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary float-right mb-4" type="button" id="add-item">Add Item</button>
                                            <button class="btn btn-primary float-right mb-4 mr-1">Save</button>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-3">
                                            Kostenvoranschlag + Arbeitszeit €29.00 
                                            <input type="hidden" name="kost29" value="0">
                                            <input type="checkbox" @if($kostenvoranschlag->kost29 == 1){{'checked'}}@endif id="kost29" value="1" name="kost29" class="form-control col-md-1">
                                            </div>
                                            <div class="invoice-summary">
                                            <button type="button" id="show-prices" class="btn">Show Final Prices</button>
                                                <br><br>
                                                <div id="final-prices" style="display: none">
                                                <p>Nettobetrag: <span id="netto">23.20</span>€</p>
                                                <p>MwSt. 20%: <span id="mwst20">5.80</span>€</p>
                                                <h5 class="font-weight-bold">Gesamt:<span id="gesamt">29.00</span>€</h5>
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
        var netto = 0;
        var mwst20 = 0;
        var gesamt = 0;

        //sum prices of all inputs
        $(".preis-input").each(function(){
            var preis = parseFloat($(this).val());
            if(!isNaN(preis)){
                mwst20 += preis*0.2;
                netto += preis - preis*0.2;
                gesamt += preis;
            }
        });

        //set prices
        javascript:document.getElementById('netto').innerHTML= netto.toFixed(2);
        javascript:document.getElementById('mwst20').innerHTML= mwst20.toFixed(2);
        javascript:document.getElementById('gesamt').innerHTML= gesamt.toFixed(2);

        //edit button text
        javascript:document.getElementById('show-prices').innerHTML= "Update Final Prices";

        //show prices
        $("#final-prices").show();
    });

</script>
<script>

//show/hide kost29

var kost29 = "<tr id='kost29-tr'>" + 
                "<th scope='row'>Kostenvoranschlag + Arbeitszeit €29.00</th>" +
                "<td></td>" +
                "<td>" +
                "<input class='form-control preis-input' type='number'placeholder='Unit' value='29.00' name='preis[]'>" +
                "</td>" +
                "<td>" +
                "</td>" +
                "</tr>";

$("#kost29").on('change', function(){
    if($(this).is(':checked')) $("#tbody-item").append(kost29);
    else $("#kost29-tr").remove(); 
});

</script>
<script src="{{asset('assets/js/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('assets/js/dropzone.script.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>
<script src="{{asset('assets/js/invoice.script.js')}}"></script>
@endsection
