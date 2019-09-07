@extends('layouts.master')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Create Customer</title>
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@3.x/css/materialdesignicons.min.css" rel="stylesheet">
  <script src="{{asset('/assets/js/laravel/app.js')}}" defer></script>
</head>

@section('main-content')
<div id="app">
    <create-customer :user_id="{{ $user->id }}" :branches="{{ $branches }}" :customer_types="{{ $customer_types }}"></create-customer>
</div>
@endsection
