@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('ingresos.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>fecha</th>
				<th>cuenta_bancolombia</th>
				<th>nequi</th>
				<th>efectivo</th>
				<th>descripcion</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($ingresos as $ingreso)

				<tr>
					<td>{{ $ingreso->id }}</td>
					<td>{{ $ingreso->fecha }}</td>
					<td>{{ $ingreso->cuenta_bancolombia }}</td>
					<td>{{ $ingreso->nequi }}</td>
					<td>{{ $ingreso->efectivo }}</td>
					<td>{{ $ingreso->descripcion }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('ingresos.show', [$ingreso->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('ingresos.edit', [$ingreso->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['ingresos.destroy', $ingreso->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
