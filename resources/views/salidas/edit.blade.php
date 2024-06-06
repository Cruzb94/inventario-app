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
                
                <div id="referencias-container">
                    @php
                        $referencias = json_decode($salida->referencia, true);
                       // dd($referencias);
                    @endphp
               @if($referencias)
               @for($i = 0; $i < count($referencias[0]); $i++)
                   <div class="refern2" data-index="{{ $i + 1 }}">
                       @if($i > 0)
                       <div class="col-sm-12 text-right mr-5">
                        <button type="button" class="btn btn-success" onclick="addReferencia()"><i class="fa-solid fa-plus"></i></button>
                    </div>
                       @endif
                       <div class="col-sm-2 position-relative">
                           {{ Form::label('referencia[]', 'Referencia ', ['class'=>'form-label']) }}
                           {{ Form::select('referencia[]', $productos->pluck('referencia', 'referencia'), $referencias[0][$i], ['class' => 'form-control', 'placeholder' => 'Seleccione una referencia']) }}
                       </div>

                       <div class="col-sm-2 position-relative">
                           {{ Form::label('descripcion[]', 'Descripcion', ['class'=>'form-label']) }}
                           {{ Form::text('descripcion[]', $referencias[1][$i], ['class' => 'form-control']) }}
                          
                       </div>

                       <div class="col-sm-2 position-relative">

                           {{ Form::label('cantidad[]', 'Cantidad', ['class'=>'form-label']) }}
                           {{ Form::number('cantidad[]', $referencias[2][$i], ['class' => 'form-control']) }}
                           {{ Form::hidden('cantidad_original[]', $referencias[2][$i]) }}
                       </div>

                       <div class="col-sm-2 position-relative">
                           {{ Form::label('valor[]', 'Valor', ['class'=>'form-label']) }}
                           {{ Form::number('valor[]', $referencias[3][$i], ['class' => 'form-control']) }}
                       </div>

                       <div class="col-sm-2 position-relative">
                           {{ Form::label('valortotal[]', 'valortotal', ['class'=>'form-label']) }}
                           {{ Form::number('valortotal[]', $referencias[4][$i], ['class' => 'form-control']) }}
                       </div>
                   </div>
               @endfor
           @endif
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
                        {{ Form::date('fecha', null, array('class' => 'form-control')) }}
                    </div>
                </div>



                <div class="form-group row mt-4">
                    <div class="col-sm-5">
                        {{ Form::submit('Actualizar', array('class' => 'btn btn-bg-purple')) }}
                    </div>
                    <div class="col-sm-5 text-right">
                        <button type="button" class="btn btn-success" onclick="addReferencia()">Agregar Referencia</button>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<script>
    let referenciaIndex = {{ isset($referencias) ? count($referencias[0]) : 0 }};
    
    function addReferencia() {
        const container = document.getElementById('referencias-container');
        const div = document.createElement('div');
        div.classList.add('form-group', 'row', 'mt-2', 'referencia-item');
        
        referenciaIndex++;
        const currentIndex = referenciaIndex;

        const hr = document.createElement('hr');
        hr.classList.add('my-4');
        container.appendChild(hr);

        div.innerHTML = `
            <div class="d-flex justify-content-between mb-2">
                <h3 class="flex-grow-1">Referencia ${currentIndex}</h3>
                
                <button type="button" class="btn btn-danger ml-2" onclick="removeReferencia(this)">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
            </div>
            <div class="col-sm-10 position-relative">
                <label for="referencia_${currentIndex}" class="form-label">Referencia</label>
                <select name="referencia[]" id="referencia_${currentIndex}" class="form-control">
                    <option value="">Seleccione una referencia</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->referencia }}">{{ $producto->referencia }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-10 mt-2">
                <label for="cantidad_${currentIndex}" class="form-label">Cantidad</label>
                <input type="number" name="cantidad[]" id="cantidad_${currentIndex}" class="form-control" />
            </div>
        `;
        container.appendChild(div);
    }

    function removeReferencia(button) {
        const referenciaItem = button.closest('.referencia-item, .refern2');
        const hr = referenciaItem.previousElementSibling; // Obtener el hr anterior al grupo de referencia
        referenciaItem.remove();
        if (hr && hr.classList.contains('my-4')) {
            hr.remove(); // Eliminar el hr si existe y tiene la clase 'my-4'
        }
        updateReferenciaLabels(); // Llama a esta función para actualizar los números de referencia
    }

    function updateReferenciaLabels() {
        const items = document.querySelectorAll('.referencia-item, .refern2');
        let currentIndex = 2;
        items.forEach((item, index) => {
            if (index > 0) { // Para no cambiar la primera referencia
                const h3 = item.querySelector('h3');
                if (h3) {
                    h3.textContent = `Referencia ${currentIndex}`;
                    currentIndex++;
                }
            }
        });
        referenciaIndex = currentIndex - 1;
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
            border-top: 2px solid black;
            margin-top: 20px;
            margin-bottom: 20px;
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
