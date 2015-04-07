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

	<h1>Betaal Overzicht:</h1>

		{{ Form::open() }}

			<div class="form-group">
				<select id="banken" name="banken" class="form-control">
				@foreach($jsonData as $key => $banklist)
					<option name="bank" id="{{ $key }}" value="{{ $key }}">{{ $banklist }}</option>
				@endforeach
				</select>
			</div>

		<div class="form-group">{{ Form::submit('Betaal', ['class' => 'btn btn-primary', 'style' => 'width: 100%;']) }}</div>

		{{ Form::close() }}

		
@stop