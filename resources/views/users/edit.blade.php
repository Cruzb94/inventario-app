@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Editar Usuario</h1>
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

                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        {{ Form::label('name', 'Nombre', ['class'=>'form-label']) }}
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('email', 'Correo Electronico', ['class'=>'form-label']) }}
                        {{ Form::email('email', null, array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        {{ Form::label('role', 'Rol', ['class'=>'form-label']) }}
                        {{ Form::select('role', ['admin' => 'Admin', 'user' => 'User'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un rol']) }}
                    </div>
                </div>
            

                <div class="form-group row mt-5">
                    <div class="col-sm-10">
                        {{ Form::submit('Actualizar', ['class' => 'btn btn-primary']) }}
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
