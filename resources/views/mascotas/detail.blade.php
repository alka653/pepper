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
		<h2 class="text-center">{{ $mascota->nombre }}</h2>
		<div class="row justify-content-md-center align-items-center">
			@foreach($mascota->fotos as $foto)
				<div class="col-md-2">
					<img src="{{ Storage::url($foto->foto) }}" alt="{{ $mascota->nombre }}" class="img-fluid rounded">
				</div>
			@endforeach
			<div class="col-12" style="margin: 10px 0px;">
				<div class="block">
					<div class="table-responsive">
						<table class="table table-striped table-sm">
							<tr>
								<th>Fecha de nacimiento</th>
								<td>{{ $mascota->fecha_nacimiento }}</td>
							</tr>
							<tr>
								<th>Sexo</th>
								<td>{{ $mascota->getSexo($mascota->sexo) }}</td>
							</tr>
							<tr>
								<th>Color</th>
								<td>{{ $mascota->color }}</td>
							</tr>
							<tr>
								<th>Descripción</th>
								<td>{{ $mascota->descripcion }}</td>
							</tr>
							<tr>
								<th>Estado</th>
								<td>{{ $mascota->estado }}</td>
							</tr>
							<tr>
								<th>Vacunado</th>
								<td>{{ $mascota->vacunado == 1 ? "Si. Fecha de vacunación: {$mascota->fecha_vacunacion}" : 'No' }}</td>
							</tr>
							<tr>
								<th>Raza</th>
								<td>{{ $mascota->raza->nombre }}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-12" style="margin: 10px 0px;">
				<h4 class="text-center">Certificados</h4>
				<div class="block">
					<table class="table">
						<thead>
							<tr>
								<th>Fecha remisión</th>
								<th>Fecha vencimiento</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@forelse($mascota->certificados as $certificado)
								<tr>
									<td>{{ $certificado->fecha_remitido }}</td>
									<td>{{ $certificado->fecha_vencimiento }}</td>
									<td>
										<a href="#" class="btn btn-sm btn-success">Descargar el certificado</a>
									</td>
								</tr>
							@empty
								<tr>
									<td class="text-center" colspan="3">
											{{ $mascota->nombre }} aún no tiene certificado. Da <a href="#">clic aquí</a> para hacer la solicitud.
									</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection