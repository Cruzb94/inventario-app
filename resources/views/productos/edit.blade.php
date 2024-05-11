@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($producto, array('route' => array('productos.update', $producto->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('referencia', 'Referencia', ['class'=>'form-label']) }}
			{{ Form::text('referencia', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('descripcion', 'Descripcion', ['class'=>'form-label']) }}
			{{ Form::text('descripcion', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('entrada', 'Entrada', ['class'=>'form-label']) }}
			{{ Form::text('entrada', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('salida', 'Salida', ['class'=>'form-label']) }}
			{{ Form::text('salida', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('stock', 'Stock', ['class'=>'form-label']) }}
			{{ Form::text('stock', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
