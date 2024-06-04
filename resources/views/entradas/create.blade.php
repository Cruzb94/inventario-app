@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mt-4">Crear entrada</h1>
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

                {!! Form::open(['route' => 'entradas.store']) !!}


                <div id="referencias-container">

                    <div class="form-group row mt-4 referencia-item" data-index="1">
                        <div class="col-sm-12 text-right mr-5">
                            <button type="button" class="btn btn-success" onclick="addReferencia()"><i class="fa-solid fa-plus"></i></button>
                        </div>

                        <div class="col-sm-4">
                        {{ Form::label('product_id[]', 'Referencia', ['class'=>'form-label']) }}
                        {{ Form::select('product_id[]', $productos->pluck('referencia', 'referencia'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione una referencia']) }}
                        </div>
                
                    <div class="col-sm-4">
                        {{ Form::label('cantidad[]', 'Cantidad', ['class'=>'form-label']) }}
                        {{ Form::number('cantidad[]', null, array('class' => 'form-control')) }}
                    </div>

                    

                    <div class="col-sm-4">
                        {{ Form::label('reproceso[]', 'Reproceso', ['class'=>'form-label']) }}
                        {{ Form::number('reproceso[]', null, array('class' => 'form-control')) }}
                    </div>
        
            </div>
        </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
                        {{ Form::date('fecha', null, array('class' => 'form-control', 'id' => 'fecha')) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        {{ Form::label('operario_id', 'Operario', ['class'=>'form-label']) }}
                        {{ Form::select('operario_id', $operarios->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione un operario']) }}
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-5">
                        {{ Form::submit('Crear', array('class' => 'btn btn-bg-purple')) }}
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
	 <link rel="stylesheet" href="{{asset('estilos/estilos.css')}}">
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
<script>
        let referenciaIndex = 1;
    function addReferencia() {
    const container = document.getElementById('referencias-container');
    const div = document.createElement('div');
    div.classList.add('form-group', 'row', 'mt-2', 'referencia-item');

   // const currentIndex = document.querySelectorAll('.referencia-item').length + 1;

    //const hr = document.createElement('hr');
    //hr.classList.add('my-4');
   // container.appendChild(hr);

    div.innerHTML = `
        <div class="d-flex justify-content-between mb-4 col-sm-12">
            
           
            <button type="button" class="btn btn-danger" onclick="removeReferencia(this)">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>            
        </div>
        
        <div class="col-sm-4 position-relative">
            {{ Form::label('product_id[]', 'Referencia ', ['class'=>'form-label']) }} 
            {{ Form::select('product_id[]', $productos->pluck('referencia', 'referencia'), null, ['class' => 'form-control', 'placeholder' => 'Seleccione una referencia']) }}
        </div>
        <div class="col-sm-4">
            {{ Form::label('cantidad[]', 'Cantidad', ['class'=>'form-label']) }}
            {{ Form::number('cantidad[]', null, ['class' => 'form-control']) }}
        </div>
        
        <div class="col-sm-4">
                        {{ Form::label('reproceso[]', 'Reproceso', ['class'=>'form-label']) }}
                        {{ Form::number('reproceso[]', null, array('class' => 'form-control')) }}
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
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@stop
