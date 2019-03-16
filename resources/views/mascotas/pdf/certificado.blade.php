@extends('layouts.app_pdf')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-repeat: no-repeat;
			background: url('{{ $escudoFondo }}');
		}
	</style>
@endsection

@section('content')
	@php($meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
	@php($fecha_certificado = strtotime($certificado->fecha_remitido))
	<p>Girardot, {{ date('d') }} de {{ $meses[date('n') - 1] }} de {{ date('Y') }}</p>
	<br />
	<h4 class="text-center">Certifico que:</h4>
	<br />
	<p>
		El señor {{ $mascota->propietario->nombre }} {{ $mascota->propietario->apellido }}, identificado con la C.C. {{ number_format($mascota->propietario->numero_documento) }} de {{ $mascota->propietario->lugar($mascota->propietario->municipio_expedicion_id) }} con domicilio ubicada en {{ $mascota->propietario->direccion_residencia }} y el teléfono número {{ $mascota->propietario->numero_celular }}, entregó el {{ date('d', $fecha_certificado) }} de {{ $meses[date('n', $fecha_certificado) - 1] }} de {{ date('Y', $fecha_certificado) }} a la Secretaría de Salud toda la documentación exigida para la tenencia responsable de Perros de Razas Potencialmente Peligrosas especificadas en el código de Policía Nacional.
	</p>
	<br />
	<br />
	<div>
		<div style="width: 50%; display: inline-block;">
			<p>
				<b>Características del canino</b>
			</p>
			<ul>
				<li>Raza: {{ $mascota->raza->nombre }}.</li>
				<li>Nombre: {{ $mascota->nombre }}.</li>
				<li>Edad: {{ $mascota->getEdad($mascota->fecha_nacimiento) }}</li>
				<li>Color: {{ $mascota->color }}.</li>
				<li>Carnet de vacunas vigente</li>
				<li>Acta de declaración Juramentada ante notaria, asumiendo responsabilidad ante cualquier daño ocasionado por el canino a humanos u otros animales.</li>
			</ul>
		</div>
		<div style="width: 50%; display: inline-block;" class="text-center">
			<small>
				<b>Foto del canino</b>
			</small>
			<br/>
			<img src="{{ $foto_canino }}" alt="{{ $mascota->nombre }}" width="180">
		</div>
	</div>
	<p style="margin-top: -150px;">Cordialmente,</p>
	<br/>
	<br/>
	<h4 class="text-center" style="margin-bottom: -5px;">MANUEL REINALDO DIAS GONZALEZ</h4>
	<h4 class="text-center">Secretario de Salud</h4>
@endsection
