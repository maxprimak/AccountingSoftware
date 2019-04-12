@extends('layouts.master')
@section('page-css')
  <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
  <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
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
                                    <button style="margin-left: 5px;" class="btn btn-primary mb-sm-0 mb-3 print-invoice">Print Invoice</button>                                </div>
                                <!---===== Print Area =======-->
                                <div id="print-area">
                                <center><img id="image-edit" src="{{asset('assets/images/logo_phone_factory_2.jpg')}}" style="margin-bottom: 30px;"></center>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="font-weight-bold">Kaufvertrag</h4>
                                            @if($kaufvertrag->ort_datum != null)<p style="font-size: 14px;">{{$kaufvertrag->ort_datum}}</p>@endif
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-sm-0">
                                            <span style="white-space: pre-line; font-size: 14px;">
                                                @if($kaufvertrag->name != null)<h5><strong>Name des Varkäufers: </strong></h5>{{$kaufvertrag->name}}<br><br>@endif
                                                @if($kaufvertrag->telefon != null)<h5><strong>Telefon Nr.: </strong></h5>{{$kaufvertrag->telefon}}<br><br>@endif
                                                @if($kaufvertrag->adresse != null)<h5><strong>Adresse: </strong></h5>{{$kaufvertrag->adresse}}<br><br>@endif
                                                @if($kaufvertrag->ort_plz != null)<h5><strong>Ort/PLZ: </strong></h5>{{$kaufvertrag->ort_plz}}<br><br>@endif
                                            </span>
                                        </div>
                                        <div class="col-md-6 text-sm-right">
                                            <span style="white-space: pre-line; font-size:14px;">
                                                @if($kaufvertrag->modell != null)<h5><strong>Modell: </strong></h5>{{$kaufvertrag->modell}}<br><br>@endif
                                                @if($kaufvertrag->imei != null)<h5><strong>IMEI: </strong></h5>{{$kaufvertrag->imei}}<br><br>@endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-1">
                                            <input @if($kaufvertrag->mobil == 1){{'checked'}}@endif type="checkbox" class="form-control" />
                                        </div>
                                        <div class="col-md-2">
                                            <h5 style="line-height:32px;"><strong>Mobiltelefon</strong><h5>
                                        </div>
                                        <div class="col-md-1">
                                            <input @if($kaufvertrag->tablet == 1){{'checked'}}@endif type="checkbox" class="form-control" />
                                        </div>
                                        <div class="col-md-2">
                                            <h5 style="line-height:32px;"><strong>Tablet</strong><h5>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                        @if($kaufvertrag->text_body != null)<p style="font-size: 16px;">{{$kaufvertrag->text_body}}</p>@endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                        <p style="font-size: 16px;"><strong>Unterschrift des Verkäufers: ______________________</strong></p>
                                        </div>
                                    </div>
                                </div>
                                <!--==== / Print Area =====-->
                            </div>
                            <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                                <!--==== Edit Area =====-->
                                <form action="/kaufvertrag/update/{{$kaufvertrag->id}}" method="POST">
                                @csrf
                                <div class="d-flex mb-5">
                                    <span class="m-auto"></span>
                                    <button class="btn btn-primary">Save</button>
                                </div>
                                <center><img id="image-doc" src="{{asset('assets/images/logo_phone_factory_2.jpg')}}" style="margin-bottom: 30px;"></center>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="font-weight-bold">Kaufvertrag</h4>
                                            <input class="form-control col-md-4" placeholder="Leave empty to hide field" style="font-size: 14px;" name="ort_datum" value="{{$kaufvertrag->ort_datum}}" />
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row">
                                        <div class="col-md-8 mb-3 mb-sm-0">
                                            <span style="white-space: pre-line; font-size: 14px;">
                                                <h5><strong>Name des Varkäufers: </strong></h5><input type="text" placeholder="Leave empty to hide field" name="name" class="form-control col-md-5" value="{{$kaufvertrag->name}}" />
                                                <h5><strong>Telefon Nr.: </strong></h5><input type="text" placeholder="Leave empty to hide field" name="telefon" class="form-control col-md-5" value="{{$kaufvertrag->telefon}}" />
                                                <h5><strong>Adresse: </strong></h5><input type="text" placeholder="Leave empty to hide field" name="adresse" class="form-control col-md-5" value="{{$kaufvertrag->adresse}}" />
                                                <h5><strong>Ort/PLZ: </strong></h5><input type="text" placeholder="Leave empty to hide field" name="ort_plz" class="form-control col-md-5" value="{{$kaufvertrag->ort_plz}}" />
                                            </span>
                                        </div>
                                        <div class="col-md-4 text-sm-right">
                                            <span style="white-space: pre-line; font-size:14px;">
                                                <h5><strong>Modell: </strong></h5><input type="text" placeholder="Leave empty to hide field" class="form-control" name="modell" value="{{$kaufvertrag->modell}}" />
                                                <h5><strong>IMEI: </strong></h5><input type="text" placeholder="Leave empty to hide field" class="form-control" name="imei" value="{{$kaufvertrag->imei}}" />
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-1">
                                            <input type="hidden" name="mobil" value="0">
                                            <input type="checkbox" @if($kaufvertrag->mobil == 1){{'checked'}}@endif name="mobil" value="1" class="form-control" />
                                        </div>
                                        <div class="col-md-2">
                                            <h5 style="line-height:32px;"><strong>Mobiltelefon</strong><h5>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="hidden" name="tablet" value="0">
                                            <input type="checkbox" @if($kaufvertrag->tablet == 1){{'checked'}}@endif name="tablet" value="1" class="form-control" />
                                        </div>
                                        <div class="col-md-2">
                                            <h5 style="line-height:32px;"><strong>Tablet</strong><h5>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 border-top"></div>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                        <textarea placeholder="Leave empty to hide field" name="text_body" cols="200" rows="10" class="form-control" style="font-size: 16px;">{{$kaufvertrag->text_body}}</textarea>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-5">
                                    <span class="m-auto"></span>
                                    <button class="btn btn-primary">Save</button>
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
<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>
<script src="{{asset('assets/js/invoice.script.js')}}"></script>
@endsection
