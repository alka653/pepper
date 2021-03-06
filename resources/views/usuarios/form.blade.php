@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container" style="margin-top: 10px; padding-bottom: 30px;">
		<h2>{{ $title }}</h2>
		<div class="block">
			{{ Form::model($persona, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
				<div class="row">
					<div class="col-md-6 form-group">
						{{ Form::label('nombre', 'Nombre', ['class' => 'label-required']) }}
						{{ Form::text('nombre', null, ['required', 'class' => 'form-control only-char']) }}
						{!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('apellido', 'Apellido', ['class' => 'label-required']) }}
						{{ Form::text('apellido', null, ['required', 'class' => 'form-control only-char']) }}
						{!! $errors->first('apellido', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('tipo_documento', 'Tipo de documento', ['class' => 'label-required']) }}
						{{ Form::select('tipo_documento', [
							'' => 'Seleccione una opción',
							'TI' => 'Tarjeta de identidad',
							'CC' => 'Cédula de ciudadanía',
							'CE' => 'Cédula extranjera',
							'PS' => 'Pasaporte'
						], null, ['required', 'class' => 'form-control']) }}
						{!! $errors->first('tipo_documento', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('numero_documento', 'Número del documento', ['class' => 'label-required']) }}
						{{ Form::text('numero_documento', null, ['required', 'class' => 'form-control only-number']) }}
						{!! $errors->first('numero_documento', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('departamento_expedicion_id', 'Departamento expedición documento', ['class' => 'label-required']) }}
						{{ Form::select('departamento_expedicion_id', $departamentoLista, null, ['required', 'class' => 'form-control select2 departamento_change'] + ($persona->toArray() ? ['data-id' => $persona->municipio_expedicion->departamento_id] : [])) }}
						{!! $errors->first('departamento_expedicion_id', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('municipio_expedicion_id', 'Municipio expedición documento', ['class' => 'label-required']) }}
						{{ Form::select('municipio_expedicion_id', [], null, ['required', 'class' => 'form-control select2'] + ($persona->toArray() ? ['data-id' => $persona->municipio_expedicion_id] : [])) }}
						{!! $errors->first('municipio_expedicion_id', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('direccion_residencia', 'Dirección de residencia', ['class' => 'label-required']) }}
						{{ Form::text('direccion_residencia', null, ['required', 'class' => 'form-control']) }}
						{!! $errors->first('direccion_residencia', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('departamento_residencia_id', 'Departamento residencia', ['class' => 'label-required']) }}
						{{ Form::select('departamento_residencia_id', $departamentoLista, null, ['required', 'class' => 'form-control select2 departamento_change'] + ($persona->toArray() ? ['data-id' => $persona->municipio_residencia->departamento_id] : [])) }}
						{!! $errors->first('departamento_residencia_id', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('municipio_residencia_id', 'Municipio residencia', ['class' => 'label-required']) }}
						{{ Form::select('municipio_residencia_id', [], null, ['required', 'class' => 'form-control select2'] + ($persona->toArray() ? ['data-id' => $persona->municipio_residencia_id] : [])) }}
						{!! $errors->first('municipio_residencia_id', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('sexo', 'Género', ['class' => 'label-required']) }}
						{{ Form::select('sexo', [
							'' => 'Seleccione una opción',
							'M' => 'Masculino',
							'F' => 'Femenino'
						], null, ['required', 'class' => 'form-control select2']) }}
						{!! $errors->first('sexo', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('numero_celular', 'Número celular', ['class' => 'label-required']) }}
						{{ Form::text('numero_celular', null, ['required', 'class' => 'form-control only-number']) }}
						{!! $errors->first('numero_celular', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('numero_telefonico', 'Número telefónico') }}
						{{ Form::text('numero_telefonico', null, ['class' => 'form-control only-number']) }}
						{!! $errors->first('numero_telefonico', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('ocupacion', 'Ocupación', ['class' => 'label-required']) }}
						{{ Form::select('ocupacion', $ocupacionLista, null, ['required', 'class' => 'form-control select2']) }}
						{!! $errors->first('ocupacion', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-md-6 form-group hidden" id="ocupacion_otro_div">
						{{ Form::label('ocupacion_otro', 'Digite la ocupación') }}
						{{ Form::text('ocupacion_otro', null, ['class' => 'form-control only-char']) }}
						{!! $errors->first('ocupacion_otro', '<p class="help-block">:message</p>') !!}
					</div>
					@can('modulo_usuarios')
						<div class="col-md-6 form-group">
							{{ Form::label('perfil', 'Perfil', ['class' => 'label-required']) }}
							{{ Form::select('perfil', [
								'' => 'Seleccione una opción',
								'U' => 'Propietario',
								'Z' => 'Zootecnico',
								'C' => 'Coordinador',
								'J' => 'Jefe'
							], $usuario->perfil, ['required', 'class' => 'form-control select2']) }}
						</div>
					@endcan
					<div class="col-md-6 form-group">
						<label>Foto</label>
						@if($persona->toArray())
							<img src="{{ $persona->foto }}" alt="{{ $persona->nombre }}" class="img-fluid rounded" width="100">
						@else
							<img class="hide" style="width: 180px; height: 150px;">
						@endif
						<div class="custom-file">
							{{ Form::file('foto', ['class' => 'custom-file-input', 'accept' => 'image/*', 'onchange' => 'readURL(this)', 'data-id' => 1]) }}
							{{ Form::label('foto', 'Foto (Formato img, máximo 10mb)', ['class' => 'custom-file-label']) }}
							{!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
					@if(!$persona->toArray())
						<div class="col-md-6 form-group">
							{{ Form::label('email', 'Correo electrónico', ['class' => 'label-required']) }}
							{{ Form::email('email', null, ['required', 'class' => 'form-control']) }}
							{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
						</div>
						<div class="col-md-6 form-group">
							{{ Form::label('username', 'Nombre de usuario', ['class' => 'label-required']) }}
							{{ Form::text('username', null, ['required', 'class' => 'form-control only-char']) }}
							{!! $errors->first('username', '<p class="help-block">:message</p>') !!}
						</div>
						<div class="col-md-6 form-group">
							{{ Form::label('password', 'Contraseña', ['class' => 'label-required']) }}
							<input type="password" name="password" id="password" class="form-control" />
							{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
						</div>
						<div class="col-md-6 form-group">
							{{ Form::label('password_confirmation', 'Confirmación de contraseña', ['class' => 'label-required']) }}
							<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
							{!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
						</div>
					@endif
					<div class="col-12 form-group text-center">
						{!! Form::button('Enviar datos', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection

@section('script')
	<script>
		const localStorage = window.localStorage
		@if($persona->toArray())
			$(document).ready(function(){
				$('#ocupacion_otro').val('{{ $persona->ocupacion }}')
				$('#ocupacion').trigger('change')
			})
		@endif
		$(document).on('submit', 'form', function(){
			localStorage.setItem('municipio_residencia_id', $('#municipio_residencia_id').val())
			localStorage.setItem('municipio_expedicion_id', $('#municipio_expedicion_id').val())
		})
		$(document).on('change', '#ocupacion', function(){
			if($(this).val() == 'Otro'){
				$('#ocupacion_otro_div').removeClass('hidden').find('input').attr('required', true)
			}else{
				$('#ocupacion_otro_div').addClass('hidden').find('input').removeAttr('required', true)
			}
		})
		$(document).ready(function(){
			if(localStorage.getItem('municipio_expedicion_id')){
				$('#municipio_expedicion_id').attr('data-id', localStorage.getItem('municipio_expedicion_id'))
			}
			if(localStorage.getItem('municipio_residencia_id')){
				$('#municipio_residencia_id').attr('data-id', localStorage.getItem('municipio_residencia_id'))
			}
			$('.departamento_change').each(function(){
				@if($persona->toArray())
					$(this).val($(this).attr('data-id')).trigger('change')
				@else
					if($(this).val() != ''){
						$(this).trigger('change')
					}
				@endif
			})
		})
		function readURL(input){
			if(input.files && input.files[0]){
				if(input.files[0].size <= 1000000){
					var reader = new FileReader()
					reader.onload = function(e){
						$(`[data-id="${input.getAttribute('data-id')}"]`).parent().parent().find('img').attr('src', e.target.result).removeClass('hide')
					}
					reader.readAsDataURL(input.files[0])
				}else{
					alert('La foto no puede superar los 10Mb')
				}
			}
		}
	</script>
@endsection