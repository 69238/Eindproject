@extends('layout.cms')

@section('content')

	<h1>Maak een nieuw product</h1>
		{{ Form::open(['files' => true]) }}

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

		<div class="form-group" style="display: table;width:100%;">
			{{ Form::label('prijs', 'Prijs: ', ['style' => 'display:table-cell'])}}
			{{ Form::text('prijs', null, ['class' => 'form-control', 'style' => 'display: table-cell;'])}}
			{{ Form::label('.', null , ['class' => 'input-group-addon', 'style' => 'display: table-cell;'])}}
			{{ Form::text('comma', 00, ['class' => 'form-control', 'style' => 'display: table-cell;'])}}
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
			{{ Form::submit('Maak Product', ['class' => 'btn btn-primary']) }}
		</div>

		{{ Form::close() }}

@stop
