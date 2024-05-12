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

{{ Form::model($operario, array('route' => array('operarios.update', $operario->id), 'method' => 'PUT')) }}

<div class="mb-3">
	{{ Form::label('name', 'Name', ['class'=>'form-label']) }}
	{{ Form::text('name', null, array('class' => 'form-control')) }}
</div>

{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop