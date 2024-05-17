@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('cuentabancos.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>nombre_banco</th>
				<th>nro_cuenta</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($cuentabancos as $cuentabanco)

				<tr>
					<td>{{ $cuentabanco->id }}</td>
					<td>{{ $cuentabanco->name }}</td>
					<td>{{ $cuentabanco->nombre_banco }}</td>
					<td>{{ $cuentabanco->nro_cuenta }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('cuentabancos.show', [$cuentabanco->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('cuentabancos.edit', [$cuentabanco->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['cuentabancos.destroy', $cuentabanco->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
