@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Editar entrada</h1>
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

                {!! Form::model($entrada, ['route' => ['entradas.update', $entrada->id], 'method' => 'PUT']) !!}


                
                <div class="form-group row mt-4 referencia-item">
                    <div class="col-sm-12 text-right mr-5">
                    <!--   <button type="button" class="btn btn-success" onclick="addReferencia()"><i class="fa-solid fa-plus"></i></button> -->
                    </div>
                    <div class="col-sm-5">
                        {{ Form::label('product_id', 'Referencia', ['class'=>'form-label']) }}
                        {{ Form::select('product_id', $productos->pluck('referencia', 'id'), $entrada->producto_id, ['class' => 'form-control', 'placeholder' => 'Seleccione una referencia']) }}
                    </div>

                
                    <div class="col-sm-5">
                        {{ Form::label('cantidad', 'Cantidad', ['class'=>'form-label']) }}
                        {{ Form::number('cantidad', null, ['class' => 'form-control', 'oninput' => 'calculateTotal(this)']) }}
                        {{ Form::hidden('cantidad_original', null, ['id' => 'cantidad_original']) }}
                    </div>
                </div>
          
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
                        {{ Form::date('fecha', null, ['class' => 'form-control']) }}
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('operario_id', 'Operario', ['class'=>'form-label']) }}
                        {{ Form::select('operario_id', $operarios->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione un operario']) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('reproceso', 'Reproceso', ['class'=>'form-label']) }}
                        {{ Form::number('reproceso', null, ['class' => 'form-control', 'oninput' => 'calculateTotal(this)' ]) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-5">
                        {{ Form::submit('Actualizar', ['class' => 'btn btn-bg-purple']) }}
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

        .btn-bg-purple {
            background-color: purple;
            color: white;
        }

        .referencia-item {
            position: relative;
            margin-bottom: 20px;
        }

        .referencia-item .btn-danger {
            position: absolute;
            top: 0;
            right: 0;
        }
        .referencia-item .btn-success {
            position: absolute;
            top: -30px;
            right: 0;
        }

    </style>
	<link rel="stylesheet" href="{{ asset('estilos/estilos.css') }}">
@stop

@section('js')


<script>
function calculateTotal(element) {
    const parentContainer = element.closest('.card-body'); // Buscamos el contenedor más cercano con la clase .card-body
    if (!parentContainer) {
        console.error('Parent container not found.');
        return;
    }

    const cantidadInput = parentContainer.querySelector('input[name="cantidad"]');
    const cantidad = parseInt(cantidadInput.value || 0);

    const reprocesoInput = parentContainer.querySelector('input[name="reproceso"]');
    const reproceso = parseInt(reprocesoInput.value || 0);

    if (reproceso > cantidad) {
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: `El reproceso (${reproceso}) no puede ser mayor que la cantidad (${cantidad}).`
        });
        reprocesoInput.value = '';
        return;
    }
}
    </script>

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@stop
