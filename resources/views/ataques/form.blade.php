@extends('layouts.app')

@section('style')
	<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{ mix('/css/smart_wizard.css') }}">
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container" style="margin-bottom: 100px;">
		<h2>{{ $title }}</h2>
		<small>La ficha de notificación es para fines de vigilancia en salud pública y todas las entidades que pertenecen en el proceso deben garantizar la confidencialidad de la información. Ley 1273/09 y 1266/09.</small>
		{{ Form::model($ataque, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off', 'id' => 'form-wizard']) }}
			<ul>
				<li>
					<a href="#step-1">
						Paso 1 <br/>
						<small>Datos iniciales del ataque</small>
					</a>
				</li>
				<li>
					<a href="#step-2">
						Paso 2 <br/>
						<small>Datos básicos del paciente</small>
					</a>
				</li>
				<li>
					<a href="#step-3">
						Paso 3 <br/>
						<small>Datos de la agresión o contácto</small>
					</a>
				</li>
				<li>
					<a href="#step-4">
						Paso 4 <br/>
						<small>Tratamiento del paciente</small>
					</a>
				</li>
				<li>
					<a href="#step-5">
						Paso 5 <br/>
						<small>Datos del atacante</small>
					</a>
				</li>
			</ul>
			<div>
				<div id="step-1">
					<div id="form-step-0" role="form" data-toggle="validator">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque[fecha_ataque]', 'Fecha del ataque', ['class' => 'label-required']) }}
									{{ Form::text('ataque[fecha_ataque]', null, ['required', 'class' => 'form-control fecha_ataque', 'data-error' => 'Ingresa la fecha del ataque']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque[departamento_ataque_id]', 'Departamento del ataque', ['class' => 'label-required']) }}
									{{ Form::select('ataque[departamento_ataque_id]', $departamentoLista, null, ['required', 'class' => 'form-control select2 departamento_change', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque[municipio_ataque_id]', 'Municipio del ataque', ['class' => 'label-required']) }}
									{{ Form::select('ataque[municipio_ataque_id]', [], null, ['required', 'class' => 'form-control select2', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group row">
									<div class="col-12">
										{{ Form::label('ataque[descripcion]', 'Descripción del ataque', ['class' => 'label-required']) }}
									</div>
									<div class="col-12">
										{{ Form::textarea('ataque[descripcion]', null, ['required', 'rows' => '3', 'data-error' => 'Ingresa una breve descripción', 'style' => 'width: 100%;']) }}
										<div class="help-block with-errors"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="step-2">
					<div id="form-step-1" role="form" data-toggle="validator">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('victima[nombre]', 'Nombres del paciente', ['class' => 'label-required']) }}
									{{ Form::text('victima[nombre]', null, ['required', 'class' => 'form-control', 'data-error' => 'Ingresa el nombre del paciente']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('victima[apellido]', 'Apellidos del paciente', ['class' => 'label-required']) }}
									{{ Form::text('victima[apellido]', null, ['required', 'class' => 'form-control', 'data-error' => 'Ingresa el apellido del paciente']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('victima[tipo_documento]', 'Tipo de documento', ['class' => 'label-required']) }}
									{{ Form::select('victima[tipo_documento]', [
										'' => 'Seleccione una opción',
										'RC' => 'Registro civil',
										'TI' => 'Tarjeta de identidad',
										'CC' => 'Cédula de ciudadanía',
										'CE' => 'Cédula extranjera',
										'PS' => 'Pasaporte',
										'MS' => 'Menor sin identificación',
										'AS' => 'Adulto sin identificación'
									], null, ['required', 'class' => 'form-control', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('victima[numero_documento]', 'Número del documento', ['class' => 'label-required']) }}
									{{ Form::text('victima[numero_documento]', null, ['required', 'class' => 'form-control only-number', 'data-error' => 'Ingresa el número de documento']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('victima[numero_celular]', 'Número celular') }}
									{{ Form::text('victima[numero_celular]', null, ['class' => 'form-control only-number']) }}
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('victima[sexo]', 'Sexo', ['class' => 'label-required']) }}
									{{ Form::select('victima[sexo]', [
										'' => 'Seleccione una opción',
										'M' => 'Masculino',
										'F' => 'Femenino'
									], null, ['required', 'class' => 'form-control select2']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('victima[direccion_residencia]', 'Dirección de residencia', ['class' => 'label-required']) }}
									{{ Form::text('victima[direccion_residencia]', null, ['required', 'class' => 'form-control', 'data-error' => 'Ingresa la dirección de la residencia']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('victima[departamento_residencia_id]', 'Departamento residencia', ['class' => 'label-required']) }}
									{{ Form::select('victima[departamento_residencia_id]', $departamentoLista, null, ['required', 'class' => 'form-control select2 departamento_change', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('victima[municipio_residencia_id]', 'Municipio residencia', ['class' => 'label-required']) }}
									{{ Form::select('victima[municipio_residencia_id]', [], null, ['required', 'class' => 'form-control select2', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="step-3">
					<div id="form-step-2" role="form" data-toggle="validator">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									{{ Form::label('ataque[tipo_agresion_id]', 'Tipo de agresión', ['class' => 'label-required']) }}
									{{ Form::select('ataque[tipo_agresion_id]', $tipoAgresionLista, null, ['required', 'class' => 'form-control tipo_agresion_id', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6 hidden">
								<div class="form-group">
									{{ Form::label('ataque[ataque_mordedura]', 'Seleccione el área del ataque', ['class' => 'label-required']) }}
									{{ Form::select('ataque[ataque_mordedura]', [
										'' => 'Seleccione una opción',
										'C' => 'En área cubierta del cuerpo',
										'D' => 'En área descubierta del cuerpo'
									], null, ['required', 'class' => 'form-control ataque_mordedura', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque[agresion_provocada]', '¿La agresión fue provocada?', ['class' => 'label-required']) }}
									{{ Form::select('ataque[agresion_provocada]', [
										'' => 'Seleccione una opción',
										'S' => 'Si',
										'N' => 'No'
									], null, ['class' => 'form-control', 'required', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque[tipo_lesion]', 'Tipo de lesión', ['class' => 'label-required']) }}
									{{ Form::select('ataque[tipo_lesion]', [
										'' => 'Seleccione una opción',
										'U' => 'Única',
										'M' => 'Múltiple'
									], null, ['class' => 'form-control', 'required', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque[profundidad]', 'Profundidad de la lesión', ['class' => 'label-required']) }}
									{{ Form::select('ataque[profundidad]', [
										'' => 'Seleccione una opción',
										'S' => 'Superficial',
										'P' => 'Profunda'
									], null, ['class' => 'form-control', 'required', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-12">
								<b class="label-required">Localización anatómica de la lesión (Seleccione más de una opción en caso de ser necesario</b>
								<div style="margin-left: 10px;">
									@foreach($localizacionAnatomicaLista as $localizacion_anatomica)
										<div class="custom-control custom-checkbox">
											{{ Form::checkbox('localizacion_anatomica[]', $localizacion_anatomica->id, false, ['class' => 'custom-control-input', 'id' => 'localizacion_anatomica'.$localizacion_anatomica->id]) }}
											{{ Form::label('localizacion_anatomica'.$localizacion_anatomica->id, $localizacion_anatomica->nombre, ['class' => 'custom-control-label']) }}
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="step-4">
					<div id="form-step-3" role="form" data-toggle="validator">
						<h5 style="margin-bottom: 2px;">
							Antecedentes de inmunización del paciente
						</h5>
						<p style="margin-bottom: 10px;">
							<b>Antes de la consulta actual, el paciente había recibido</b>
						</p>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_victima[suero_antirrabico]', 'Suero antirrábico', ['class' => 'label-required']) }}
									{{ Form::select('ataque_victima[suero_antirrabico]', [
										'' => 'Selecciona una opción',
										'S' => 'Si',
										'N' => 'No',
										'D' => 'No sabe'
									], null, ['required', 'class' => 'form-control suero_antirrabico', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6 hidden">
								<div class="form-group">
									{{ Form::label('ataque_victima[fecha_aplicacion_suero]', 'Fecha de aplicación del suero', ['class' => 'label-required']) }}
									{{ Form::text('ataque_victima[fecha_aplicacion_suero]', null, ['class' => 'form-control fecha_aplicacion_suero', 'data-error' => 'Ingresa la fecha de aplicación del suero']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_victima[vacuna_antirrabica]', 'Vacuna antirrábica', ['class' => 'label-required']) }}
									{{ Form::select('ataque_victima[vacuna_antirrabica]', [
										'' => 'Selecciona una opción',
										'S' => 'Si',
										'N' => 'No',
										'D' => 'No sabe'
									], null, ['required', 'class' => 'form-control vacuna_antirrabica', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6 hidden">
								<div class="form-group">
									{{ Form::label('ataque_victima[numero_dosis]', 'Número de dosis', ['class' => 'label-required']) }}
									{{ Form::text('ataque_victima[numero_dosis]', null, ['class' => 'form-control only-number numero_dosis', 'data-error' => 'Ingresa el número de dosis']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6 hidden">
								<div class="form-group">
									{{ Form::label('ataque_victima[fecha_ultima_dosis]', 'Fecha de última dosis', ['class' => 'label-required']) }}
									{{ Form::text('ataque_victima[fecha_ultima_dosis]', null, ['class' => 'form-control fecha_ultima_dosis', 'data-error' => 'Ingresa la fecha de la última dosis']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
						<h5>
							Datos del tratamiento ordenado en la actualidad
						</h5>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_victima[lavado_herida]', '¿Lavado de herida con agua y jabón?', ['class' => 'label-required']) }}
									{{ Form::select('ataque_victima[lavado_herida]', [
										'' => 'Selecciona una opción',
										'S' => 'Si',
										'N' => 'No'
									], null, ['required', 'class' => 'form-control', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_victima[sutura_herida]', '¿Sutura de la herida?', ['class' => 'label-required']) }}
									{{ Form::select('ataque_victima[sutura_herida]', [
										'' => 'Selecciona una opción',
										'S' => 'Si',
										'N' => 'No'
									], null, ['required', 'class' => 'form-control', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_victima[orden_suero]', '¿Ordenó suero antirrábico?', ['class' => 'label-required']) }}
									{{ Form::select('ataque_victima[orden_suero]', [
										'' => 'Selecciona una opción',
										'S' => 'Si',
										'N' => 'No'
									], null, ['required', 'class' => 'form-control', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_victima[orden_aplicacion_vacuna]', '¿Ordenó aplicación de vacuna?', ['class' => 'label-required']) }}
									{{ Form::select('ataque_victima[orden_aplicacion_vacuna]', [
										'' => 'Selecciona una opción',
										'S' => 'Si',
										'N' => 'No'
									], null, ['required', 'class' => 'form-control', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="step-5">
					<h5>Datos del propietario o responsable del agresor</h5>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('propietario[nombre]', 'Nombre del propietario') }}
								{{ Form::text('propietario[nombre]', null, ['class' => 'form-control dato-propietario']) }}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('propietario[apellido]', 'Apellido del propietario') }}
								{{ Form::text('propietario[apellido]', null, ['class' => 'form-control dato-propietario']) }}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('propietario[tipo_documento]', 'Tipo de documento') }}
								{{ Form::select('propietario[tipo_documento]', [
									'' => 'Seleccione una opción',
									'TI' => 'Tarjeta de identidad',
									'CC' => 'Cédula de ciudadanía',
									'CE' => 'Cédula extranjera',
									'PS' => 'Pasaporte'
								], null, ['class' => 'form-control']) }}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('propietario[numero_documento]', 'Número del documento del propietario') }}
								{{ Form::text('propietario[numero_documento]', null, ['class' => 'form-control dato-propietario numero_documento_propietario only-number']) }}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('propietario[direccion_residencia]', 'Dirección de residencia') }}
								{{ Form::text('propietario[direccion_residencia]', null, ['class' => 'form-control dato-propietario']) }}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('propietario[departamento_residencia_id]', 'Departamento residencia') }}
								{{ Form::select('propietario[departamento_residencia_id]', $departamentoLista, null, ['class' => 'form-control dato-propietario select2 departamento_change']) }}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('propietario[municipio_residencia_id]', 'Municipio residencia') }}
								{{ Form::select('propietario[municipio_residencia_id]', [], null, ['class' => 'form-control dato-propietario select2']) }}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('propietario[numero_celular]', 'Número celular') }}
								{{ Form::text('propietario[numero_celular]', null, ['class' => 'form-control only-number dato-propietario']) }}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('propietario[sexo]', 'Sexo', ['class' => 'label-required']) }}
								{{ Form::select('propietario[sexo]', [
									'' => 'Seleccione una opción',
									'M' => 'Masculino',
									'F' => 'Femenino'
								], null, ['required', 'class' => 'form-control select2 dato-propietario']) }}
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<h5>Datos sobre la especie agresora</h5>
					<div id="form-step-4" role="form" data-toggle="validator">
						<div class="row">
							<div class="col-md-6 hidden">
								<div class="form-group">
									{{ Form::label('ataque_animal[mascota_id]', 'Mascota', ['class' => 'label-required']) }}
									{{ Form::select('ataque_animal[mascota_id]', [], null, ['required', 'class' => 'form-control mascota_id', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_animal[nombre_especie]', 'Nombre de la especie agresora', ['class' => 'label-required']) }}
									{{ Form::text('ataque_animal[nombre_especie]', null, ['required', 'class' => 'form-control nombre_especie', 'data-error' => 'Ingresa el nombre de la especie']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_animal[raza_id]', 'Raza', ['class' => 'label-required']) }}
									{{ Form::select('ataque_animal[raza_id]', $razaLista, null, ['required', 'class' => 'form-control select2 raza_id', 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_animal[animal_vacunado]', 'Animal vacunado', ['class' => 'label-required']) }}
									{{ Form::select('ataque_animal[animal_vacunado]', [
										'' => 'Seleccione una opción',
										'S' => 'Si',
										'N' => 'No',
										'D' => 'Desconocido'
									], null, ['required', 'class' => 'form-control animal_vacunado', 'data-error' => 'Selecciona un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6 hidden">
								<div class="form-group">
									{{ Form::label('ataque_animal[carnet_vacunacion]', '¿Presentó carnet de vacunación antirrábica?', ['class' => 'label-required']) }}
									{{ Form::select('ataque_animal[carnet_vacunacion]', [
										'' => 'Seleccione una opción',
										'S' => 'Si',
										'N' => 'No'
									], null, ['class' => 'form-control carnet_vacunacion', 'data-error' => 'Seleccione un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6 hidden">
								<div class="form-group">
									{{ Form::label('ataque_animal[fecha_vacunacion]', 'Fecha de vacunación') }}
									{{ Form::text('ataque_animal[fecha_vacunacion]', null, ['class' => 'form-control fecha_vacunacion']) }}
								</div>
							</div>
						</div>
						<h5>Datos del estado del atacante</h5>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_animal[estado_animal_ataque]', 'Estado del animal al momento de la agresión o contacto', ['class' => 'label-required']) }}
									{{ Form::select('ataque_animal[estado_animal_ataque]', [
										'' => 'Seleccione una opción',
										'CS' => 'Con signos de rabia',
										'SS' => 'Sin signos de rabia',
										'D' => 'Desconocido'
									], null, ['required', 'class' => 'form-control', 'data-error' => 'Seleccione un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_animal[estado_animal_consulta]', 'Estado del animal al momento de la consulta', ['class' => 'label-required']) }}
									{{ Form::select('ataque_animal[estado_animal_consulta]', [
										'' => 'Seleccione una opción',
										'V' => 'Vivo',
										'M' => 'Muerto',
										'D' => 'Desconocido'
									], null, ['required', 'class' => 'form-control', 'data-error' => 'Seleccione un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_animal[ubicacion_animal_agresion]', 'Ubicación del animal agresor', ['class' => 'label-required']) }}
									{{ Form::select('ataque_animal[ubicacion_animal_agresion]', [
										'' => 'Seleccione una opción',
										'O' => 'Observable',
										'P' => 'Perdido'
									], null, ['required', 'class' => 'form-control', 'data-error' => 'Seleccione un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('ataque_animal[tipo_exposicion]', 'Tipo de exposición', ['class' => 'label-required']) }}
									{{ Form::select('ataque_animal[tipo_exposicion]', [
										'' => 'Seleccione una opción',
										'N' => 'No exposición',
										'EL' => 'Exposición leve',
										'EG' => 'Exposición grave'
									], null, ['required', 'class' => 'form-control', 'data-error' => 'Seleccione un elemento de la lista']) }}
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection

@section('script')
	<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
	<script src="{{ mix('/js/jquery.smartWizard.js') }}"></script>
	<script>
		const lastStep = 4
		$('.fecha_ataque').datepicker({
			uiLibrary: 'bootstrap4'
		})
		$('.fecha_aplicacion_suero').datepicker({
			uiLibrary: 'bootstrap4'
		})
		$('.fecha_ultima_dosis').datepicker({
			uiLibrary: 'bootstrap4'
		})
		$('.fecha_vacunacion').datepicker({
			uiLibrary: 'bootstrap4'
		})
		$(document).on('change', '.tipo_agresion_id', function(){
			let ataque_mordedura = $('.ataque_mordedura')
			if($(this).val() == '1'){
				ataque_mordedura.attr('required', true)
				ataque_mordedura.parent().parent().removeClass('hidden')
			}else{
				ataque_mordedura.removeAttr('required')
				ataque_mordedura.parent().parent().addClass('hidden')
			}
		})
		$(document).on('focusout', '.numero_documento_propietario', function(){
			if($(this).val() != ''){
				$.get(`{{ route('datos_propietario') }}?propietario_numero_documento=${$(this).val()}`, function(response){
					const data = response.data
					if(data != null){
						$('[name="propietario[nombre]"]').val(data.nombre)
						$('[name="propietario[apellido]"]').val(data.apellido)
						$('[name="propietario[tipo_documento]"]').val(data.tipo_documento).trigger('change')
						$('[name="propietario[direccion_residencia]"]').val(data.direccion_residencia).trigger('change')
						$('[name="propietario[municipio_residencia_id]"]').attr('data-id', data.municipio_residencia_id)
						$('[name="propietario[numero_celular]"]').val(data.numero_celular)
						$('[name="propietario[sexo]"]').val(data.sexo).trigger('change')
						$('[name="propietario[departamento_residencia_id]"]').val(data.municipio_residencia.departamento_id).attr('data-id', data.municipio_residencia.departamento_id).trigger('change')
						$('.mascota_id').empty().append('<option value="">Seleccione una opción</option>').parent().parent().removeClass('hidden')
						if(Object.keys(data.mascotas).length > 0){
							$.each(data.mascotas, function(key, mascota){
								$('.mascota_id').append(`
									<option value="${mascota['id']}">${mascota['nombre']}</option>
								`)
							})
						}
					}else{
						$('.mascota_id').removeAttr('required').empty().append('<option val="">Seleccione una opción</option>').parent().parent().addClass('hidden')
						$('[name="propietario[nombre]"]').val('')
						$('[name="propietario[apellido]"]').val('')
						$('[name="propietario[tipo_documento]"]').val('').trigger('change')
						$('[name="propietario[direccion_residencia]"]').val('').trigger('change')
						$('.raza_id').attr('required', true).parent().parent().removeClass('hidden')
						$('.nombre_especie').attr('required', true).parent().parent().removeClass('hidden')
					}
				})
			}
		})
		$(document).on('change', '.mascota_id', function(){
			if($(this).val() != ''){
				$(this).attr('required', true)
				$('.raza_id').removeAttr('required').parent().parent().addClass('hidden')
				$('.nombre_especie').removeAttr('required').parent().parent().addClass('hidden')
			}else{
				$(this).removeAttr('required')
				$('.raza_id').attr('required', true).parent().parent().removeClass('hidden')
				$('.nombre_especie').attr('required', true).parent().parent().removeClass('hidden')
			}
		})
		$(document).on('change', '.animal_vacunado', function(){
			let fecha_vacunacion = $('.fecha_vacunacion')
			let carnet_vacunacion = $('.carnet_vacunacion')
			if($(this).val() == 'S'){
				fecha_vacunacion.attr('required', true)
				carnet_vacunacion.attr('required', true)
				fecha_vacunacion.parent().parent().parent().removeClass('hidden')
				carnet_vacunacion.parent().parent().removeClass('hidden')
			}else{
				fecha_vacunacion.removeAttr('required')
				carnet_vacunacion.removeAttr('required')
				fecha_vacunacion.parent().parent().parent().addClass('hidden')
				carnet_vacunacion.parent().parent().addClass('hidden')
			}
		})
		$(document).on('change', '.vacuna_antirrabica', function(){
			let numero_dosis = $('.numero_dosis')
			let fecha_ultima_dosis = $('.fecha_ultima_dosis')
			if($(this).val() == 'S'){
				numero_dosis.attr('required', true)
				fecha_ultima_dosis.attr('required', true)
				numero_dosis.parent().parent().removeClass('hidden')
				fecha_ultima_dosis.parent().parent().parent().removeClass('hidden')
			}else{
				numero_dosis.removeAttr('required')
				fecha_ultima_dosis.removeAttr('required')
				numero_dosis.parent().parent().addClass('hidden')
				fecha_ultima_dosis.parent().parent().parent().addClass('hidden')
			}
		})
		$(document).on('change', '.suero_antirrabico', function(){
			let fecha_aplicacion_suero = $('.fecha_aplicacion_suero')
			if($(this).val() == 'S'){
				fecha_aplicacion_suero.attr('required', true)
				fecha_aplicacion_suero.parent().parent().parent().removeClass('hidden')
			}else{
				fecha_aplicacion_suero.removeAttr('required')
				fecha_aplicacion_suero.parent().parent().parent().addClass('hidden')
			}
		})
		$(document).ready(function(){
			$('#form-wizard').smartWizard({
				keyNavigation: false,
				useURLhash: false,
				showStepURLhash: false,
				lang: {
					next: 'Siguiente',
					previous: 'Anterior'
				},
				toolbarSettings: {
					toolbarExtraButtons: [
						$('<button></button>').text('Enviar datos')
						.addClass('btn btn-success hidden btn-finish')
					]
				}
			})
		})
		$('#form-wizard').submit(function(event){
			let elmForm = $('#form-step-4')
			elmForm.validator('validate')
			let elmErr = elmForm.find('.list-unstyled')
			if(elmErr != null && elmErr.length > 0){
				event.preventDefault()
			}
		})
		$('#form-wizard').on('leaveStep', function(e, anchorObject, stepNumber, stepDirection){
			let elmForm = $(`#form-step-${stepNumber}`)
			if(stepDirection == 'forward' && elmForm != null){
				elmForm.validator('validate')
				let elmErr = elmForm.find('.list-unstyled')
				if(elmErr != null && elmErr.length > 0){
					return false
				}
			}
			return true
		})
		$('#form-wizard').on('showStep', function(e, anchorObject, stepNumber, stepDirection){
			if(stepNumber == lastStep){
				$('.btn-finish').removeClass('hidden')
			}else{
				$('.btn-finish').addClass('hidden')
			}
		})
	</script>
@endsection