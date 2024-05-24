@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Crear salida</h1>
    </div>
@stop

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
</div>
@endif

{!! Form::open(['route' => 'salidas.store']) !!}

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">

                <div id="referencias-container">
                    <div class="form-group row mt-4 referencia-item" data-index="1">
                        <div class="col-sm-10 position-relative">
                            {{ Form::label('referencia[]', 'Referencia ', ['class'=>'form-label']) }}
                            {{ Form::select('referencia[]', $productos->pluck('referencia', 'referencia'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione una referencia']) }}
                        </div>
                        <div class="col-sm-10 mt-2">
                            {{ Form::label('cantidad[]', 'Cantidad', ['class'=>'form-label']) }}
                            {{ Form::number('cantidad[]', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>

                <div class="form-group row">

                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
                        {{ Form::date('fecha', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('guia', 'Guia', ['class'=>'form-label']) }}
                        {{ Form::text('guia', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('valor', 'Valor', ['class'=>'form-label']) }}
                        {{ Form::number('valor', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('estatus', 'Estatus', ['class'=>'form-label']) }}
                        {{ Form::select('estatus', ['' => 'Seleccione un Estatus', 'Enviado' => 'Enviado', 'Entregados' => 'Entregados', 'Devuelvo al remitente'], null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-5">
                        {{ Form::submit('Create', ['class' => 'btn btn-bg-purple']) }} 
                    </div>
                    <div class="col-sm-5 text-right">
                        <button type="button" class="btn btn-success" onclick="addReferencia()">Agregar Referencia</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{ Form::close() }}

<script>
    let referenciaIndex = 1;
    function addReferencia() {
    const container = document.getElementById('referencias-container');
    const div = document.createElement('div');
    div.classList.add('form-group', 'row', 'mt-2', 'referencia-item');

    const currentIndex = document.querySelectorAll('.referencia-item').length + 1;

    const hr = document.createElement('hr');
    hr.classList.add('my-4');
    container.appendChild(hr);

    div.innerHTML = `
        <div class="d-flex justify-content-between mb-5">
            
            <h3>Referencia ${currentIndex}</h3>
            <button type="button" class="btn btn-danger" onclick="removeReferencia(this)">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>            
        </div>
        <div class="col-sm-10 position-relative">
            {{ Form::label('referencia[]', 'Referencia ', ['class'=>'form-label']) }} 
            {{ Form::select('referencia[]', $productos->pluck('referencia', 'referencia'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione una referencia']) }}
        </div>
        <div class="col-sm-10 mt-2">
            {{ Form::label('cantidad[]', 'Cantidad', ['class'=>'form-label']) }}
            {{ Form::number('cantidad[]', null, ['class' => 'form-control']) }}
        </div>
    `;
    container.appendChild(div);


    
}
function removeReferencia(button) {
    const referenciaItem = button.closest('.referencia-item');
    const hr = referenciaItem.previousElementSibling; // Obtener el hr anterior al grupo de referencia
    referenciaItem.remove();
    if (hr && hr.classList.contains('my-4')) {
        hr.remove(); // Eliminar el hr si existe y tiene la clase 'my-4'
    }
    updateReferenciaLabels(); // Llama a esta función para actualizar los números de referencia
}

function updateReferenciaLabels() {
    const items = document.querySelectorAll('.referencia-item');
    let currentIndex = 2;
    items.forEach((item) => {
        const h3 = item.querySelector('h3');
        if (h3) {
            h3.textContent = `Referencia ${currentIndex}`;
            currentIndex++;
        }
    });
}

</script>



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
        .my-4 {
            border-top: 2px solid black; /* Cambia el grosor y color de la línea */
            margin-top: 20px; /* Ajusta el espacio encima de la línea */
            margin-bottom: 20px; /* Ajusta el espacio debajo de la línea */
        }
    </style>
    <link rel="stylesheet" href="{{ asset('estilos/estilos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@stop

@section('js')


@if (session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '{{ session('error') }}',
});
</script>
@endif

@stop