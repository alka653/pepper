@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<h2>
			Lista de solicitudes
			@can('crear_solicitud')
				<small>
					<a href="{{ route('crear_solicitud') }}" class="btn btn-sm btn-success">Crear solicitud</a>
				</small>
			@endcan
		</h2>
		<div class="block">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Fecha solicitud</th>
							<th>Fecha finalizado</th>
							<th>Mascota</th>
							@unlessrole('guest')
								<th>Propietario</th>
							@endunlessrole
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@forelse($solicitudes as $solicitud)
							<tr>
								<td>{{ $solicitud->fecha_solicitud }}</td>
								<td>{{ $solicitud->fecha_finalizado }}</td>
								<td>{{ $solicitud->mascota->nombre }}</td>
								@unlessrole('guest')
									<td>{{ $solicitud->mascota->propietario->nombre.' '.$solicitud->mascota->propietario->apellido }}</td>
								@endunlessrole
								<td>{!! $solicitud->getEstado($solicitud->estado) !!}</td>
								<td>
									<a href="{{ route('detalle_solicitud', ['solicitud' => $solicitud->id]) }}" class="btn btn-primary btn-sm">Ver solicitud</a>
									@if(Auth::user()->perfil == 'U' && $solicitud->estado == 'P')
										<a href="{{ route('editar_solicitud', ['solicitud' => $solicitud->id]) }}" class="btn btn-warning btn-sm">Editar</a>
									@endif
								</td>
							</tr>
						@empty
							<tr class="text-center">
								<td colspan="@role('guest') 5 @else 6 @endcan">
									@role('guest')
										Aún no tienes solicitudes de certificados para tus mascotas. Da <a href="{{ route('crear_solicitud') }}">clic aquí</a> para realizar el trámite
									@else
										Aún no han realizado solicitudes
									@endrole
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
		{{ $solicitudes->links() }}
	</div>
@endsection