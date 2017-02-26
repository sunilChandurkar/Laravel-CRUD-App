@extends('layouts.app')

@section('content')
<h1>Edit {{$menuitem->name}}</h1>


<form method="POST" action="/restaurant/{{$restaurant->id}}/menu/{{$menuitem->id}}/edit">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
	<label for="item-name">Name:</label>
	<input type="text" class="form-control" name="item-name" value="{{$menuitem->name}}">
</div>
<div class="form-group">
	<label for="item-description">Description:</label>
	<textarea class="form-control" name="item-description">{{$menuitem->description}}</textarea>
</div>
<div class="form-group">
	<label for="item-price">Price:</label>
	<input type="text" class="form-control" name="item-price" value="{{$menuitem->price}}">
</div>
<h4>Course:</h4>
<div class="form-check">
  <label class="form-check-label">
    @if($menuitem->course=='appetizer')
    <input class="form-check-input" type="radio" name="course" value="appetizer" checked="true">
    Appetizer
    @else
    <input class="form-check-input" type="radio" name="course" value="appetizer">
    Appetizer
    @endif
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    @if ($menuitem->course=='entree')
    <input class="form-check-input" type="radio" name="course" value="entree" checked="true">
    Entree
    @else
    <input class="form-check-input" type="radio" name="course" value="entree">
    Entree
    @endif
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    @if($menuitem->course=='dessert')
    <input class="form-check-input" type="radio" name="course" value="dessert" checked="true">
    Dessert
    @else
    <input class="form-check-input" type="radio" name="course" value="dessert">
    Dessert
    @endif
  </label>
</div>

<button type="submit" class="btn btn-default">Edit</button>
</form>
<a href="/restaurant/{{$restaurant->id}}/menu/">
  <button type="button" class="btn btn-default">Cancel</button>
</a>
@endsection