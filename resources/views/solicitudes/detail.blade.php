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
		<p class="no-margin">
			<b>Fecha de solicitud:</b>
			{{ $solicitud->fecha_solicitud }}
		</p>
		<p>
			<b>Propietario:</b>
			{{ $solicitud->mascota->propietario->nombre.' '.$solicitud->mascota->propietario->apellido }}
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
			@if($solicitud->estado == 'F' && Auth::user()->perfil == 'U')
				<div class="alert alert-success">
					La solicitud ha sido aprobada. Puede descargarlo <a href="{{ route('listar_certificados') }}">aquí</a>
				</div>
			@endif
			@unlessrole('guest')
				@if($solicitud->revisionesInspector($solicitud->id, Auth::user()->id, ['P', 'N'])['response'] && $solicitud->estado == 'P')
					{{ Form::model($revisionModel, ['route' => ['crear_revision.post', $solicitud->id], 'method' => 'post', 'autocomplete' => 'off']) }}
						<div class="form-group">
							{{ Form::label('observacion', 'Observación', ['class' => 'label-required']) }}
							{{ Form::textarea('observacion', null, ['required', 'rows' => 2, 'class' => 'form-control']) }}
						</div>
						@php($revisiones = $solicitud->revisionesInspector($solicitud->id)['data'])
						@php($revisionesFinale = $solicitud->revisionesInspector($solicitud->id, null, ['P'])['data'])
						@if($revisiones->count() == 0 || ($revisionesFinale->count() > 0 && $revisionesFinale->first()->modo < 3) || (Auth::user()->perfil != 'J' && $revisionesFinale->count() == 0))
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
						No se puede realizar una observación en la solicitud
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
							@unlessrole('guest')
								<th></th>
							@endunlessrole
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
									@unlessrole('guest')
										<td>
											@if($revision->inspector_id == Auth::user()->id && $solicitud->estado == 'P')
												<a href="{{ route('editar_revision', ['solicitud' => $revision->solicitud_id, 'revision' => $revision->id]) }}" class="btn btn-warning open-modal">Editar</a>
											@endif
										</td>
									@endunlessrole
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