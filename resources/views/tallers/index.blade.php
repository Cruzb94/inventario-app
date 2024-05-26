@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tallers</h1>
@stop

@section('content')
   
<a href="{{ route('tallers.create') }}" class="btn btn-bg-purple mb-3">Create</a>

<table id="tallers"  class=" table-bordered shadow-lg mt-4 " style="width:100%">
		<thead>
			<tr>
				<th class=" bg-purple text-wwhite">nombre</th>
				<th class=" bg-purple text-wwhite">referencia</th>
				<th class=" bg-purple text-wwhite">fecha</th>
				<th class=" bg-purple text-wwhite">valor_total</th>
				<th class=" bg-purple text-wwhite">observaciones</th>
				<th class=" bg-purple text-wwhite">reprocesos</th>

				<th class=" bg-purple text-wwhite">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tallers as $taller)

				<tr>
					<td>{{ $taller->operario->name }}</td>
					<td>
						@php
							$referencias = json_decode($taller->referencia);
						@endphp
						@if($referencias)
							<div class="mb-2 p-2 border rounded" style="font-size: 0.85rem; background-color: #f9f9f9;">
								<strong>Referencia:</strong> {{ $referencias[0][0] }}<br>
								<strong>Descripción:</strong> {{ $referencias[1][0] }}<br>
								<strong>Cantidad:</strong> {{ $referencias[2][0] }}<br>
								<strong>Valor:</strong> {{ $referencias[3][0] }}
							</div>
							@if(count($referencias[0]) > 1)
								<div id="referencias-extra-{{ $taller->id }}" style="display: none;">
									@for($i = 1; $i < count($referencias[0]); $i++)
										<div class="mb-2 p-2 border rounded" style="font-size: 0.85rem; background-color: #f9f9f9;">
											<strong>Referencia:</strong> {{ $referencias[0][$i] }}<br>
											<strong>Descripción:</strong> {{ $referencias[1][$i] }}<br>
											<strong>Cantidad:</strong> {{ $referencias[2][$i] }}<br>
											<strong>Valor:</strong> {{ $referencias[3][$i] }}
										</div>
									@endfor
								</div>
								<button class="btn btn-link text-purple" style="color: #6f42c1; font-weight: bold;" onclick="toggleReferencias({{ $taller->id }})" id="toggle-button-{{ $taller->id }}">Ver más</button>
								@endif
						@endif
					</td>
					<td>{{ Carbon\Carbon::parse($taller->fecha)->format('d/m/Y') }}</td>
					<td>{{ $taller->valor_total }}</td>
					<td>{{ $taller->observaciones }}</td>
					<td>{{ $taller->reprocesos }}</td>

					<td>
						<div class="d-flex gap-2">

                            <a href="{{ route('tallers.edit', [$taller->id]) }}" class="btn btn-primary">Edit</a>
							@if(isAdmin())
                            {!! Form::open(['method' => 'DELETE','route' => ['tallers.destroy', $taller->id], 'class' => 'formulario-eliminar']) !!}
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
	 $('#tallers').dataTable( {  
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
	 
	 

   
	 } );
   } );
   
   
   </script>

   
@if (session('create') == 'ok1')
<script>
	Swal.fire({
			title: "Creado!",
			text: "El Taller se creo con exito.",
			icon: "success"
});


		
</script>

@endif

@if (session('editar') == 'ok2')
<script>
	Swal.fire({
			title: "Editado!",
			text: "El Taller se edito con exito.",
			icon: "success"
});
		
</script>

@endif




@if (session('eliminar') == 'ok3')
<script>
	Swal.fire({
			title: "¡Eliminado!",
			text: "El Taller se elimino con exito.",
			icon: "success"
});


		
</script>

@endif

<script>

$('.formulario-eliminar').submit(function(e){
	e.preventDefault();
	Swal.fire({
		title: "¿Esta seguro?",
		text: "Este Taller se eliminara definitivamente",
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

<script>
    function toggleReferencias(id) {
        var extraReferencias = document.getElementById('referencias-extra-' + id);
        var toggleButton = document.getElementById('toggle-button-' + id);

        if (extraReferencias.style.display === 'none') {
            extraReferencias.style.display = 'block';
            toggleButton.textContent = 'Ocultar';
        } else {
            extraReferencias.style.display = 'none';
            toggleButton.textContent = 'Ver más';
        }
    }
</script>
@stop