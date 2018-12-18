@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container" style="margin-bottom: 100px;">	
		<h2 class="no-margin">
			Solicitud de certificado para {{ $solicitud->mascota->nombre }}
			<small>{!! $solicitud->getEstado($solicitud->estado) !!}</small>
			@if(Auth::user()->perfil == 'U' && $solicitud->estado == 'P')
				<small>
					<a href="{{ route('editar_solicitud', ['solicitud' => $solicitud->id]) }}" class="btn btn-warning btn-sm">Editar</a>
				</small>
			@endif
		</h2>
		<p>
			<b>Fecha de solicitud</b>
			{{ $solicitud->fecha_solicitud }}
		</p>
		<div class="row justify-content-md-center">
			@foreach($solicitud->documentos as $documento)
				<div class="col-md-4">
					<div class="block">
						<a href="{{ Storage::url($documento->documento) }}" target="_blank">
							{{ $documento->tipo }}
						</a>
					</div>
				</div>
			@endforeach
		</div>
		<br>
		<h4>Revisiones</h4>
		<div class="block">
			@unlessrole('guest')
				@if($solicitud->revisionesInspector($solicitud->id, Auth::user()->id) == 0)
					{{ Form::open(['url' => route('crear_revision.post', ['solicitud' => $solicitud->id]), 'method' => 'post', 'autocomplete' => 'off']) }}
						<div class="form-group">
							{{ Form::label('observacion', 'Observación', ['class' => 'label-required']) }}
							{{ Form::textarea('observacion', null, ['required', 'rows' => 2, 'class' => 'form-control']) }}
						</div>
						@if($solicitud->revisiones->count() == 0 || (isset(end($solicitud->revisiones)[0]) && end($solicitud->revisiones)[0]->modo < 3))
							<div class="form-group">
								{{ Form::label('remitir', '¿Remitir al siguiente inspector?', ['class' => 'label-required']) }}
								{{ Form::select('remitir', [
									'' => 'Seleccione una opción',
									'N' => 'No',
									'S' => 'Si'
								], null, ['required', 'class' => 'form-control']) }}
							</div>
						@else
							<div class="form-group">
								{{ Form::label('certificado', '¿Aceptar certificado?', ['class' => 'label-required']) }}
								{{ Form::select('certificado', [
									'' => 'Seleccione una opción',
									'N' => 'No',
									'S' => 'Si'
								], null, ['required', 'class' => 'form-control']) }}
							</div>
						@endif
						<div class="form-group text-center">
							{!! Form::button('Enviar datos', ['type' => 'submit', 'class' => 'btn btn-sm btn-primary']) !!}
						</div>
					{{ Form::close() }}
				@else
					<div class="alert alert-warning">
						Ya has realizado la revisión
					</div>
				@endif
			@endunlessrole
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Inspector</th>
							<th>Observación</th>
							<th>Estado</th>
						</tr>
					</thead>
					<tbody>
						@forelse($solicitud->revisiones as $revision)
							@if($revision->inspector_id != null)
								<tr>
									<td>{{ $revision->fecha }}</td>
									<td>{{ $revision->inspector->persona->nombre.' '.$revision->inspector->persona->apellido }}</td>
									<td>{{ $revision->observacion }}</td>
									<td>{{ $revision->getEstado($revision->estado) }}</td>
								</tr>
							@endif
						@empty
							<tr class="text-center">
								<td colspan="4">Sin revisiones</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection