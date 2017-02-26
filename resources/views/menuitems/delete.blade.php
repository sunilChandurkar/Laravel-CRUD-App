@extends('layouts.app')

@section('content')
<h1>Delete Menu Item {{$menuitem->name}}</h1>

<form method="POST" action="/restaurant/{{$restaurant->id}}/menu/{{$menuitem->id}}/delete">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<button type="submit" class="btn btn-default">Delete</button>
</form>
<a href="/restaurant/{{$restaurant->id}}/menu/">
  <button type="button" class="btn btn-default">Cancel</button>
</a>
@endsection