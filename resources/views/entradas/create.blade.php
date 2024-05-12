@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
@if($errors->any())
<div class="alert alert-danger">
	@foreach ($errors->all() as $error)
		{{ $error }} <br>
	@endforeach
</div>
@endif

{!! Form::open(['route' => 'entradas.store']) !!}

<div class="mb-3">
	{{ Form::label('product_id', 'Product_id', ['class'=>'form-label']) }}
	{{ Form::text('product_id', null, array('class' => 'form-control')) }}
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
	{{ Form::label('operario_id', 'Operario_id', ['class'=>'form-label']) }}
	{{ Form::text('operario_id', null, array('class' => 'form-control')) }}
</div>
<div class="mb-3">
	{{ Form::label('reproceso', 'Reproceso', ['class'=>'form-label']) }}
	{{ Form::text('reproceso', null, array('class' => 'form-control')) }}
</div>


{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop