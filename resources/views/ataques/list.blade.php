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
			Lista de ataques registrados
			@can('gestionar_ataques')
				<small>
					<a href="{{ route('registrar_ataque') }}" class="btn btn-sm btn-primary">Registrar ataque</a>
				</small>
			@endcan
		</h2>
		<div class="block">
			<div class="table-responsive">
				<table class="table table-striped table-sm">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Paciente</th>
							<th>Especie agresora</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@forelse($ataques as $ataque)
							<tr>
								<td>{{ $ataque->fecha_ataque }}</td>
								<td>{{ $ataque->victima->nombre.' '.$ataque->victima->apellido }}</td>
								<td>{{ $ataque->agresorRaza($ataque->mascota->raza_id)->nombre }}</td>
								<td>
									<a href="{{ route('detalle_ataque', ['ataque' => $ataque->id]) }}" class="btn btn-sm btn-success">Ver detalle</a>
									<a href="{{ route('editar_ataque', ['ataque' => $ataque->id]) }}" class="btn btn-sm btn-warning">Editar</a>
									@can('seguimiento_ataque')
										<a href="{{ route('seguimiento_ataque', ['ataque' => $ataque->id]) }}" class="btn btn-sm btn-info">Seguimiento</a>
									@endcan
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="4" class="text-center">
									No hay registro de ataques
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
		{{ $ataques->links() }}
	</div>
@endsection