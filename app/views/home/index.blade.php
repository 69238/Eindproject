@extends('layout.default')

@section('content')
	
	<h2>Welkom op Tv-Me</h2>
	<div class="row">
	@foreach($producten as $prod)
  		<div class="col-xs-6 col-md-3">
    		<div class="thumbnail">
    		<a href='{{ url("/producten/{$prod->id}", null ,null) }}'>
    			<img class="thumb_img" src="{{ asset('/images/' . $prod->thumbnail) }}">
    		</a>
    		{{ link_to("/producten/{$prod->id}", $prod->naam) }}
   			</div>
 		</div>
 	@endforeach
	</div>

@stop