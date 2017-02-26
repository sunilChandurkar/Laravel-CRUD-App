@extends('layouts.app')

@section('content')
<h1>New Menu Item</h1>
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

<form method="POST" action="/restaurant/{{$restaurant_id}}/menu/new/">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
	<label for="item-name">Name:</label>
	<input type="text" class="form-control" name="item-name" value="{{old('item-name')}}">
</div>
<div class="form-group">
	<label for="item-description">Description:</label>
	<textarea class="form-control" name="item-description">{{old('item-description')}}</textarea>
</div>
<div class="form-group">
	<label for="item-price">Price:</label>
	<input type="text" class="form-control" name="item-price" value="{{old('item-price')}}">
</div>
<h4>Course:</h4>
<div class="form-check">
  <label class="form-check-label">
    <input class="form-check-input" type="radio" name="course" value="appetizer">
    Appetizer
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    <input class="form-check-input" type="radio" name="course" value="entree">
    Entree
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    <input class="form-check-input" type="radio" name="course" value="dessert">
    Dessert
  </label>
</div>

<button type="submit" class="btn btn-default">Create</button>
</form>
@endsection