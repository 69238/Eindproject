@extends('layout.default')

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

	<h1>Betaling succesvol:</h1>

	<div class="form-group">
		<p>Beste klant,</p>

		<p>Bedankt voor het aanschaffen van de volgende producten op onze website.
		We hopen je snel terug te zien!</p>
	</div>

	@foreach($bestellingen as $b_over)

		<table class="table table-hover table-bordered">
			<tr style="background: #A7A7A7;font-color:#fff;">
				<td>Product</td>
				<td>Aantal</td>
				<td>Prijs</td>
				<td>Subtotaal</td>
			</tr>

			<tr>
				<td>{{ $b_over->naam }}</td>
				<td>{{ $b_over->aantal }}</td>
				<td>{{ $b_over->prijs }}</td>
				<td>{{ $b_over->total }}</td>
			</tr>
		</table>
	@endforeach

	@foreach($bestelling_adres as $adres)
		<table class="table table-hover table-bordered">
			<tr style="background: #A7A7A7;font-color:#fff;">
				<td>Verzendadres</td>
				<td>Huisnummer</td>
				<td>Toevoegingen</td>
				<td>Postcode</td>
			</tr>

			<tr>
				<td>{{ $adres->adres }}</td>
				<td>{{ $adres->postcode }}</td>
				<td>{{ $adres->huisnummer }}</td>
				<td>{{ $adres->toevoegingen }}</td>
			</tr>
		</table>
	@endforeach

@stop