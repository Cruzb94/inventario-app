@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Editar Salida</h1>
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
 
                {!! Form::model($salida, array('route' => array('salidas.update', $salida->id), 'method' => 'PUT')) !!}
                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        {{ Form::label('producto_id', 'Producto', ['class'=>'form-label']) }}
                        {{ Form::select('producto_id', $productos->pluck('descripcion', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione un producto']) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
                        {{ Form::date('fecha', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('cantidad', 'Cantidad', ['class'=>'form-label']) }}
                        {{ Form::number('cantidad', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('guia', 'Guia', ['class'=>'form-label']) }}
                        {{ Form::text('guia', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('valor', 'Valor', ['class'=>'form-label']) }}
                        {{ Form::number('valor', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('estatus', 'Estatus', ['class'=>'form-label']) }}
                        {{ Form::select('estatus', ['' => 'Seleccione un Estatus', 'Enviado' => 'Enviado', 'Entregados' => 'Entregados', 'Devuelvo al remitente' => 'Devuelvo al remitente'], $salida->estatsus, ['class' => 'form-control']) }}
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
