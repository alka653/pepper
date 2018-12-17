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
		<h2>Lista de localizaciones anatómicas</h2>
		<div class="row justify-content-md-center">
			<div class="col-12 text-center">
				@include('elements.buscar')
				<br>
				<a href="{{ route('crear_localizacion_anatomica') }}" class="btn btn-primary btn-sm open-modal" style="margin-top: 10px; margin-bottom: 10px;">Agregar localización anatómica</a>
			</div>
			<div class="col-12">
				<div class="block">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Localización anatómica</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@forelse($localizaciones_anatomicas as $localizacion_anatomica)
									<tr>
										<td>{{ $localizacion_anatomica->nombre }}</td>
										<td>
											<a href="{{ route('editar_localizacion_anatomica', ['localizacion_anatomica' => $localizacion_anatomica->id]) }}" class="btn btn-sm btn-warning open-modal">Editar</a>
											<a href="{{ route('eliminar_localizacion_anatomica', ['localizacion_anatomica' => $localizacion_anatomica->id]) }}" class="btn btn-sm btn-danger open-modal">Eliminar</a>
										</td>
									</tr>
								@empty
									<tr class="text-center">
										<td colspan="3">
											Aún no hay tipos de ataques registrados
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-12">
				{{ $localizaciones_anatomicas->links() }}
			</div>
		</div>
	</div>
@endsection