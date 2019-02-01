@extends('layouts.app_pdf')

@section('content')
	@include('elements.pdf.header')
	<h4 class="text-center">Reporte de usuarios</h4>
	<br />
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>No. de documento</th>
				<th>No. telefónico</th>
				<th>Dirección de residencia</th>
				<th>Perfil</th>
			</tr>
		</thead>
		<tbody>
			@foreach($usuarios as $usuario)
				<tr>
                    <td>{{ $usuario->persona->nombre }}</td>
                    <td>{{ $usuario->persona->apellido }}</td>
                    <td>{{ $usuario->persona->numero_documento }}</td>
                    <td>{{ $usuario->persona->numero_celular }} - {{ $usuario->persona->numero_telefonico }}</td>
                    <td>{{ $usuario->persona->direccion_residencia }}</td>
                    <td>{{ $usuario->getPerfil($usuario->perfil) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@include('elements.pdf.footer')
@endsection
