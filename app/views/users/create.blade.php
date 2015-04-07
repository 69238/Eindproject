@extends('layout.default')

@section('content')

	<h1>Registreer</h1>
		{{ Form::open() }}

		<div class="form-group">
			{{ Form::label('geslacht', 'Dhr. ')}}
			{{ Form::radio('geslacht', '1', true) }}
			{{ Form::label('geslacht', 'Mvr. ')}}
			{{ Form::radio('geslacht', '0') }}
			{{ $errors->first('geslacht') }}
		</div>

		<div class="form-group">
			{{ Form::label('voornaam', 'Voornaam: ')}}
			{{ Form::text('voornaam')}}
			{{ $errors->first('voornaam') }}
		</div>

		<div class="form-group">
			{{ Form::label('achternaam', 'Achternaam: ')}}
			{{ Form::text('achternaam')}}
			{{ $errors->first('achternaam') }}
		</div>

		<div class="form-group">
			{{ Form::label('adres', 'Straatnaam: ')}}
			{{ Form::text('adres')}}
			{{ $errors->first('adres') }}
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

		<div class="form-group">
			{{ Form::label('postcode', 'Postcode: ')}}
			{{ Form::text('postcode')}}
			{{ $errors->first('postcode') }}
		</div>

		<div class="form-group">
			{{ Form::label('telefoon', 'Telefoonnummer: ')}}
			{{ Form::text('telefoon')}}
			{{ $errors->first('telefoon') }}
		</div>

		<div class="form-group">
			{{ Form::label('username', 'Username: ')}}
			{{ Form::text('username')}}
			{{ $errors->first('username') }}
		</div>

		<div class="form-group">
			{{ Form::label('password', 'Password: ')}}
			{{ Form::password('password')}}
			{{ $errors->first('password') }}
		</div>

		<div class="form-group">
			{{ Form::label('email', 'E-Mail Adres: ')}}
			{{ Form::text('email')}}
			{{ $errors->first('email') }}
		</div>

		<div class="form-group">{{ Form::submit('Registreer', ['class' => 'btn btn-primary']) }}</div>

		{{ Form::close() }}

@stop
