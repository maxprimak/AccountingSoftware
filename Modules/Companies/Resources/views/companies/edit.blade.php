@extends('layouts.master')

@section('main-content')
<form action="{{route('companies.update', ['company_id' => 1])}}" method="POST">
{{csrf_field()}}
<input type="text" placeholder="Currency ID" name="currency_id" value="{{$company->currency_id}}">
<input type="text" placeholder="Name" name="name" value="{{$company->name}}">
<input type="text" placeholder="Address" name="address" value="{{$company->address}}">
<input type="text" placeholder="Phone" name="phone" value="{{$company->phone}}">
<button type="submit">Submit</button>
</form>
@endsection