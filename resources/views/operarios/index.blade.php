@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Operarios</h1>
	<meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('content')
<a href="{{ route('operarios.create') }}" class="btn btn-bg-purple mb-3">Create</a>
<form method="GET" action="{{ route('operarios.index') }}" class="mb-4">
    <div class="row align-items-end">
        <div class="col-md-4">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
        </div>
        <div class="col-md-4">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-bg-purple">Filtrar</button>
        </div>
    </div>
</form>

<table id="operario"  class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
	<thead>
		<tr>

			<th class=" bg-purple text-wwhite">name</th>
			<th class=" bg-purple text-wwhite">Cedula-Nit</th>
			<th class=" bg-purple text-wwhite">Numero de contacto</th>
			<th class=" bg-purple text-wwhite">Direccion</th>
			<th class=" bg-purple text-wwhite">Fecha de ingreso</th>

			<th class=" bg-purple text-wwhite">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($operarios as $operario)

			<tr>

				<td>{{ $operario->name }}</td>
				<td>{{ $operario->nit }}</td>
				<td>{{ $operario->numero_contacto }}</td>
				<td>{{ $operario->direccion }}</td>
				<td>{{ Carbon\Carbon::parse($operario->fecha_ingreso)->format('d/m/Y') }}</td>

				<td>
					<div class="d-flex gap-2">
					
						<a href="{{ route('operarios.edit', [$operario->id]) }}" class="btn btn-primary mr-1">Edit</a>
						@if(isAdmin())
						{!! Form::open(['method' => 'DELETE','route' => ['operarios.destroy', $operario->id], 'class' => 'formulario-eliminar']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!}
						@endif
					</div>
				</td>
			</tr>

		@endforeach
	</tbody>
</table>
@stop

@section('css')
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.0/css/fixedHeader.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css">
<link rel="stylesheet" href="{{asset('estilos/estilos.css')}}">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.0/js/dataTables.fixedHeader.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.0/js/fixedHeader.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


<script>  
	// new DataTable('#articulos');
	 $(document).ready(function() {
	 $('#operario').dataTable( {  
	   //fixedHeader: true,
	   //responsive: true,
		"language": {
			   "lengthMenu": "Mostrar _MENU_ Registro por pagina",
			   "zeroRecords": "Nada Encontrado - Disculpa",
			   "info": "Mostrando la pagina _PAGE_ de _PAGES_",
			   "infoEmpty": "No records available",
			   "infoFiltered": "(Filtrado de _MAX_ Registros totales)",
			   "search": "Buscar:",
			   "paginate":{
				   'next': 'Siguiente',
				   'previous': 'Anterior'
			   }
		   },
   
		 "lengthMenu": [ [5, 10, 50, -1], [5, 10, 50, 100] ],
		   "ordering": false,
		   "dom": 'lfBrtip', // Mostrar los botones en la parte superior derecha
		   "buttons": [
            {
                text: '<i class="fa-solid fa-file-pdf"></i>',
                className: 'btn btn-danger mb-2',
                action: function () {
                    generarReportePDF();
                }
            }
        ]
	 
	 
	 

   
	 } );
   } );
   
   
   </script>

<script>
	function generarReportePDF() {
	 // Obtener el token CSRF
	 let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 
	 // Obtener los datos de la tabla
	 let tableData = obtenerDatosTabla();
 
	 // Enviar los datos al servidor
	 fetch('/generar-reporte2-pdf', {
		 method: 'POST',
		 headers: {
			 'Content-Type': 'application/json',
			 'X-CSRF-TOKEN': csrfToken
		 },
		 body: JSON.stringify(tableData),
	 })
	 .then(response => response.blob())
	 .then(blob => {
		 // Crear una URL para el blob
		 let url = window.URL.createObjectURL(blob);
 
		 // Abrir el PDF en una nueva ventana
		 window.open(url);
	 })
	 .catch(error => console.error('Error al generar el reporte PDF:', error));
 }
 
 // Función para obtener los datos de la tabla
 function obtenerDatosTabla() {
	 let tableData = [];
	 $('#operario tbody tr').each(function() {
		 let rowData = [];
		 $(this).find('td').each(function(index) {
			 // Excluir la posición 3 que contiene el texto "Edit"
			 if (index !== 5) {
				 rowData.push($(this).text().trim()); // Agregar solo el texto de la celda
			 }
		 });
		 tableData.push(rowData);
	 });
	 return tableData;
 }
 
	</script>

   
@if (session('create') == 'ok1')
<script>
	Swal.fire({
			title: "Creado!",
			text: "El Operador se creo con exito.",
			icon: "success"
});


		
</script>

@endif

@if (session('editar') == 'ok2')
<script>
	Swal.fire({
			title: "Editado!",
			text: "El Operador se edito con exito.",
			icon: "success"
});
		
</script>

@endif




@if (session('eliminar') == 'ok3')
<script>
	Swal.fire({
			title: "¡Eliminado!",
			text: "El Operador se elimino con exito.",
			icon: "success"
});


		
</script>

@endif

<script>

$('.formulario-eliminar').submit(function(e){
	e.preventDefault();
	Swal.fire({
		title: "¿Esta seguro?",
		text: "Este Operador se eliminara definitivamente",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "¡si, eliminar!",
		cancelButtonText: "Cancelar",
	}).then((result) => {
		if (result.isConfirmed) {
			/*Swal.fire({
			title: "Deleted!",
			text: "Your file has been deleted.",
			icon: "success"
});*/

		this.submit();
}
});
});

</script>
@stop