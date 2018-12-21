@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container" style="margin-bottom: 100px">
		<div class="text-center">
			<h2 class="no-margin">Subsistema de información SIVIGILA</h2>
			<h3 class="no-margin">Sistema Nacional de Vigilancia en Salud Pública</h3>
			<h4>Ficha de notificación</h4>
			<h5 class="no-margin">
				Agresiones por animales potencialmente transmisores de rabia. Código INS: 300
			</h5>
			<small>La ficha de notificación es para fines de vigilancia en salud pública y todas las entidades que pertenecen en el proceso deben garantizar la confidencialidad de la información. Ley 1273/09 y 1266/09.</small>
		</div>
		<div class="block" style="margin-top: 10px; padding: 0">
			<div class="block-title p-2">
				Relación con datos básicos
			</div>
			<div class="p-2">
				<div class="row align-items-center">
					<div class="col-12 col-md-5">
						<p class="no-margin">
							<b>Nombres y apellidos del paciente</b>
						</p>
						<p class="no-margin">{{ $ataque->victima->nombre.' '.$ataque->victima->apellido }}</p>
					</div>
					<div class="col-5 col-md-3">
						<p class="no-margin">
							<b>Tipo de ID</b>
						</p>
						<p class="no-margin">{{ $ataque->victima->getTipoDocumento($ataque->victima->tipo_documento) }}</p>
					</div>
					<div class="col-7 col-md-4">
						<p class="no-margin">
							<b>Número de identificación</b>
						</p>
						<p class="no-margin">{{ number_format($ataque->victima->numero_documento) }}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="block" style="margin-top: 10px; padding: 0">
			<div class="block-title p-2">
				Datos de la agresión o contácto, de la especie agresora y de la clasificación de la esposición
			</div>
			<div class="p-2">
				<div class="row align-items-center">
					<div class="col-md-6">
						<p class="no-margin">
							<b>Tipo de agresión o contácto</b>
						</p>
						<p class="no-margin">{{ $ataque->tipoAgresion->nombre }}</p>
					</div>
					<div class="col-md-6">
						@if($ataque->tipo_ataque_id == 1)
							<p class="no-margin">
								<b>Modo de mordedura</b>
							</p>
							<p class="no-margin">{{ $ataque->modoMordedura($ataque->ataque_mordedura) }}</p>
						@endif
					</div>
				</div>
			</div>
			<hr/>
			<div class="p-2">
				<div class="row align-items-center">
					<div class="col-6 col-md-4">
						<p class="no-margin">
							<b>¿Agresión provocada?</b>
						</p>
						<p class="no-margin">{{ $ataque->agresionProvocada($ataque->agresion_provocada) }}</p>
					</div>
					<div class="col-6 col-md-4">
						<p class="no-margin">
							<b>Tipo de lesión</b>
						</p>
						<p class="no-margin">{{ $ataque->tipoLesion($ataque->tipo_lesion) }}</p>
					</div>
					<div class="col-6 col-md-4">
						<p class="no-margin">
							<b>Profundidad</b>
						</p>
						<p class="no-margin">{{ $ataque->profundidad($ataque->profundidad) }}</p>
					</div>
				</div>
			</div>
			<hr/>
			<div class="p-2">
				<p class="no-margin">
					<b>Localización anatómica de la lesión</b>
				</p>
				<div class="row align-items-center">
					@foreach($ataque->localizacionesAnatomicas as $localizacion)
						<p class="col-4 col-md-3 no-margin">{{ $localizacion->nombre }}</p>
					@endforeach
				</div>
			</div>
			<hr/>
			<div class="p-2">
				<div class="row align-items-center">
					<div class="col-6">
						<p class="no-margin">
							<b>Fecha de la agresión o contácto</b>
						</p>
						<p class="no-margin">{{ date('d/m/Y', strtotime($ataque->fecha_ataque)) }}</p>
					</div>
					<div class="col-6">
						<p class="no-margin">
							<b>Especie agresora</b>
						</p>
						<p class="no-margin">{{ $ataque->mascota->raza->getEspecie($ataque->mascota->raza->especie) }} - {{ $ataque->mascota->raza->nombre }}</p>
					</div>
				</div>
			</div>
			<hr/>
			<div class="p-2">
				<div class="row align-items-center">
					<div class="col-6 col-md-3">
						<p class="no-margin">
							<b>Animal vacunado</b>
						</p>
						<p class="no-margin">{{ $ataque->ataqueAnimal->animalVacunado($ataque->ataqueAnimal->animal_vacunado) }}</p>
					</div>
					<div class="col-6 col-md-5">
						<p class="no-margin">
							<b>¿Presentó carnét de vacunación antirrábica?</b>
						</p>
						<p class="no-margin">
							@if($ataque->ataqueAnimal->animal_vacunado == 'S')
								{{ $ataque->ataqueAnimal->carnetVacunacion($ataque->ataqueAnimal->carnet_vacunacion) }}
							@else
								-
							@endif
						</p>
					</div>
					<div class="col-6 col-md-4">
						<p class="no-margin">
							<b>Fecha de vacunación</b>
						</p>
						<p class="no-margin">
							@if($ataque->ataqueAnimal->animal_vacunado == 'S')
								{{ date('d/m/Y', strtotime($ataque->mascota->fecha_vacunacion)) }}
							@else
								-
							@endif
						</p>
					</div>
				</div>
			</div>
			<hr/>
			<div class="p-2">
				<div class="row align-items-center">
					<div class="col-6 col-md-5">
						<p class="no-margin">
							<b>Nombre del propietario o responsable del agresor</b>
						</p>
						<p class="no-margin">{{ $ataque->mascota->propietario->nombre }} {{ $ataque->mascota->propietario->apellido }}</p>
					</div>
					<div class="col-6 col-md-4">
						<p class="no-margin">
							<b>Dirección del propietario o responsable del agresor</b>
						</p>
						<p class="no-margin">{{ $ataque->mascota->propietario->direccion_residencia }}</p>
					</div>
					<div class="col-6 col-md-3">
						<p class="no-margin">
							<b>Teléfono</b>
						</p>
						<p class="no-margin">{{ $ataque->mascota->propietario->numero_celular }}</p>
					</div>
				</div>
			</div>
			<hr/>
			<div class="p-2">
				<div class="row align-items-center">
					<div class="col-6 col-md-3">
						<p class="no-margin">
							<b>Estado del animal al momento de la agresión o contácto</b>
						</p>
						<p class="no-margin">{{ $ataque->ataqueAnimal->estadoAnimalAtaque($ataque->ataqueAnimal->estado_animal_ataque) }}</p>
					</div>
					<div class="col-6 col-md-3">
						<p class="no-margin">
							<b>Estado del animal al momento de la consulta</b>
						</p>
						<p class="no-margin">{{ $ataque->ataqueAnimal->estadoAnimalConsulta($ataque->ataqueAnimal->estado_animal_consulta) }}</p>
					</div>
					<div class="col-6 col-md-3">
						<p class="no-margin">
							<b>Ubicación del animal agresor</b>
						</p>
						<p class="no-margin">{{ $ataque->ataqueAnimal->ubicacionAnimalAgresion($ataque->ataqueAnimal->ubicacion_animal_agresion) }}</p>
					</div>
					<div class="col-6 col-md-3">
						<p class="no-margin">
							<b>Tipo de exposición</b>
						</p>
						<p class="no-margin">{{ $ataque->ataqueAnimal->tipoExposicion($ataque->ataqueAnimal->tipo_exposicion) }}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="block" style="margin-top: 10px; padding: 0">
			<div class="block-title p-2">
				Antecedentes de inmunización del paciente
			</div>
			<div class="p-2">
				<div class="row align-items-center">
					<div class="col-6 col-md-4">
						<p class="no-margin">
							<b>Suero antirrábico</b>
						</p>
						<p class="no-margin">{{ $ataque->ataqueVictima->sueroAntirrabico($ataque->ataqueVictima->suero_antirrabico) }}</p>
					</div>
					<div class="col-6 col-md-4">
						<p class="no-margin">
							<b>Fecha de aplicación</b>
						</p>
						<p class="no-margin">
							@if($ataque->ataqueVictima->suero_antirrabico == 1)
								{{ $ataque->ataqueVictima->fecha_aplicacion_suero }}
							@else
								-
							@endif
						</p>
					</div>
					<div class="col-6 col-md-4">
						<p class="no-margin">
							<b>Vacuna antirrábica</b>
						</p>
						<p class="no-margin">
							@if($ataque->ataqueVictima->suero_antirrabico == 1)
								{{ $ataque->ataqueVictima->vacunaAntirrabica($ataque->ataqueVictima->vacuna_antirrabica) }}
							@else
								-
							@endif
						</p>
					</div>
				</div>
				@if($ataque->ataqueVictima->vacuna_antirrabica != null && $ataque->ataqueVictima->vacuna_antirrabica == 'S')
					<hr/>
					<div class="row align-items-center">
						<div class="col-6">
							<p class="no-margin">
								<b>Número de dosis</b>
							</p>
							<p class="no-margin">{{ $ataque->ataqueVictima->numero_dosis }}</p>
						</div>
						<div class="col-6">
							<p class="no-margin">
								<b>Fecha de última dosis</b>
							</p>
							<p class="no-margin">{{ date('d/m/Y', strtotime($ataque->ataqueVictima->fecha_ultima_dosis)) }}</p>
						</div>
					</div>
				@endif
			</div>
		</div>
		<div class="block" style="margin-top: 10px; padding: 0">
			<div class="block-title p-2">
				Datos del tratamiento ordenado en la actualidad
			</div>
			<div class="p-2">
				<div class="row align-items-center">
					<div class="col-6 col-md-3">
						<p class="no-margin">
							<b>¿Lavado de herida con agua y jabón?</b>
						</p>
						<p class="no-margin">
							{{ $ataque->ataqueVictima->lavadoHerida($ataque->ataqueVictima->lavado_herida) }}
						</p>
					</div>
					<div class="col-6 col-md-3">
						<p class="no-margin">
							<b>¿Sutura de la herida?</b>
						</p>
						<p class="no-margin">
							{{ $ataque->ataqueVictima->suturaHerida($ataque->ataqueVictima->sutura_herida) }}
						</p>
					</div>
					<div class="col-6 col-md-3">
						<p class="no-margin">
							<b>¿Ordenó suero antirrábico?</b>
						</p>
						<p class="no-margin">
							{{ $ataque->ataqueVictima->ordenSuero($ataque->ataqueVictima->orden_suero) }}
						</p>
					</div>
					<div class="col-6 col-md-3">
						<p class="no-margin">
							<b>¿Ordenó aplicación vacuna?</b>
						</p>
						<p class="no-margin">
							{{ $ataque->ataqueVictima->ordenAplicacionVacuna($ataque->ataqueVictima->orden_aplicacion_vacuna) }}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection