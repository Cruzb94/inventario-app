@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('tallers.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>nombre</th>
				<th>referencia</th>
				<th>descripcion</th>
				<th>fecha</th>
				<th>cantidad</th>
				<th>valor_unidad</th>
				<th>valor_total</th>
				<th>observaciones</th>
				<th>reprocesos</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tallers as $taller)

				<tr>
					<td>{{ $taller->id }}</td>
					<td>{{ $taller->nombre }}</td>
					<td>{{ $taller->referencia }}</td>
					<td>{{ $taller->descripcion }}</td>
					<td>{{ $taller->fecha }}</td>
					<td>{{ $taller->cantidad }}</td>
					<td>{{ $taller->valor_unidad }}</td>
					<td>{{ $taller->valor_total }}</td>
					<td>{{ $taller->observaciones }}</td>
					<td>{{ $taller->reprocesos }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('tallers.show', [$taller->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('tallers.edit', [$taller->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['tallers.destroy', $taller->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
