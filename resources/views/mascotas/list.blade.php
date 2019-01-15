@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container" style="margin-bottom: 50px">
		<h2>
			Lista de mascotas
			@can('crear_mascota')
				<a href="{{ route('crear_mascota') }}" class="btn btn-primary btn-sm" style="margin-top: 10px; margin-bottom: 10px;">Agregar mascota</a>
			@endcan
		</h2>
		@include('elements.buscar', ['extra' => 'mascotas.filters'])
		<div class="block">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Mascota</th>
							<th>Género</th>
							<th>Raza</th>
							@unlessrole('guest')
								<th>Propietario</th>
							@endunlessrole
							<th></th>
						</tr>
					</thead>
					<tbody>
						@forelse($mascotas as $mascota)
							<tr>
								<td>{{ $mascota->nombre }}</td>
								<td>{{ $mascota->getSexo($mascota->sexo) }}</td>
								<td>{{ $mascota->raza->nombre }}</td>
								@unlessrole('guest')
									<td>{{ $mascota->propietario_id != null ? $mascota->propietario->nombre.' '.$mascota->propietario->apellido : 'Sin propietario' }}</td>
								@endunlessrole
								<td>
									<a href="{{ route('detalle_mascota', ['mascota' => $mascota->id]) }}" class="btn btn-sm btn-info">Detalle</a>
									<a href="{{ route('editar_mascota', ['mascota' => $mascota->id]) }}" class="btn btn-sm btn-warning">Editar</a>
								</td>
							</tr>
						@empty
							<tr>
								@role('guest')
									<td colspan="4">
										No se encuentra la mascota agregada. Da <a href="{{ route('crear_mascota') }}">clic aquí</a> para agregar una mascota
									</td>
								@else
									<td colspan="5">
										No se enontraron resultados
									</td>
								@endrole
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
		{{ $mascotas->links() }}
	</div>
@endsection