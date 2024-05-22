@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Editar Ingreso</h1>
    </div>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                    @endforeach
                </div>
                @endif

                {!! Form::model($ingreso, array('route' => array('ingresos.update', $ingreso->id), 'method' => 'PUT')) !!}
                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        {{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
                        {{ Form::date('fecha', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('cuenta_bancolombia', 'Cuenta_bancolombia', ['class'=>'form-label']) }}
                        {{ Form::text('cuenta_bancolombia', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('nequi', 'Nequi', ['class'=>'form-label']) }}
                        {{ Form::text('nequi', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('efectivo', 'Efectivo', ['class'=>'form-label']) }}
                        {{ Form::number('efectivo', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('descripcion', 'Descripcion', ['class'=>'form-label']) }}
                        {{ Form::text('descripcion', null, array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        {{ Form::submit('Actualizar', array('class' => 'btn btn-bg-purple')) }}
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }
    </style>
	 <link rel="stylesheet" href="{{asset('estilos/estilos.css')}}">
@stop
@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@stop