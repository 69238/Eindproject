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

	<h1>Betaling niet succesvol:</h1>

	<div class="form-group">
		<p>Beste klant,</p>

		<p>De betaling is niet succesvol verlopen, dit komt omdat u op Nee heeft gedrukt tijdens de betaling. Probeer het alstublieft opnieuw.</p>
	</div>

@stop