@extends('layouts.master')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{asset('/assets/js/laravel/app.js')}}" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@3.x/css/materialdesignicons.min.css" rel="stylesheet">
</head>

@section('main-content')
<div id="app">
  <customers-table :customers="{{$customers}}" :customer_types="{{$customer_types}}" :branches="{{$branches}}"></customers-table>
</div>
@endsection
