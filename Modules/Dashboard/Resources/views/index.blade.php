@extends('layouts.master')
@section('main-content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('dashboard.name') !!}
    </p>
@stop
