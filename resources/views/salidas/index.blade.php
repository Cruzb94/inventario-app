@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('salidas.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>referencia</th>
				<th>descripcion</th>
				<th>fecha</th>
				<th>cantidad</th>
				<th>guia</th>
				<th>valor</th>
				<th>estatus</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($salidas as $salida)

				<tr>
					<td>{{ $salida->id }}</td>
					<td>{{ $salida->referencia }}</td>
					<td>{{ $salida->descripcion }}</td>
					<td>{{ $salida->fecha }}</td>
					<td>{{ $salida->cantidad }}</td>
					<td>{{ $salida->guia }}</td>
					<td>{{ $salida->valor }}</td>
					<td>{{ $salida->estatus }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('salidas.show', [$salida->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('salidas.edit', [$salida->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['salidas.destroy', $salida->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
