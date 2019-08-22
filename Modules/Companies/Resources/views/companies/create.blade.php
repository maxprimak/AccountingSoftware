@extends('layouts.master')

@section('main-content')
<form action="{{route('companies.store')}}" method="POST">
{{csrf_field()}}
<select name="currency_id">
    <option value="1">$</option>
    <option value="2">EUR</option>
</select>
<input type="text" placeholder="Name" name="name">
<input type="text" placeholder="Address" name="address">
<input type="text" placeholder="Phone" name="phone">
<button type="submit">Submit</button>
</form>
@endsection