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

<h1>Bestellingen: </h1>

	<table class="table table-hover table-bordered">
		
		<tr>
			<td>Order Nummer</td>
			<td>Order Datum</td>
			<td>Klant naam</td>
			<td>Totaal</td>
			<td>Status</td>
		</tr>

		@foreach($bestellingen as $b_over)

		<tr>
			<td>{{ link_to("users/bestellingen/{$member_id}/{$b_over->id}", $b_over->id) }}</td>
			<td>{{ $b_over->order_date }}</td>
			<td>{{ $users['voornaam'] }} {{ $users['achternaam'] }}</td>
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
		</tr>

		@endforeach

	</table>

@stop