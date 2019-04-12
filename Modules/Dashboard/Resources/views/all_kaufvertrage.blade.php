@extends('layouts.master')
<head>
  <link rel="stylesheet" href="assets/styles/css/themes/lite-purple.min.css">
  <link rel="stylesheet" href="assets/styles/vendor/perfect-scrollbar.css">
</head>

<?php
use Modules\Dashboard\Entities\Kaufvertrag;
?>

@section('main-content')
    <h2>Kaufverträge</h2>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                <form action="{{route('kaufvertrag.create')}}" method="POST">
                    @csrf
                    <button class="float-right btn btn-success m-1">Add New</button>
                </form>
                    <div class="card-title mb-3">All:</div>
                        <div class="row">
                            @if(sizeof(Kaufvertrag::all()) == 0)
                            <div class="col-md-12 form-group mb-12">
                                <center>No Documents yet</center>
                            </div>
                            @else
                            <div class="col-md-1 form-group mb-1">
                                <label for="id">Print</label>
                                <br>
                                @foreach($kaufvertrage as $kaufvertrag)
                                <a href="/kaufvertrag/edit/{{$kaufvertrag->id}}" style="margin-bottom:3px;"  class="btn btn-primary">Edit & Print</a>
                                @endforeach
                            </div>
                          <div class="col-md-1 form-group mb-1">
                            <label for="id">ID</label>
                            @foreach($kaufvertrage as $kaufvertrag)
                            <input disabled type="text" style="margin-bottom:3px;" class="form-control" id="firstName1" name="username" value="{{$kaufvertrag->id}}">
                            @endforeach
                          </div>
                          <div class="col-md-2 form-group mb-3">
                              <label for="firstName1">Name des Verkäufers:</label>
                              @foreach($kaufvertrage as $kaufvertrag)
                              <input disabled type="text" style="margin-bottom:3px;" class="form-control" id="firstName1" name="username" value="{{$kaufvertrag->name}}">
                                @endforeach
                          </div>

                            <div class="col-md-2 form-group mb-3">
                                <label for="firstName1">Telefon:</label>
                                @foreach($kaufvertrage as $kaufvertrag)
                                <input disabled type="text" style="margin-bottom:3px;" class="form-control" id="firstName1" placeholder="Enter your full name" value="{{$kaufvertrag->telefon}}">
                                @endforeach
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <label for="lastName1">Modell</label>
                                @foreach($kaufvertrage as $kaufvertrag)
                                <input disabled type="text" style="margin-bottom:3px;" class="form-control" id="lastName1" placeholder="Enter your last name" value="{{$kaufvertrag->modell}}">
                                @endforeach
                            </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
     </div>
  </script>
  <script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
  <script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
  <script src="{{asset('assets/js/es5/dashboard.v1.script.js')}}"></script>
  <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
  <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
  <script src="assets/js/vendor/perfect-scrollbar.min.js"></script>

  <script src="assets/js/es5/script.min.js"></script>
  <script src="assets/js/es5/sidebar.large.script.min.js"></script>

@endsection
