@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'cuentabancos.store']) !!}

		<div class="mb-3">
			{{ Form::label('name', 'Name', ['class'=>'form-label']) }}
			{{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('nombre_banco', 'Nombre_banco', ['class'=>'form-label']) }}
			{{ Form::text('nombre_banco', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('nro_cuenta', 'Nro_cuenta', ['class'=>'form-label']) }}
			{{ Form::text('nro_cuenta', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop