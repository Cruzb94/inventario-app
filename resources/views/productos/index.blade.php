@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('productos.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>referencia</th>
				<th>descripcion</th>
				<th>entrada</th>
				<th>salida</th>
				<th>stock</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($productos as $producto)

				<tr>
					<td>{{ $producto->id }}</td>
					<td>{{ $producto->referencia }}</td>
					<td>{{ $producto->descripcion }}</td>
					<td>{{ $producto->entrada }}</td>
					<td>{{ $producto->salida }}</td>
					<td>{{ $producto->stock }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('productos.show', [$producto->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('productos.edit', [$producto->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['productos.destroy', $producto->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
