@extends('layout.cms')

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

	<div>Product Namen:</div><br>
	
	<table class="table table-hover table-bordered">
		@foreach($producten as $prod)
			@if(!$prod->deleted == '1')
				<tr>
					<td>
						{{ link_to("/cms/{$prod->id}", $prod->naam) }}
					</td>
					<td>
						{{ Form::open(array('url' => 'producten/destroy')) }}
							{{ Form::hidden('id', $prod->id) }}
							{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
						{{ Form::close() }}
					</td>
					<td>
						{{ link_to("/producten/{$prod->id}/edit", 'Update', array('class' => 'btn btn-danger')) }}
					</td>
				</tr>
			@endif
		@endforeach
	</table>


@stop