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
                    <div class="col-sm-6">
                        {{ Form::submit('Crear', ['class' => 'btn btn-bg-purple']) }} 
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

{{ Form::close() }}

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
    let referenciaIndex = 1;
    function addReferencia() {
    const container = document.getElementById('referencias-container');
    const div = document.createElement('div');
    div.classList.add('form-group', 'row', 'mt-5', 'referencia-item');


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

    // Obtener el select de referencia
    const referenciaSelect = referenciaItem.querySelector('select[name="referencia[]"]');
    // Obtener el valor seleccionado actualmente
    const selectedReferencia = referenciaSelect.value;
    // Eliminar la referencia seleccionada del registro
    const index = referenciasSeleccionadas.indexOf(selectedReferencia);
    if (index !== -1) {
        referenciasSeleccionadas.splice(index, 1);
    }


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
    const cantidadInput = referenciaItem.querySelector('input[name="cantidad[]"]'); 
    const cantidad = referenciaItem.querySelector('input[name="cantidad[]"]').value;
    const valor = referenciaItem.querySelector('input[name="valor[]"]').value;
    const totalField = referenciaItem.querySelector('input[name="valortotal[]"]');
    const total = cantidad * valor;

    // Obtener el valor seleccionado de la referencia
    const referenciaSelect = referenciaItem.querySelector('select[name="referencia[]"]');
    const selectedReferencia = referenciaSelect.value;

    // Obtener el producto correspondiente
    const producto = productos.find(producto => producto.id == selectedReferencia);
    const stock = producto ? producto.stock : 0;

    // Verificar si la cantidad supera el stock
    if (parseInt(cantidad) > stock) {
        // Mostrar alerta
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: `La cantidad que deseas despachar (${cantidad}) es mayor que la disponible en stock (${stock}) para este producto.`
        })        // Limpiar el valor de cantidad
        cantidadInput.value = '';
        // Salir de la función
        return;
    }


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

// Registro de referencias seleccionadas
let referenciasSeleccionadas = [];

function updateDescripcion(selectElement) {
    // Obtener el valor seleccionado
    const selectedReferencia = selectElement.value;

    // Verificar si el valor seleccionado ya está en uso

    if (referenciasSeleccionadas.includes(selectedReferencia)) {
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: `La referencia ${selectedReferencia} ya ha sido seleccionada.`
        }) 

const previousSelected = selectElement.dataset.selected;
//console.log(previousSelected);
if (previousSelected && previousSelected !== selectedReferencia) {

    //console.log('estoy locococo');
    // Eliminar la selección anterior si ya no está presente
    const index = referenciasSeleccionadas.indexOf(previousSelected);
    if (index !== -1) {
        referenciasSeleccionadas.splice(index, 1);
    }
}
// Limpiar el campo después de verificar
selectElement.value = ''; 
const descripcionField = selectElement.closest('.referencia-item').querySelector('input[name="descripcion[]"]');
descripcionField.value = ''; // Limpiar el campo de descripción
return; 
}



    // Buscar la descripción correspondiente
    const producto = productos.find(producto => producto.id == selectedReferencia);
    const descripcion = producto ? producto.descripcion : '';

        // Eliminar la referencia seleccionada anteriormente que ya no se está utilizando
        const index = referenciasSeleccionadas.indexOf(selectElement.dataset.selected);
    if (index !== -1) {
        referenciasSeleccionadas.splice(index, 1);
    }

    // Agregar el valor seleccionado al registro
    referenciasSeleccionadas.push(selectedReferencia)
    console.log(referenciasSeleccionadas);

    // Obtener el campo de descripción correspondiente
    const descripcionField = selectElement.closest('.referencia-item').querySelector('input[name="descripcion[]"]');
    descripcionField.value = descripcion;

        // Actualizar el atributo "data-selected" con la nueva referencia seleccionada
        selectElement.dataset.selected = selectedReferencia;
}
</script>
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