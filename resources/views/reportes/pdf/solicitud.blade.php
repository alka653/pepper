@extends('layouts.app_pdf')

@section('content')
	@include('elements.pdf.header')
	<h4 class="text-center">Reporte de solicitudes</h4>
	<br />
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>No. radicado</th>
				<th>Fecha de solicitud</th>
				<th>Nombre de la mascota</th>
				<th>Raza</th>
				<th>Nombre del propietario</th>
				<th>Estado</th>
			</tr>
		</thead>
		<tbody>
			@foreach($solicitudes as $solicitud)
				<tr>
					<td>{{ $solicitud->id }}</td>
					<td>{{ $solicitud->fecha_solicitud }}</td>
					<td>{{ $solicitud->mascota->nombre }}</td>
					<td>{{ $solicitud->mascota->raza->nombre }}</td>
					<td>{{ $solicitud->mascota->propietario->nombre.' '.$solicitud->mascota->propietario->apellido }}</td>
					<td>{{ $solicitud->getEstado($solicitud->estado, false) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@include('elements.pdf.footer')
@endsection
