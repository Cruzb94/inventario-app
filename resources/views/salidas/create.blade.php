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
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <div id="referencias-container">
                    <div class="form-group row mt-4 referencia-item" data-index="1">
                        <div class="col-sm-12 text-right mr-5">
                            <button type="button" class="btn btn-success" onclick="addReferencia()"><i class="fa-solid fa-plus"></i></button>
                        </div>

                        <div class="col-sm-2 position-relative">
                            {{ Form::label('referencia[]', 'Referencia ', ['class'=>'form-label']) }}
                            {{ Form::select('referencia[]', $productos->pluck('referencia', 'referencia'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione una referencia','onchange' => 'updateDescripcion(this)']) }}
                          
                        </div>
                        <div class="col-sm-2 position-relative">
                            {{ Form::label('descripcion[]', 'Descripcion ', ['class'=>'form-label']) }}
                            {{ Form::text('descripcion[]', null, ['class' => 'form-control', 'readonly' => true]) }}
                        </div>
                        <div class="col-sm-2">
                            {{ Form::label('cantidad[]', 'Cantidad', ['class'=>'form-label']) }}
                            {{ Form::number('cantidad[]', null, ['class' => 'form-control','oninput' => 'calculateTotal(this)']) }}
                        </div>
                        <div class="col-sm-2">
                            {{ Form::label('valor[]', 'Valor', ['class'=>'form-label']) }}
                            {{ Form::number('valor[]', null, ['class' => 'form-control','oninput' => 'calculateTotal(this)']) }}
                        </div>
                        <div class="col-sm-2">
                            {{ Form::label('valortotal[]', 'ValorTotal', ['class'=>'form-label']) }}
                            {{ Form::number('valortotal[]', null, ['class' => 'form-control','readonly' => true]) }}
                        </div>
                        
                    </div>
                </div>

                <div class="form-group row">

                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('valorcantidadtotal', 'Valor de todas las cantidades', ['class'=>'form-label']) }}
                        {{ Form::text('valorcantidadtotal', null, ['class' => 'form-control','readonly' => true]) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('valortodo', 'Valor de todo el total', ['class'=>'form-label']) }}
                        {{ Form::text('valortodo', null, ['class' => 'form-control','readonly' => true]) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
                        {{ Form::date('fecha', null, ['class' => 'form-control', 'id' => 'fecha']) }}
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
                        {{ Form::label('estatus', 'Estatus', ['class'=>'form-label']) }}
                        {{ Form::select('estatus', ['' => 'Seleccione un Estatus', 'Enviado' => 'Enviado', 'Entregados' => 'Entregados', 'Devuelvo al remitente'], null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        {{ Form::submit('Crear', ['class' => 'btn btn-bg-purple']) }} 
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
    div.classList.add('form-group', 'row', 'mt-5', 'referencia-item');

    /*const currentIndex = document.querySelectorAll('.referencia-item').length + 1;

    const hr = document.createElement('hr');
    hr.classList.add('my-4');
    container.appendChild(hr);*/

    div.innerHTML = `
        <div class="d-flex justify-content-between mb-5 ">
            
          
            <button type="button" class="btn btn-danger" onclick="removeReferencia(this)">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>            
        </div>
        <div class="col-sm-2 position-relative">
            {{ Form::label('referencia[]', 'Referencia ', ['class'=>'form-label']) }} 
            {{ Form::select('referencia[]', $productos->pluck('referencia', 'referencia'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione una referencia','onchange' => 'updateDescripcion(this)']) }}
        </div>
        <div class="col-sm-2 position-relative">
            {{ Form::label('descripcion[]', 'Descripcion ', ['class'=>'form-label']) }}
            {{ Form::text('descripcion[]', null, ['class' => 'form-control', 'readonly' => true]) }}
        </div>
        <div class="col-sm-2 ">
            {{ Form::label('cantidad[]', 'Cantidad', ['class'=>'form-label']) }}
            {{ Form::number('cantidad[]', null, ['class' => 'form-control', 'oninput' => 'calculateTotal(this)']) }}
        </div>
        <div class="col-sm-2">
            {{ Form::label('valor[]', 'Valor', ['class'=>'form-label']) }}
            {{ Form::number('valor[]', null, ['class' => 'form-control', 'oninput' => 'calculateTotal(this)']) }}
        </div>
        <div class="col-sm-2">
            {{ Form::label('valortotal[]', 'ValorTotal', ['class'=>'form-label']) }}
            {{ Form::number('valortotal[]', null, ['class' => 'form-control', 'readonly' => true]) }}
         </div>
    `;
    container.appendChild(div);


    
}
function removeReferencia(button) {
    const referenciaItem = button.closest('.referencia-item');
    const hr = referenciaItem.previousElementSibling; // Obtener el hr anterior al grupo de referencia
    referenciaItem.remove();

    updateTotalValue(); // Actualiza el total después de eliminar una referencia
    updateTotalCantidad();

   /* if (hr && hr.classList.contains('my-4')) {
        hr.remove(); // Eliminar el hr si existe y tiene la clase 'my-4'
    }*/
   // updateReferenciaLabels(); // Llama a esta función para actualizar los números de referencia
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

<script>
    function calculateTotal(element) {
    const referenciaItem = element.closest('.referencia-item');
    const cantidad = referenciaItem.querySelector('input[name="cantidad[]"]').value;
    const valor = referenciaItem.querySelector('input[name="valor[]"]').value;
    const totalField = referenciaItem.querySelector('input[name="valortotal[]"]');
    const total = cantidad * valor;
    totalField.value = total ? total.toFixed(2) : 0;
    // Actualizar el valor de "Valor de todo"
    updateTotalValue();
    updateTotalCantidad();
}

function updateTotalValue() {
    const totalFields = document.querySelectorAll('input[name="valortotal[]"]');
    let totalSum = 0;
    
    totalFields.forEach(field => {
        totalSum += parseFloat(field.value) || 0;
    });
    
    const totalTodoField = document.querySelector('input[name="valortodo"]');
    totalTodoField.value = totalSum.toFixed(2);
}
function updateTotalCantidad() {
    const cantidadFields = document.querySelectorAll('input[name="cantidad[]"]');
    let totalCantidad = 0;

    cantidadFields.forEach(field => {
        totalCantidad += parseFloat(field.value) || 0;
    });

    const totalCantidadField = document.querySelector('input[name="valorcantidadtotal"]');
    totalCantidadField.value = totalCantidad.toFixed(2);
}
</script>
<script>
        // Almacena las descripciones de los productos en un objeto
        const productos = @json($productos);

function updateDescripcion(selectElement) {
    // Obtener el valor seleccionado
    const selectedReferencia = selectElement.value;

    // Buscar la descripción correspondiente
    const producto = productos.find(producto => producto.id == selectedReferencia);
    const descripcion = producto ? producto.descripcion : '';

    // Obtener el campo de descripción correspondiente
    const descripcionField = selectElement.closest('.referencia-item').querySelector('input[name="descripcion[]"]');
    descripcionField.value = descripcion;
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
            top: -30px;
            right: 0;
        }

        .referencia-item .btn-success {
            position: absolute;
            top: -30px;
            right: 0;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('estilos/estilos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@stop

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el campo de fecha
        const fechaField = document.getElementById('fecha');
        
        // Obtener la fecha actual
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Los meses van de 0 a 11
        const day = String(today.getDate()).padStart(2, '0');
        
        // Formatear la fecha en YYYY-MM-DD
        const formattedDate = `${year}-${month}-${day}`;
        
        // Establecer el valor del campo de fecha
        fechaField.value = formattedDate;
    });
</script>
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