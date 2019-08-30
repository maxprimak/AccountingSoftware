@extends('layouts.master')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Create employee</title>
  <script src="{{asset('/assets/js/laravel/app.js')}}" defer></script>
</head>

@section('main-content')
<div id="app">
    <create-employee :branchs="{{ $branchs }}" :roles="{{ $roles }}"></create-employee>
</div>
@endsection