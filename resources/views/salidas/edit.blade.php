@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Editar Salida</h1>
    </div>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
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

                <div id="referencias-container" class="container">
                    @php
                        $referencias = json_decode($salida->referencia, true);
                    @endphp
                    @if($referencias)
                        @for($i = 0; $i < count($referencias[0]); $i++)
                            <div class="form-group row mt-4 referencia-item" data-index="{{ $i + 1 }}">
                                <div class="col-sm-12 text-right mr-5">
                                    @if($i === 0)
                                        <button type="button" class="btn btn-success" onclick="addReferencia()">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-danger" onclick="removeReferencia(this)">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </button>
                                    @endif
                                </div>
                                <div class="col-sm-2 position-relative">
                                    {{ Form::label('referencia[]', 'Referencia', ['class' => 'form-label']) }}
                                    {{ Form::select('referencia[]', $productos->pluck('referencia', 'referencia'), $referencias[0][$i], ['class' => 'form-control loco', 'placeholder' => 'Seleccione una referencia','onchange' => 'updateDescripcion(this)']) }}
                                </div>
                                <div class="col-sm-2 position-relative">
                                    {{ Form::label('descripcion[]', 'Descripcion', ['class' => 'form-label']) }}
                                    {{ Form::text('descripcion[]', $referencias[1][$i], ['class' => 'form-control', 'readonly' => true]) }}
                                </div>
                                <div class="col-sm-2 position-relative">
                                    {{ Form::label('cantidad[]', 'Cantidad', ['class' => 'form-label']) }}
                                    {{ Form::number('cantidad[]', $referencias[2][$i], ['class' => 'form-control','oninput' => 'calculateTotal(this)']) }}
                                    {{ Form::hidden('cantidad_original[]', $referencias[2][$i]) }}
                                </div>
                                <div class="col-sm-2 position-relative">
                                    {{ Form::label('valor[]', 'Valor', ['class' => 'form-label']) }}
                                    {{ Form::number('valor[]', $referencias[3][$i], ['class' => 'form-control','oninput' => 'calculateTotal(this)']) }}
                                </div>
                                <div class="col-sm-2 position-relative">
                                    {{ Form::label('valortotal[]', 'Valor Total', ['class' => 'form-label']) }}
                                    {{ Form::number('valortotal[]', $referencias[4][$i], ['class' => 'form-control', 'readonly' => true]) }}
                                </div>

                                
                            </div>
                            
                            
                        @endfor
                    @endif
                </div>
                    <div class="form-group row ">
                        <div class="col-sm-10">
                            {{ Form::label('valorcantidadtotal', 'Valor de todas las cantidades', ['class'=>'form-label']) }}
                            {{ Form::number('valorcantidadtotal', $salida->valorcantidades, ['class' => 'form-control','readonly' => true]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            {{ Form::label('valortodo', 'Valor de todo el total', ['class'=>'form-label']) }}
                            {{ Form::number('valortodo', $salida->valortotal, ['class' => 'form-control','readonly' => true]) }}
                        </div>
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
                </div>

              
            
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
<script>
     let referenciaIndex = {{ isset($referencias) ? count($referencias[0]) : 0 }};
    
    function addReferencia() {
        const container = document.getElementById('referencias-container');
        const div = document.createElement('div');
        div.classList.add('form-group', 'row', 'mt-4', 'referencia-item');
        
        referenciaIndex++;
        const currentIndex = referenciaIndex;

        div.innerHTML = `
            <div class="col-sm-12 text-right mr-5">
                <button type="button" class="btn btn-danger" onclick="removeReferencia(this)">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
            </div>
            <div class="col-sm-2 position-relative">
                {{ Form::label('referencia[]', 'Referencia', ['class' => 'form-label']) }}
                {{ Form::select('referencia[]', $productos->pluck('referencia', 'referencia'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione una referencia','onchange' => 'updateDescripcion(this)']) }}
            </div>
            <div class="col-sm-2 position-relative">
                {{ Form::label('descripcion[]', 'Descripcion', ['class' => 'form-label']) }}
                {{ Form::text('descripcion[]', null, ['class' => 'form-control', 'readonly' => true]) }}
            </div>
            <div class="col-sm-2 position-relative">
                {{ Form::label('cantidad[]', 'Cantidad', ['class' => 'form-label']) }}
                {{ Form::number('cantidad[]', null, ['class' => 'form-control','oninput' => 'calculateTotal(this)']) }}
                {{ Form::hidden('cantidad_original[]', null) }}
            </div>
            <div class="col-sm-2 position-relative">
                {{ Form::label('valor[]', 'Valor', ['class' => 'form-label']) }}
                {{ Form::number('valor[]', null, ['class' => 'form-control','oninput' => 'calculateTotal(this)']) }}
            </div>
            <div class="col-sm-2 position-relative">
                {{ Form::label('valortotal[]', 'Valor Total', ['class' => 'form-label']) }}
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
        console.log(referenciasSeleccionadas);
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
    document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los elementos select
    const selects = document.querySelectorAll('select[name="referencia[]"]');

    // Iterar sobre cada select y establecer el atributo data-selected
    selects.forEach(select => {
        select.dataset.selected = select.value;
        //console.log(select.dataset.selected);
    });
});

    // Registro de referencias seleccionadas
    let referenciasSeleccionadas = Array.from(document.querySelectorAll('select[name="referencia[]"]')).map(select => select.value);
   // console.log(referenciasSeleccionadas);
    function updateDescripcion(selectElement) {
    // Obtener el valor seleccionado
    const selectedReferencia = selectElement.value;

    // Verificar si es la primera llamada y asignar el valor correspondiente a previousSelected
    const previousSelected = selectElement.dataset.selected;

    console.log(previousSelected);

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
        console.log(index);
        if (index !== -1) {
    if (selectElement.classList.contains('loco')) {
        // Verificar si se cambió alguno de los campos predeterminados
        if (previousSelected && previousSelected !== selectedReferencia) {
            referenciasSeleccionadas.splice(index, 1);
           /* console.log('llegue aqui');
            console.log(referenciasSeleccionadas);*/
        }
    } else {
        referenciasSeleccionadas.splice(index, 1);
        //console.log('llegue aqui no estoy en los campo normales');
            //console.log(referenciasSeleccionadas);
    }

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
