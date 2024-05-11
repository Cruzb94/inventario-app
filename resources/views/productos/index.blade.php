@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

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
                            <a href="{{ route('productos.edit', [$producto->id]) }}" class="btn btn-primary mr-1">Edit</a>
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

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop