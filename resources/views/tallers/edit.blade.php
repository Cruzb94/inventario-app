@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Editar taller</h1>
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

                {!! Form::model($taller, ['route' => ['tallers.update', $taller->id], 'method' => 'PUT']) !!}
                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        <label class="form-label" for="nombre">Operario</label>
                        <select name="nombre" id="nombre" class="form-control">
                            <option value="" selected disabled>Seleccione un operario</option>
                            @foreach ($operarios as $operario)
                                <option value="{{ $operario->id }}" {{ $operario->id == $taller->operario_id ? 'selected' : '' }}>{{ $operario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2 align-self-end">
                        <!-- Botón Eliminar no visible para el campo estático -->
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label class="form-label" for="fecha">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $taller->fecha }}">
                    </div>
                    <div class="col-sm-2 align-self-end">
                        <!-- Botón Eliminar no visible para el campo estático -->
                    </div>
                </div>

                @foreach($productosConReferencias as $index => $productosConReferencia)
                <div class="producto" id="producto{{ $index }}">
                    @if($index > 0) <!-- Solo agregar el botón eliminar y el título para los productos después del primero -->
                    <hr class="my-4">
                <div class="d-flex justify-content-between">
                    <h3>Producto {{ $index + 1 }}</h3>
                    <button type="button" class="btn btn-danger" onclick="eliminarCampo('{{ $index }}')"><i class="fa-solid fa-circle-xmark"></i></button>
                        </div>
                            @endif
                    <div class="form-group row mt-4">
                        <div class="col-sm-10">
                            <label class="form-label" for="referencia{{ $index }}">Referencia del producto</label>
                            <select name="referencia{{ $index }}" id="referencia{{ $index }}" class="form-control">
                                <option value="" selected disabled>Seleccione un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}" {{ $producto->id == $productosConReferencia ? 'selected' : '' }}>{{ $producto->referencia }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label class="form-label" for="descripcion{{ $index }}">Descripción</label>
                            <input type="text" name="descripcion{{ $index }}" id="descripcion{{ $index }}" class="form-control" value="{{ $descripciones[$index] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label class="form-label" for="cantidad{{ $index }}">Cantidad</label>
                            <input type="number" name="cantidad{{ $index }}" id="cantidad{{ $index }}" class="form-control" value="{{ $cantidades[$index] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label class="form-label" for="valor_unidad{{ $index }}">Valor por unidad</label>
                            <input type="number" name="valor_unidad{{ $index }}" id="valor_unidad{{ $index }}" class="form-control" value="{{ $valoresUnidad[$index] }}">
                        </div>
                    </div>
                </div>
                @endforeach

                <div id="camposExtras">
                    <!-- Aquí se generarán dinámicamente los campos adicionales -->
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-12">
                        <hr class="my-4">
                        <label class="form-label" for="valor_total">Valor total</label>
                        <input type="number" name="valor_total" id="valor_total" class="form-control" readonly value="{{ $taller->valor_total }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label class="form-label" for="observaciones">Observaciones</label>
                        <input type="text" name="observaciones" id="observaciones" class="form-control" value="{{ $taller->observaciones }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label class="form-label" for="reprocesos">Reprocesos</label>
                        <input type="number" name="reprocesos" id="reprocesos" class="form-control" value="{{ $taller->reprocesos }}">
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-bg-purple">Create</button>
                    </div>
                    <div class="col-sm-5 text-right">
                        <button type="button" class="btn btn-success" id="agregarCampo">Agregar Producto</button>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('estilos/estilos.css')}}">

    <style>
        .my-4 {
            border-top: 2px solid black; /* Cambia el grosor y color de la línea */
            margin-top: 20px; /* Ajusta el espacio encima de la línea */
            margin-bottom: 20px; /* Ajusta el espacio debajo de la línea */
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<script>
    var contador = {{ count($productosConReferencias) + 1 }};

    $('#agregarCampo').click(function(){
    var nuevoCampo = generarCampoHTML(contador);
    $('#camposExtras').append(nuevoCampo);
    contador++;

  
    $('.producto').each(function(i, element) {
        var nuevoIndice = i + 1; 
        $(this).attr('id', 'producto' + nuevoIndice); 
        $(this).find('h3').text('Producto ' + nuevoIndice); 
        $(this).find('button').attr('onclick', 'eliminarCampo("' + nuevoIndice + '")');
        $(this).find('[name^="referencia"]').attr('name', 'referencia' + nuevoIndice); 
        $(this).find('[name^="descripcion"]').attr('name', 'descripcion' + nuevoIndice); 
        $(this).find('[name^="cantidad"]').attr('name', 'cantidad' + nuevoIndice); 
        $(this).find('[name^="valor_unidad"]').attr('name', 'valor_unidad' + nuevoIndice); 
    });
});

    // Calcular el valor total cuando cambian la cantidad o el valor por unidad
    $(document).on('input', 'input[name^="cantidad"], input[name^="valor_unidad"]', function() {
        calcularValorTotal();
    });

    function calcularValorTotal() {
        var total = 0;
        $('input[name^="cantidad"]').each(function() {
            var indice = $(this).attr('name').replace('cantidad', '');
            var cantidad = parseFloat($(this).val()) || 0;
            var valorUnidad = parseFloat($('input[name="valor_unidad' + indice + '"]').val()) || 0;
            var valorTotal = cantidad * valorUnidad;
            total += valorTotal;
        });
        $('#valor_total').val(total.toFixed(2));
    }

    function generarCampoHTML(indice) {
        var campoHTML =
        `<div id="producto${indice}" class="producto"> 
            <hr class="my-4">
            <div class="d-flex justify-content-between">
                <h3>Producto ${indice}</h3>
                <button type="button" class="btn btn-danger" onclick="eliminarCampo('${indice}')"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
            <div class="form-group row mt-4">
                <div class="col-sm-10">
                    <label class="form-label" for="referencia${indice}">Referencia </label>
                    <select name="referencia${indice}" id="referencia${indice}" class="form-control">
                        <option value="" selected disabled>Seleccione un producto</option>`;
    
        @foreach($productos as $producto)
            campoHTML += `<option value="{{ $producto->id }}">{{ $producto->referencia }}</option>`;
        @endforeach

        campoHTML += `</select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <label class="form-label" for="descripcion${indice}">Descripción </label>
                    <input type="text" name="descripcion${indice}" id="descripcion${indice}" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <label class="form-label" for="cantidad${indice}">Cantidad </label>
                    <input type="number" name="cantidad${indice}" id="cantidad${indice}" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <label class="form-label" for="valor_unidad${indice}">Valor por unidad </label>
                    <input type="number" name="valor_unidad${indice}" id="valor_unidad${indice}" class="form-control" >
                </div>
            </div>
        </div>`;
        
        return campoHTML;
    }

    function eliminarCampo(indice) {

    $('.producto#producto' + indice).remove(); 
    

    $('.producto').each(function(i, element) {
        var nuevoIndice = i + 1; 
        $(this).attr('id', 'producto' + nuevoIndice); 
        $(this).find('h3').text('Producto ' + nuevoIndice); 
        $(this).find('button').attr('onclick', 'eliminarCampo("' + nuevoIndice + '")'); 
        $(this).find('[name^="referencia"]').attr('name', 'referencia' + nuevoIndice); 
        $(this).find('[name^="descripcion"]').attr('name', 'descripcion' + nuevoIndice); 
        $(this).find('[name^="cantidad"]').attr('name', 'cantidad' + nuevoIndice); 
        $(this).find('[name^="valor_unidad"]').attr('name', 'valor_unidad' + nuevoIndice); 
    });
    
    calcularValorTotal(); 
}
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
       
        function actualizarDescripcion(select, indice) {
            var productoId = select.value;
            fetch('/obtener-descripcion/' + productoId)
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud: ' + response.status);
                    }
                    return response.json();
                })
                .then(function(data) {
                    var descripcionInput = document.querySelector('input[name="descripcion' + indice + '"]');
                    if (descripcionInput) {
                        descripcionInput.value = data.descripcion;
                    } else {
                        console.error("No se encontró el campo de descripción.");
                    }
                })
                .catch(function(error) {
                    console.error(error);
                });
        }
        
        // Manejar cambios en todos los campos de referencia
        document.addEventListener('change', function(event) {
            var target = event.target;
            if (target && target.tagName === 'SELECT' && target.name.startsWith('referencia')) {
                var indice = target.name.replace('referencia', '');
                actualizarDescripcion(target, indice);
            }
        });
    });
    </script>
@stop