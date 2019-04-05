@extends('layouts.master')
@section('main-content')
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            @if(!auth()->user()->hasVerifiedEmail())
            <div class="alert alert-danger">
                {{'Please verify your email adress. We have sent email to '. auth()->user()->email . '. If you do not see mail in inbox, check your spam folder. '}}
                <a href="{{ route('verification.resend') }}">Send email again</a><br>
                @if (session('resent'))
                            {{ __('A fresh verification link has been sent to your email address.') }}
                @endif
            </div>
            @endif
           <div class="breadcrumb">
            <br>
            <br>
                <h1>Generate PDF Files</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer" data-toggle="modal" data-target="#exampleModal">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Gear"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Rechnung Handy Diff.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer" data-toggle="modal" data-target="#kaufvertragModal">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Financial"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Kaufvertrag</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer" data-toggle="modal" data-target="#kostenvorschlagModal">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Money-2"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Kostenvoranschlag</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- modal handy diff -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rechnung Handy Differenz</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form id="form-handy-diff" action="/pdf/rechnung_hand_dif" method="POST">
                      {{ csrf_field() }}
                        <div class="card einheit-handy-diff" style="margin:10px; padding: 10px;">
                        <center><strong><p style="font-size:14px;">Reparatur Einheit</p></strong></center>
                        <div class="form-group">
                          <label for="handy_bezeichnung">Handy Bezeichnung</label>
                          <input type="text" class="form-control" id="handy_bezeichnung" name="handy_bezeichnung[]">
                        </div>
                        <div class="form-group">
                          <label for="reparatur_bezeichnung">Reparatur Bezeichnung</label>
                          <input type="text" class="form-control" id="reparatur_bezeichnung" name="reparatur_bezeichnung[]">
                        </div>
                        <div class="form-group">
                          <label for="imei">IMEI</label>
                          <input type="text" class="form-control" id="imei" name="imei[]">
                        </div>
                        <div class="form-group">
                          <label for="menge">Menge</label>
                          <input type="number" class="form-control" id="menge" name="menge[]">
                        </div>
                        <div class="form-group">
                          <label for="imei">Preis</label>
                          <input type="number" step="0.01" class="form-control" id="preis" name="preis[]">
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="add-more-handy-diff" class="btn btn-success">Add More</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                      <div class="collapse" id="collapseExample">
    	              </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end modal handy diff-->



                <!-- modal kaufvertrag -->
                <div class="modal fade" id="kaufvertragModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kaufvertrag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form id="form-handy-diff" action="/pdf/rechnung_hand_dif" method="POST">
                      {{ csrf_field() }}
                        <div class="card einheit-handy-diff" style="margin:10px; padding: 10px;">
                        <div class="form-group">
                          <label for="name">Name des Verkäufers</label>
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                          <label for="telefon">Telefon Nr.</label>
                          <input type="text" class="form-control" id="telefon" name="telefon">
                        </div>
                        <div class="form-group">
                          <label for="adresse">Adresse</label>
                          <input type="text" class="form-control" id="adresse" name="adresse">
                        </div>
                        <div class="form-group">
                          <label for="ort">Ort/PLZ</label>
                          <input type="number" class="form-control" id="ort" name="ort">
                        </div>
                        <div class="form-group">
                          <label for="modell">Modell</label>
                          <input type="number" step="0.01" class="form-control" id="modell" name="modell">
                        </div>
                        <div class="form-group">
                          <label for="imei">IMEI</label>
                          <input type="number" step="0.01" class="form-control" id="imei" name="imei">
                        </div>
                        <div class="form-group">
                          <center><label for="is_mobil">Mobiltelefon</label></center>
                          <input type="checkbox" class="form-control" id="is_mobil" name="is_mobil">
                        </div>
                        <div class="form-group">
                          <center><label for="is_tablet">Tablet</label></center>
                          <input type="checkbox" class="form-control" id="is_tablet" name="is_tablet">
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                      <div class="collapse" id="collapseExample">
    	              </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end modal kaufvertrag-->



                <!-- modal kostenvorschlag -->
                <div class="modal fade" id="kostenvorschlagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kostenvoranschlag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form id="form-kostenvoranschlag" action="/pdf/rechnung_hand_dif" method="POST">
                      {{ csrf_field() }}
                        <div class="card einheit-handy-diff" style="margin:10px; padding: 10px;">
                        <center><strong><p style="font-size:14px;">Reparatur Einheit</p></strong></center>
                        <div class="form-group">
                          <label for="handy_bezeichnung">Handy Bezeichnung</label>
                          <input type="text" class="form-control" id="handy_bezeichnung" name="handy_bezeichnung[]">
                        </div>
                        <div class="form-group">
                          <label for="reparatur_bezeichnung">Reparatur Bezeichnung</label>
                          <input type="text" class="form-control" id="reparatur_bezeichnung" name="reparatur_bezeichnung[]">
                        </div>
                        <div class="form-group">
                          <label for="imei">IMEI</label>
                          <input type="text" class="form-control" id="imei" name="imei[]">
                        </div>
                        <div class="form-group">
                          <label for="menge">Menge</label>
                          <input type="number" class="form-control" id="menge" name="menge[]">
                        </div>
                        <div class="form-group">
                          <label for="imei">Preis</label>
                          <input type="number" step="0.01" class="form-control" id="preis" name="preis[]">
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="add-more-kostenvoranschlag" class="btn btn-success">Add More</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                      <div class="collapse" id="collapseExample">
    	              </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end modal kostenvorschlag-->
@endsection

@section('page-js')
     <script>
     $(document).ready(function () {
      var card ='<div class="card" style="margin:10px; padding: 10px;">' +
                        '<center><strong><p style="font-size:14px;">Reparatur Einheit</p></strong></center>' +
                        '<div class="form-group">' +
                          '<label for="handy_bezeichnung">Handy Bezeichnung</label>'+
                          '<input type="text" class="form-control" id="handy_bezeichnung" name="handy_bezeichnung[]">' +
                        '</div>' +
                        '<div class="form-group">' +
                          '<label for="reparatur_bezeichnung">Reparatur Bezeichnung</label>' +
                          '<input type="text" class="form-control" id="reparatur_bezeichnung" name="reparatur_bezeichnung[]">' +
                        '</div>' +
                        '<div class="form-group">' +
                          '<label for="imei">IMEI</label>' +
                          '<input type="text" class="form-control" id="imei" name="imei[]">' +
                        '</div>' +
                        '<div class="form-group">' +
                          '<label for="menge">Menge</label>' +
                          '<input type="number" class="form-control" id="menge" name="menge[]">' +
                        '</div>' +
                        '<div class="form-group">' +
                          '<label for="imei">Preis</label>' +
                          '<input type="number" step="0.01" class="form-control" id="preis" name="preis[]">' +
                        '</div>' +
                          '<button type="button" onclick="$(this).parent().remove()"class="btn btn-danger delete-handy-diff">Remove</button>' +
                        '</div>';
        $("#add-more-handy-diff").click(function(e){
            e.preventDefault();
            //dynamic input
            $("#form-handy-diff").prepend(card);
        });
        $("#add-more-kostenvoranschlag").click(function(e){
            e.preventDefault();
            //dynamic input
            $("#form-kostenvoranschlag").prepend(card);
        });
    });
     </script>
     <script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
     <script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
     <script src="{{asset('assets/js/es5/dashboard.v1.script.js')}}"></script>
@endsection
