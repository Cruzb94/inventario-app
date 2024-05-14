@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($ingreso, array('route' => array('ingresos.update', $ingreso->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
			{{ Form::string('fecha', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('cuenta_bancolombia', 'Cuenta_bancolombia', ['class'=>'form-label']) }}
			{{ Form::text('cuenta_bancolombia', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('nequi', 'Nequi', ['class'=>'form-label']) }}
			{{ Form::text('nequi', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('efectivo', 'Efectivo', ['class'=>'form-label']) }}
			{{ Form::string('efectivo', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('descripcion', 'Descripcion', ['class'=>'form-label']) }}
			{{ Form::text('descripcion', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
