@extends('layouts.master')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{asset('/assets/js/laravel/app.js')}}" defer></script>
</head>

@section('main-content')
@php
@endphp
<div id="app">
    <companies-table :companies="{{$companies}}"></companies-table>
</div>
@endsection