@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Crear cuenta de banco</h1>
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

                {!! Form::open(['route' => 'productos.store']) !!}
                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        {{ Form::label('name', 'Nombre', ['class'=>'form-label']) }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('nombre_banco', 'Nombre del banco', ['class'=>'form-label']) }}
                        {{ Form::text('nombre_banco', null, array('class' => 'form-control')) }}
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('nro_cuenta', 'Nro_cuenta', ['class'=>'form-label']) }}
                        {{ Form::number('nro_cuenta', null, array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-5">
                        {{ Form::submit('Create', array('class' => 'btn btn-bg-purple')) }}
                    </div>
                </div>

                {!! Form::close() !!}
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
@stop