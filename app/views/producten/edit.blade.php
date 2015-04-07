@extends('layout.cms')

@section('content')

	<h1>Bewerk product:</h1>
		{{ Form::model($product, ['files' => true]) }}

		<div class="form-group">
			{{ Form::label('naam', 'Product naam: ')}}
			{{ Form::text('naam', null, ['class' => 'form-control'])}}
			{{ $errors->first('naam') }}
		</div>

		<div class="form-group">
			{{ Form::label('omschrijving', 'Omschrijving: ')}}
			{{ Form::textarea('omschrijving', null, ['class' => 'form-control'])}}
			{{ $errors->first('omschrijving') }}
		</div>

		<div class="form-group">
			{{ Form::label('prijs', 'Prijs: ')}}
			{{ Form::text('prijs', null, ['class' => 'form-control'])}}
			{{ $errors->first('prijs') }}
		</div>

		<div class="form-group">
			{{ Form::label('voorraad', 'Voorraad: ')}}
			{{ Form::text('voorraad', null, ['class' => 'form-control'])}}
			{{ $errors->first('voorraad') }}
		</div>

		<div class="form-group">
			{{ Form::label('thumbnail', 'Thumbnail: ')}}
			{{ Form::file('thumbnail')}}
			{{ $errors->first('thumbnail') }}
		</div>

		<div class="form-group">
			{{ Form::submit('Update Product', ['class' => 'btn btn-primary']) }}
		</div>

		{{ Form::close() }}

@stop