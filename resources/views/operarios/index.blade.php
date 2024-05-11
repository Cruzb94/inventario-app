@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('operarios.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($operarios as $operario)

				<tr>
					<td>{{ $operario->id }}</td>
					<td>{{ $operario->name }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('operarios.show', [$operario->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('operarios.edit', [$operario->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['operarios.destroy', $operario->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
