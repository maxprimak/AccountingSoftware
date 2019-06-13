@extends('layouts.master')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{asset('/assets/js/laravel/app.js')}}" defer></script>
</head>


@section('main-content')
  <div id="app">
    <new-repair></new-repair>
    </div>
@endsection
