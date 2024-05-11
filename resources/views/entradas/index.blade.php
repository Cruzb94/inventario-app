@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('entradas.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>product_id</th>
				<th>fecha</th>
				<th>cantidad</th>
				<th>operario_id</th>
				<th>reproceso</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($entradas as $entrada)

				<tr>
					<td>{{ $entrada->id }}</td>
					<td>{{ $entrada->product_id }}</td>
					<td>{{ $entrada->fecha }}</td>
					<td>{{ $entrada->cantidad }}</td>
					<td>{{ $entrada->operario_id }}</td>
					<td>{{ $entrada->reproceso }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('entradas.show', [$entrada->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('entradas.edit', [$entrada->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['entradas.destroy', $entrada->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
