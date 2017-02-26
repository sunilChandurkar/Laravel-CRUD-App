@extends('layouts.app')

@section('content')
<h2>{{$restaurant->name}}</h2>

<a href="/restaurant/{{$restaurant->id}}/edit/">
	<button type="button" class="btn btn-default">Edit Restaurant</button>	
</a>
<a href="/restaurant/{{$restaurant->id}}/menu/new/">
	<button type="button" class="btn btn-default">Add Menu Item</button>	
</a>
<a href="/restaurant/{{$restaurant->id}}/delete/">
	<button type="button" class="btn btn-default">Delete Restaurant</button>	
</a>
<div class="row">
	<div class="col-sm-4">
    @if (Session::has('message'))
        <li>{!! session('message') !!}</li>
   @endif
    </div>
    <div class="col-sm-8">
    </div>
</div>

<div class="row">
	<div class="col-sm-4">
		<h4>Appetizers</h4>
		@foreach($appetizers as $appetizer)
			{{$appetizer->name}} ${{$appetizer->price}}
			<br>
			{{$appetizer->description}}
			<br>
			<a href="/restaurant/{{$restaurant->id}}/menu/{{$appetizer->id}}/edit">Edit</a>  <a href="/restaurant/{{$restaurant->id}}/menu/{{$appetizer->id}}/delete">Delete</a>
			<br>
		@endforeach
	</div>
	<div class="col-sm-4">
		<h4>Entrees</h4>
		@foreach($entrees as $entree)
			{{$entree->name}} ${{$entree->price}}
			<br>
			{{$entree->description}}
			<br>
			<a href="/restaurant/{{$restaurant->id}}/menu/{{$entree->id}}/edit">Edit</a>  <a href="/restaurant/{{$restaurant->id}}/menu/{{$entree->id}}/delete">Delete</a>
			<br>
		@endforeach
	</div>
	<div class="col-sm-4">
		<h4>Desserts</h4>
		@foreach($desserts as $dessert)
			{{$dessert->name}} ${{$dessert->price}}
			<br>
			{{$dessert->description}}
			<br>
			<a href="/restaurant/{{$restaurant->id}}/menu/{{$dessert->id}}/edit">Edit</a>  <a href="/restaurant/{{$restaurant->id}}/menu/{{$dessert->id}}/delete">Delete</a>
			<br>
		@endforeach
	</div>
</div>
@endsection