@extends('layout.user')

@section('content')

	@if (Session::has('success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<b>{{ Session::get('success') }}</b>
		</div>
	@endif

	@if (Session::has('warning'))
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<b>{{ Session::get('warning') }}</b>
		</div>
	@endif

	@if (Session::has('danger'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<b>{{ Session::get('danger') }}</b>
		</div>
	@endif

<h1>Bestel overzicht: </h1>

	<table class="table table-hover table-bordered">
		
		<tr>
			<td>Klant naam</td>
			<td>Adres</td>
			<td>Huisnummer</td>
			<td>Toevoegingen</td>
			<td>Postcode</td>
			<td>Product Naam</td>
			<td>Prijs Per Product</td>
			<td>Aantal</td>
			<td>Totaal</td>
			<td>Status</td>
			<td>Transactie ID</td>
		</tr>

		@foreach($bestel_overzicht as $b_over)

		<tr>
			<td>{{ $users['voornaam'] }} {{ $users['achternaam'] }}</td>
			<td>{{ $b_over->naam }}</td>
			<td>{{ $b_over->adres }}</td>
			<td>{{ $b_over->huisnummer }}</td>
			<td>{{ $b_over->toevoegingen }}</td>
			<td>{{ $b_over->postcode }}</td>
			<td>{{ $b_over->prijs }}</td>
			<td>{{ $b_over->aantal }}</td>
			<td>{{ $b_over->total }}</td>
			<td>
				@if($b_over->order_status == 1)
					{{ 'In Cart' }}
				@elseif($b_over->order_status == 2)
					{{ 'Ordered maar niet betaald' }}
				@elseif($b_over->order_status == 3)
					{{ 'Betaald' }}
				@endif

			</td>
			<td>{{ $b_over->trans_id }}</td>
		</tr>

		@endforeach

	</table>

@stop