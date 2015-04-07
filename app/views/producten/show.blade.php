@extends('layout.default')

@section('content')
	
	<script>
		@if (Session::has('warning'))
			alert("{{ Session::get('warning') }}");
		@endif
	</script>
	
	<h1>{{ $product['naam'] }}</h1>

	<ul class="list-group">Product beschrijving:
		<li class="list-group-item">Product naam: {{ $product['naam'] }}</li>
		<li class="list-group-item">Prijs: € {{ $product['prijs'] }}</li>
		<li class="list-group-item">Voorraad: {{ $product['voorraad'] }}</li>
		<li class="list-group-item">Omschrijving: {{ $product['omschrijving'] }}</li>
		<li class="list-group-item">Image: {{ HTML::image('/images/' . $product['thumbnail'], null, array('style' => 'max-width:250px;max-height:250px;')) }}</li>
			<li class="list-group-item">
			{{ Form::open(array('url' => 'cart/add')) }}
				{{ Form::hidden('id', $product['id']) }}
				{{ Form::label('amount', 'Amount') }}
				{{ Form::select('aantal', [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5'])
				}}
				{{ Form::submit('Add to Cart', array('class' => 'btn btn-danger')) }}
			{{ Form::close() }}
		</li>
	</ul>

@stop