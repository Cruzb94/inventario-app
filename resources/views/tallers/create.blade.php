@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'tallers.store']) !!}

		<div class="mb-3">
			{{ Form::label('nombre', 'Nombre', ['class'=>'form-label']) }}
			{{ Form::string('nombre', null, array('class' => 'form-control')) }}
		</div>
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
			{{ Form::text('cantidad', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('valor_unidad', 'Valor_unidad', ['class'=>'form-label']) }}
			{{ Form::string('valor_unidad', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('valor_total', 'Valor_total', ['class'=>'form-label']) }}
			{{ Form::string('valor_total', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('observaciones', 'Observaciones', ['class'=>'form-label']) }}
			{{ Form::text('observaciones', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('reprocesos', 'Reprocesos', ['class'=>'form-label']) }}
			{{ Form::text('reprocesos', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop