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

<ul class="list-group">User Informatie:
	<li class="list-group-item">Titel: @if($users['titel'] == 1) {{ $dhr = 'Dhr'; $dhr }} @else {{  $mvr = 'Mvr'; $mvr }} @endif</li>
	<li class="list-group-item">Voornaam: {{ $users['voornaam'] }}</li>
	<li class="list-group-item">Achternaam: {{ $users['achternaam'] }}</li>
	<li class="list-group-item">Adres: {{ $users['adres'] }}</li>
	<li class="list-group-item">Huisnummer: {{ $users['huisnummer'] }}</li>
	<li class="list-group-item">Toevoegingen: {{ $users['toevoegingen'] }}</li>
	<li class="list-group-item">Postcode: {{ $users['postcode'] }}</li>
	<li class="list-group-item">Telefoon: {{ $users['telefoon'] }}</li>
	<li class="list-group-item">Username: {{ $users['username'] }}</li>
	<li class="list-group-item">E-Mail: {{ $users['email'] }}</li>
</ul>

	<h1>Bewerk profiel:</h1>
	
		{{ Form::open(array('url' => 'users/profile/update')) }}

		{{ Form::hidden('id', $users->id) }}

		<div class="form-group">
			{{ Form::label('geslacht', 'Dhr. ')}}
			{{ Form::radio('geslacht', '1', true) }}
			{{ Form::label('geslacht', 'Mvr. ')}}
			{{ Form::radio('geslacht', '0') }}
			{{ $errors->first('geslacht') }}
		</div>

		<div class="form-group">
			{{ Form::label('voornaam', 'Voornaam: ')}}
			{{ Form::text('voornaam', $users['voornaam'], ['class' => 'form-control'])}}
			{{ $errors->first('voornaam') }}
		</div>

		<div class="form-group">
			{{ Form::label('achternaam', 'Achternaam: ')}}
			{{ Form::text('achternaam', $users['achternaam'], ['class' => 'form-control'])}}
			{{ $errors->first('achternaam') }}
		</div>

		<div class="form-group">
			{{ Form::label('adres', 'Adres: ')}}
			{{ Form::text('adres', $users['adres'], ['class' => 'form-control'])}}
			{{ $errors->first('adres') }}
		</div>

		<div class="form-group">
			{{ Form::label('huisnummer', 'Huisnummer: ')}}
			{{ Form::text('huisnummer', $users['huisnummer'], ['class' => 'form-control'])}}
			{{ $errors->first('huisnummer') }}
		</div>

		<div class="form-group">
			{{ Form::label('toevoegingen', 'Toevoegingen: ')}}
			{{ Form::text('toevoegingen', $users['toevoegingen'], ['class' => 'form-control'])}}
			{{ $errors->first('toevoegingen') }}
		</div>

		<div class="form-group">
			{{ Form::label('postcode', 'Postcode: ')}}
			{{ Form::text('postcode', $users['postcode'], ['class' => 'form-control'])}}
			{{ $errors->first('postcode') }}
		</div>

		<div class="form-group">
			{{ Form::label('telefoon', 'Telefoon: ')}}
			{{ Form::text('telefoon', $users['telefoon'], ['class' => 'form-control'])}}
			{{ $errors->first('telefoon') }}
		</div>

		<div class="form-group">
			{{ Form::label('email', 'E-Mail: ')}}
			{{ Form::text('email', $users['email'], ['class' => 'form-control'])}}
			{{ $errors->first('email') }}
		</div>

		<div class="form-group">
			{{ Form::submit('Update Profiel', ['class' => 'btn btn-primary']) }}
		</div>

		{{ Form::close() }}

@stop