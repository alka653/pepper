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
		<h2>Lista de tipos ataques</h2>
		<div class="row justify-content-md-center">
			<div class="col-12 text-center">
				@include('elements.buscar')
				<br>
				<a href="{{ route('crear_tipo_ataque') }}" class="btn btn-primary btn-sm open-modal" style="margin-top: 10px; margin-bottom: 10px;">Agregar tipo de ataque</a>
			</div>
			<div class="col-12">
				<div class="block">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Tipo de ataque</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@forelse($tipos_ataques as $tipo_ataque)
									<tr>
										<td>{{ $tipo_ataque->nombre }}</td>
										<td>
											<a href="{{ route('editar_tipo_ataque', ['tipo_ataque' => $tipo_ataque->id]) }}" class="btn btn-sm btn-warning open-modal">Editar</a>
											<a href="{{ route('eliminar_tipo_ataque', ['tipo_ataque' => $tipo_ataque->id]) }}" class="btn btn-sm btn-danger open-modal">Eliminar</a>
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
				{{ $tipos_ataques->links() }}
			</div>
		</div>
	</div>
@endsection