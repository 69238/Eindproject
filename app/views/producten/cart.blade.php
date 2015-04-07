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

	<h1>Your Cart</h1>

	<table class="table table-hover table-bordered">
		<tr>
			<td>Product Naam:</td>
			<td>Aantal</td>
			<td>Prijs</td>
			<td>Sub-Totaal:</td>
			<td>Delete</td>
		</tr>

		@if(!empty($cart_producten))
			@foreach($cart_producten as $cart_product)
					<tr>
						<input type="hidden" name="prod_id" value="{{ $cart_product->id }}">
						<input type="hidden" name="product_id" value="{{ $cart_product->product_id }}">
						<td>{{ $cart_product->naam }}</td>
						<td>{{ $cart_product->aantal }}</td>
						<td>€ {{ str_replace('.' , ',' , $cart_product->prijs) }}</td>
						<td>€ {{ number_format($cart_product->aantal * $cart_product->prijs, 2 , ',' , '.') }}</td>
						<td>
							{{ Form::open(array('url' => 'cart/destroy')) }}
								{{ Form::hidden('id', $cart_product->id) }}
								{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
							{{ Form::close() }}
						</td>
					</tr>
			@endforeach
		@endif
			<tr>
				<td></td>
				<td></td>
				<td>Totaal:</td>
				<td>€ {{ str_replace('.' , ',' , $cart_total) }}</td>
				<td></td>
			</tr>
	</table>

	<h1>Verzenden</h1>
	{{ Form::open(array('url' => 'cart/order')) }}

		<div class="form-group">
			{{ Form::label('adres', 'Straatnaam: ')}}
			{{ Form::text('adres')}}
			{{ $errors->first('adres') }}
		</div>

		<div class="form-group">
			{{ Form::label('postcode', 'Postcode: ')}}
			{{ Form::text('postcode')}}
			{{ $errors->first('postcode') }}
		</div>

		<div class="form-group">
			{{ Form::label('huisnummer', 'Huisnummer: ')}}
			{{ Form::text('huisnummer')}}
			{{ $errors->first('huisnummer') }}
		</div>

		<div class="form-group">
			{{ Form::label('toevoegingen', 'Toevoegingen: ')}}
			{{ Form::text('toevoegingen')}}
			{{ $errors->first('toevoegingen') }}
		</div>

		{{ Form::submit('Place Order', array('class' => 'btn btn-info')) }}

	{{ Form::close() }}

@stop