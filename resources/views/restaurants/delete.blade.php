@extends('layouts.app')

@section('content')
<h4>Are you sure you want to Delete Restaurant {{$restaurant->name}}?</h4>

<form method="POST" action="/restaurant/{{$restaurant->id}}/delete/">

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<button type="submit" class="btn btn-default">Delete</button>
</form>
<a href="/restaurant/{{$restaurant->id}}/menu/">
	<button type="button" class="btn btn-default">Cancel</button>	
</a>
@endsection