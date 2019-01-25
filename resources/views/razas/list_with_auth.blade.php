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
		<h2>Lista de razas</h2>
		<div class="row justify-content-md-center">
			<div class="col-12 text-center">
				@include('elements.buscar')
				<br>
				@can('gestionar_raza')
					<a href="{{ route('crear_raza') }}" class="btn btn-primary btn-sm open-modal" style="margin-top: 10px; margin-bottom: 10px;">Agregar raza</a>
				@endcan
			</div>
			<div class="col-12">
				<div class="block">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Raza</th>
									<th>Especie</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@forelse($razas as $raza)
									<tr>
										<td>{{ $raza->nombre }}</td>
										<td>{{ $raza->getEspecie($raza->especie) }}</td>
										<td>
											@can('gestionar_raza')
												<a href="{{ route('editar_raza', ['raza' => $raza->id]) }}" class="btn btn-sm btn-warning open-modal">Editar</a>
												<a href="{{ route('eliminar_raza', ['raza' => $raza->id]) }}" class="btn btn-sm btn-danger open-modal">Eliminar</a>
											@endcan
										</td>
									</tr>
								@empty
									<tr class="text-center">
										<td colspan="3">
											Aún no hay razas registradas
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-12">
				{{ $razas->links() }}
			</div>
		</div>
	</div>
@endsection