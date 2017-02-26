@extends('layouts.app')

@section('content')
<h1>New Restaurant</h1>
<!--errors-->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!--ends errors-->
<div class="row">
    <div class="col-sm-4">
    </div>
</div>
<form method="POST" action="/restaurant/new/">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
	<label for="restaurant-name">Restaurant Name:</label>
	<input type="text" class="form-control" name="restaurant-name">
</div>
<button type="submit" class="btn btn-default">Create</button>
</form>
@endsection