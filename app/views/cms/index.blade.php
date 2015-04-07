@extends('layout.cms')

@section('content')
	{{ 'Welkom op de Admin pagina, ' . Auth::user()->username }}
@stop