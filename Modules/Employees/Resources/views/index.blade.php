@extends('layouts.master')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Employees</title>
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@3.x/css/materialdesignicons.min.css" rel="stylesheet">
  <script src="{{asset('/assets/js/laravel/app.js')}}" defer></script>
</head>

@section('main-content')
<div id="app">
    <employees-table :employees="{{ $employees }}" :branches="{{ $branches }}" :roles="{{ $roles }}" :auth_id="{{ Auth::user()->id }}"></employees-table>
</div>
@endsection