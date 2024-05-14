@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($salida, array('route' => array('salidas.update', $salida->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('referencia', 'Referencia', ['class'=>'form-label']) }}
			{{ Form::text('referencia', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('descripcion', 'Descripcion', ['class'=>'form-label']) }}
			{{ Form::text('descripcion', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
			{{ Form::string('fecha', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('cantidad', 'Cantidad', ['class'=>'form-label']) }}
			{{ Form::string('cantidad', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('guia', 'Guia', ['class'=>'form-label']) }}
			{{ Form::string('guia', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('valor', 'Valor', ['class'=>'form-label']) }}
			{{ Form::string('valor', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('estatus', 'Estatus', ['class'=>'form-label']) }}
			{{ Form::string('estatus', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
