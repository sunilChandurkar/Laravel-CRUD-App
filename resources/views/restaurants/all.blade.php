@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<p>All Restaurants</p>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
    @if (Session::has('message'))
        <li>{!! session('message') !!}</li>
   @endif
    </div>
    <div class="col-sm-8">
    </div>
</div>
@foreach($restaurants as $restaurant)
	<div class="row">
		<div class="col-sm-12">
			<a href="/restaurant/{{$restaurant->id}}/menu/">{{$restaurant->name}}</a>
			
		</div>
	</div>
@endforeach

<div class="row">
	<div class="col-sm-12">
		<a href="/restaurant/new/">Add a Restaurant</a>
	</div>
</div>

@endsection