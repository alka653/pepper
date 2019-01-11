@extends('layouts.app')

@section('style')
	<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<h2>{{ $title }}</h2>
		{{ Form::model($mascota, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
			<div class="row">
				<div class="col-12">
					<div class="block">
						<div class="row">
							@if(Auth::user()->perfil != 'U')
								<div class="col-md-6 form-group">
									{{ Form::label('propietario_id', 'Propietario', ['class' => 'label-required']) }}
									{{ Form::select('propietario_id', $propietarios, null, ['required', 'class' => 'form-control select2']) }}
								</div>
							@endif
							<div class="col-md-6 form-group">
								{{ Form::label('nombre', 'Nombre de la mascota', ['class' => 'label-required']) }}
								{{ Form::text('nombre', null, ['required', 'class' => 'form-control']) }}
								{!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
							</div>
							<div class="col-md-6 form-group">
								{{ Form::label('fecha_nacimiento', 'Fecha de nacimiento', ['class' => 'label-required']) }}
								{{ Form::text('fecha_nacimiento', null, ['required', 'class' => 'form-control date']) }}
								{!! $errors->first('fecha_nacimiento', '<p class="help-block">:message</p>') !!}
							</div>
							<div class="col-md-6 form-group">
								{{ Form::label('sexo', 'Sexo', ['class' => 'label-required']) }}
								{{ Form::select('sexo', [
									'' => 'Seleccione una opción',
									'M' => 'Macho',
									'F' => 'Hembra'
								], null, ['required', 'class' => 'form-control']) }}
								{!! $errors->first('sexo', '<p class="help-block">:message</p>') !!}
							</div>
							<div class="col-md-6 form-group">
								{{ Form::label('color', 'Color', ['class' => 'label-required']) }}
								{{ Form::text('color', null, ['required', 'class' => 'form-control']) }}
								{!! $errors->first('color', '<p class="help-block">:message</p>') !!}
							</div>
							<div class="col-md-6 form-group">
								{{ Form::label('vacunado', 'Vacunado', ['class' => 'label-required']) }}
								{{ Form::select('vacunado', [
									'' => 'Seleccione una opción',
									'0' => 'No',
									'1' => 'Si'
								], null, ['required', 'class' => 'form-control']) }}
							</div>
							<div class="col-md-6 form-group hidden" id="fecha_vacunacion_div">
								{{ Form::label('fecha_vacunacion', 'Fecha de vacunación', ['class' => 'label-required']) }}
								{{ Form::text('fecha_vacunacion', null, ['class' => 'form-control date']) }}
								{!! $errors->first('fecha_vacunacion', '<p class="help-block">:message</p>') !!}
							</div>
							<div class="col-md-6 form-group">
								{{ Form::label('raza_id', 'Raza', ['class' => 'label-required']) }}
								{{ Form::select('raza_id', $razas, null, ['required', 'class' => 'form-control select2']) }}
							</div>
							<div class="col-12 form-group">
								{{ Form::label('descripcion', 'Descripción', ['class' => 'label-required']) }}
								{{ Form::textarea('descripcion', null, ['required', 'rows' => 5, 'class' => 'form-control']) }}
								{!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 text-center">
					<div class="block">
						@if($mascota->toArray() && isset($mascota->fotos[0]))
							<img src="{{ Storage::url($mascota->fotos[0]->foto) }}" style="width: 180px; height: 150px;">
						@else
							<img class="hidden" style="width: 180px; height: 150px;">
						@endif
						<div class="custom-file">
							{{ Form::file('foto[]', ['class' => 'custom-file-input', 'accept' => 'image/*', 'onchange' => 'readURL(this)', 'data-id' => '1'] + (!$mascota->toArray() ? ['required'] : [])) }}
							{{ Form::label('foto[]', 'Foto frontal', ['class' => 'custom-file-label']) }}
						</div>
					</div>
				</div>
				<div class="col-md-4 text-center">
					<div class="block">
						@if($mascota->toArray() && isset($mascota->fotos[1]))
							<img src="{{ Storage::url($mascota->fotos[1]->foto) }}" style="width: 180px; height: 150px;">
						@else
							<img class="hidden" style="width: 180px; height: 150px;">
						@endif
						<div class="custom-file">
							{{ Form::file('foto[]', ['class' => 'custom-file-input', 'accept' => 'image/*', 'onchange' => 'readURL(this)', 'data-id' => '2']) }}
							{{ Form::label('foto[]', 'Foto de lado', ['class' => 'custom-file-label']) }}
						</div>
					</div>
				</div>
				<div class="col-md-4 text-center">
					<div class="block">
						@if($mascota->toArray() && isset($mascota->fotos[2]))
							<img src="{{ Storage::url($mascota->fotos[2]->foto) }}" style="width: 180px; height: 150px;">
						@else
							<img class="hidden" style="width: 180px; height: 150px;">
						@endif
						<div class="custom-file">
							{{ Form::file('foto[]', ['class' => 'custom-file-input', 'accept' => 'image/*', 'onchange' => 'readURL(this)', 'data-id' => '3']) }}
							{{ Form::label('foto[]', 'Foto desde arriba', ['class' => 'custom-file-label']) }}
						</div>
					</div>
				</div>
				<div class="col-12 form-group text-center" style="margin-bottom: 30px">
					{!! Form::button('Enviar datos', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection

@section('script')
	<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
	<script>
		$('#fecha_nacimiento').datepicker({
			uiLibrary: 'bootstrap4'
		})
		$('#fecha_vacunacion').datepicker({
			uiLibrary: 'bootstrap4'
		})
		$(document).on('change', '#vacunado', function(){
			if($(this).val() == '1'){
				$('#fecha_vacunacion_div').removeClass('hidden')
			}else{
				$('#fecha_vacunacion_div').addClass('hidden')
			}
		})
		function readURL(input){
			if(input.files && input.files[0]){
				if(input.files[0].size <= 500000){
					var reader = new FileReader()
					reader.onload = function(e){
						$(`[data-id="${input.getAttribute('data-id')}"]`).parent().parent().find('img').attr('src', e.target.result).removeClass('hidden')
					}
					reader.readAsDataURL(input.files[0])
				}else{
					alert('La foto no puede superar los 5Mb')
				}
			}
		}
	</script>
@endsection