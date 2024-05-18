@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Crear tallers</h1>
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

                {!! Form::open(['route' => 'tallers.store']) !!}
                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        {{ Form::label('nombre', 'Operario', ['class'=>'form-label']) }}
                        {{ Form::select('nombre',  $operarios->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione un operario']) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
                        {{ Form::date('fecha', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('referencia1', 'Referencia del producto', ['class'=>'form-label']) }}
                        {{ Form::select('referencia1', $productos->pluck('referencia', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione un producto']) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('descripcion1', 'Descripcion', ['class'=>'form-label']) }}
                        {{ Form::text('descripcion1', null, array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('cantidad1', 'Cantidad', ['class'=>'form-label']) }}
                        {{ Form::number('cantidad1', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('valor_unidad1', 'Valor_unidad', ['class'=>'form-label']) }}
                        {{ Form::number('valor_unidad1', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="col-sm-12"> 
                 
                        <div id="camposExtras"></div>
                     
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('valor_total', 'Valor_total', ['class'=>'form-label']) }}
                        {{ Form::number('valor_total', null, array('class' => 'form-control','readonly' => true)) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('observaciones', 'Observaciones', ['class'=>'form-label']) }}
                        {{ Form::text('observaciones', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        {{ Form::label('reprocesos', 'Reprocesos', ['class'=>'form-label']) }}
                        {{ Form::number('reprocesos', null, array('class' => 'form-control')) }}
                    </div>
                </div>


                <div class="form-group row mt-4">
                    <div class="col-sm-5">
                        {{ Form::submit('Create', array('class' => 'btn btn-bg-purple')) }}
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
@stop

@section('js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
           
       
        var errors = {!! $errors->toJson() !!};
        if (Object.keys(errors).length > 0) {
            
            calcularValorTotal();
        }
            
        var contador = 2;

        $('#agregarCampo').click(function(){
            var nuevoCampo = generarCampoHTML(contador);
            $('#camposExtras').append(nuevoCampo);
            contador++;
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
        `<hr class="my-4">
        <h3>Producto ${indice}</h3>
        <div class="form-group row mt-4">
            <div class="col-sm-10">
                <label class="form-label" for="referencia${indice}">Referencia ${indice}</label>
                <select name="referencia${indice}" id="referencia${indice}" class="form-control">
                    <option value="" selected disabled>Seleccione un producto</option>`;
    
    // Agregar opciones de productos al campo de selección
    @foreach($productos as $producto)
        campoHTML += `<option value="{{ $producto->id }}">{{ $producto->referencia }}</option>`;
    @endforeach

    campoHTML += `</select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label class="form-label" for="descripcion${indice}">Descripción ${indice}</label>
                <input type="text" name="descripcion${indice}" id="descripcion${indice}" class="form-control" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label class="form-label" for="cantidad${indice}">Cantidad ${indice}</label>
                <input type="number" name="cantidad${indice}" id="cantidad${indice}" class="form-control" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label class="form-label" for="valor_unidad${indice}">Valor por unidad ${indice}</label>
                <input type="number" name="valor_unidad${indice}" id="valor_unidad${indice}" class="form-control" >
            </div>
        </div>`;
    
    return campoHTML;
           
        }
    });

</script>
@stop