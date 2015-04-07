@extends('layout.cms')

@section('content')
	
	<h1>{{$product->naam}}</h1>

	<ul class="list-group">Product beschrijving:
		<li class="list-group-item">Product naam: {{$product->naam}}</li>
		<li class="list-group-item">Prijs: € {{$product->prijs}}</li>
		<li class="list-group-item">Voorraad: {{$product->voorraad}}</li>
		<li class="list-group-item">Omschrijving: {{$product->omschrijving}}</li>
		<li class="list-group-item">Image: {{ HTML::image('/images/' . $product->thumbnail, null, array('style' => 'max-width:100%')) }}</li>
	</ul>
@stop