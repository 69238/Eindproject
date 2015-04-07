@extends('layout.default')

@section('content')

		{{ Form::open() }}

			<div>
				{{ Form::label('username', 'Username: ')}}
				{{ Form::text('username')}}
			</div>

			<div>{{ Form::submit('Login') }}</div>

		{{ Form::close() }}

@stop