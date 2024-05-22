@extends('adminlte::page')

@section('title', 'Crear Taller')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Crear nuevo taller</h1>
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

                {!! Form::open(['route' => 'tallers.store', 'method' => 'POST']) !!}
                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        <label class="form-label" for="nombre">Operario</label>
                        <select name="nombre" id="nombre" class="form-control">
                            <option value="" selected disabled>Seleccione un operario</option>
                            @foreach ($operarios as $operario)
                            <option value="{{ $operario->id }}" {{ old('nombre') == $operario->id ? 'selected' : '' }}>{{ $operario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label class="form-label" for="fecha">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}">
                    </div>
                </div>

                <div class="producto" id="producto1">
                    <div class="form-group row mt-4">
                        <div class="col-sm-10">
                            <label class="form-label" for="referencia1">Referencia del producto</label>
                            <select name="referencia1" id="referencia1" class="form-control">
                                <option value="" selected disabled>Seleccione un producto</option>
                                @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}" {{ old('referencia1') == $producto->id ? 'selected' : '' }}>{{ $producto->referencia }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label class="form-label" for="descripcion1">Descripción</label>
                            <input type="text" name="descripcion1" id="descripcion1" class="form-control" value="{{ old('descripcion1') }} ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label class="form-label" for="cantidad1">Cantidad</label>
                            <input type="number" name="cantidad1" id="cantidad1" class="form-control" value="{{ old('cantidad1') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label class="form-label" for="valor_unidad1">Valor por unidad</label>
                            <input type="number" name="valor_unidad1" id="valor_unidad1" class="form-control" value="{{ old('valor_unidad1') }}">
                        </div>
                    </div>
                </div>

                <div id="camposExtras">
                    <!-- Aquí se generarán dinámicamente los campos adicionales -->
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        <label class="form-label" for="valor_total">Valor total</label>
                        <input type="number" name="valor_total" id="valor_total" class="form-control" readonly >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label class="form-label" for="observaciones">Observaciones</label>
                        <input type="text" name="observaciones" id="observaciones" class="form-control" value="{{ old('observaciones') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label class="form-label" for="reprocesos">Reprocesos</label>
                        <input type="number" name="reprocesos" id="reprocesos" class="form-control" value="{{ old('reprocesos') }}">
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-bg-purple">Crear Taller</button>
                    </div>
                    <div class="col-sm-5 text-right">
                        <button type="button" class="btn btn-success" id="agregarCampo">Agregar Producto</button>
                    </div>
                </div>

                {!! Form::close() !!}
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
    var contador = 2; 

        var errors = {!! $errors->toJson() !!};
    if (Object.keys(errors).length > 0) {

        calcularValorTotal();
    }

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
                    <label class="form-label" for="referencia${indice}">Referencia del producto</label>
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
                    <label class="form-label" for="descripcion${indice}">Descripción</label>
                    <input type="text" name="descripcion${indice}" id="descripcion${indice}" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <label class="form-label" for="cantidad${indice}">Cantidad</label>
                    <input type="number" name="cantidad${indice}" id="cantidad${indice}" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <label class="form-label" for="valor_unidad${indice}">Valor por unidad</label>
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
