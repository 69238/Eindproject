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

	{{ Form::open() }}

		<div class="form-group">
			{{ Form::label('username', 'Username: ')}}
			{{ Form::text('username')}}
		</div>

		<div class="form-group">
			{{ Form::label('password', 'Password: ')}}
			{{ Form::password('password')}}
		</div>

		<div class="form-group">{{ Form::submit('Login', ['class' => 'btn btn-primary']) }}</div>

	{{ Form::close() }}

@stop