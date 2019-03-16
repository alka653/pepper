@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
	<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
	<div class="container" style="margin-bottom: 100px">
		<h2>
			Realiza un seguimiento
			<small>
				<a href="{{ route('detalle_ataque', ['ataque' => $ataque->id]) }}" class="btn btn-sm btn-info">Ver detalle</a>
				<a href="{{ route('crear_seguimiento_ataque', ['ataque' => $ataque->id]) }}" class="btn btn-sm btn-success open-modal">Realizar seguimiento</a>
			</small>
		</h2>
		<div class="block" style="margin-top: 10px; padding: 0">
			<div class="block-title p-2">
				Datos básicos del ataque
			</div>
			<div class="p-2">
				<div class="row align-items-center">
					<div class="col-md-5">
						<p class="no-margin">
							<b>Nombres y apellidos del paciente</b>
						</p>
						<p class="no-margin">{{ $ataque->victima->nombre.' '.$ataque->victima->apellido }}</p>
					</div>
					<div class="col-md-5">
						<p class="no-margin">
							<b>Nombres y apellidos del propietario del atacante</b>
						</p>
						<p class="no-margin">{{ $ataque->mascota->propietario->nombre }} {{ $ataque->mascota->propietario->apellido }}</p>
					</div>
					<div class="col-md-2">
						<p class="no-margin">
							<b>Fecha del ataque</b>
						</p>
						<p class="no-margin">
							{{ date('d/m/Y', strtotime($ataque->fecha_ataque)) }}
						</p>
					</div>
				</div>
			</div>
		</div>
		@forelse($ataque->seguimientos as $seguimiento)
			<div class="block">
				{!! $seguimiento->descripcion !!}
				<small class="pull-right">
					<span class="badge badge-light">{{ $seguimiento->fecha }}</span>
					<span class="badge badge-dark">{{ $seguimiento->getTipo($seguimiento->tipo) }}</span>
					@if(Auth::user()->perfil == 'Z')
						<a href="{{ route('editar_seguimiento_ataque', ['ataque' => $ataque->id, 'seguimmiento' => $seguimiento->id]) }}" class="btn btn-sm btn-warning open-modal">Editar</a>
					@endif
				</small>
			</div>
		@empty
			<div class="text-center">
				<h5>Aun no han realizado el seguimiento al ataque registrado. Da <a href="{{ route('crear_seguimiento_ataque', ['ataque' => $ataque->id]) }}" class="open-modal">clic aquí</a> para empezar el seguimiento.</h5>
			</div>
		@endforelse
	</div>
@endsection

@section('script')
	<script defer async src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
@endsection