@extends('layouts.app')

@section('content')
<h1>Edit Restaurant</h1>

<form method="POST" action="/restaurant/{{$restaurant->id}}/edit/">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
	<label for="restaurant-name">Restaurant Name:</label>
	<input type="text" class="form-control" name="restaurant-name" value="{{$restaurant->name}}">
</div>
<button type="submit" class="btn btn-default">Edit</button>
</form>
<a href="/restaurant/{{$restaurant->id}}/menu/">
<button type="button" class="btn btn-default">Cancel</button>
</a>
@endsection