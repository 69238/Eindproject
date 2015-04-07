@extends('layout.user')

@section('content')
	{{ 'Welkom op de User overzichtspagina, ' . Auth::user()->username }}
@stop