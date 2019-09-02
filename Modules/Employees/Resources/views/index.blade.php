@extends('layouts.master')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Employees</title>
  <script src="{{asset('/assets/js/laravel/app.js')}}" defer></script>
</head>

@section('main-content')
<div id="app">
    <employees-table :employees="{{ $employees }}" :branches="{{ $branches }}" :roles="{{ $roles }}"></employees-table>
</div>
@endsection