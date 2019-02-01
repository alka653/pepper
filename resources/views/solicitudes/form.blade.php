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
		<h2>{{ $title }}</h2>
		{{ Form::model($solicitud, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
			<br>
			@if($mascotas)
				<h4>Seleccionar una mascota</h4>
				<div class="row justify-content-md-center">
					@foreach($mascotas as $mascota)
						<div class="col-md-4">
							<div class="block">
								<div class="custom-control custom-radio">
	    							{{ Form::radio('mascota_id', $mascota->id, false, ['class' => 'custom-control-input', 'id' => "mascota{$mascota->id}", 'required', 'title' => 'Selecciona una mascota']) }}
									{{ Form::label("mascota{$mascota->id}", $mascota->nombre, ['class' => 'custom-control-label']) }}
	  							</div>
							</div>
						</div>
					@endforeach
				</div>
				<br>
			@endif
			<h4>Subir la documentación requerida</h4>
			<div class="row" style="margin-bottom: 100px;">
				<div class="col-md-4">
					<div class="block">
						@if($solicitud->toArray() && isset($solicitud->documentos[0]))
							<div class="text-center">
								<a href="{{ Storage::url($solicitud->documentos[0]->documento) }}" target="_blank">Carnet de vacunación</a>
							</div>
						@endif
						<div class="custom-file">
							{{ Form::file('documento[]', ['class' => 'custom-file-input', 'onchange' => 'readURL(this)', 'accept' => 'image/*,application/pdf,application/msword', 'data-name' => 'carnet_vacunacion'] + (!isset($solicitud->documentos[0]) ? ['required'] : [])) }}
							{{ Form::label('documento[]', 'Carnet de vacunación', ['class' => 'custom-file-label']) }}
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="block">
						@if($solicitud->toArray() && isset($solicitud->documentos[1]))
							<div class="text-center">
								<a href="{{ Storage::url($solicitud->documentos[1]->documento) }}" target="_blank">Póliza</a>
							</div>
						@endif
						<div class="custom-file">
							{{ Form::file('documento[]', ['class' => 'custom-file-input', 'onchange' => 'readURL(this)', 'data-name' => 'poliza'] + (!isset($solicitud->documentos[1]) ? ['required'] : [])) }}
							{{ Form::label('documento[]', 'Póliza', ['class' => 'custom-file-label']) }}
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="block">
						@if($solicitud->toArray() && isset($solicitud->documentos[2]))
							<div class="text-center">
								<a href="{{ Storage::url($solicitud->documentos[2]->documento) }}" target="_blank">Declaración</a>
							</div>
						@endif
						<div class="custom-file">
							{{ Form::file('documento[]', ['class' => 'custom-file-input', 'onchange' => 'readURL(this)', 'data-name' => 'declaracion']) }}
							{{ Form::label('documento[]', 'Declaración', ['class' => 'custom-file-label']) }}
						</div>
					</div>
				</div>
				<div class="col-12 form-group text-center" style="margin-top: 30px">
					{!! Form::button('Enviar datos', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection

@section('script')
	<script>
		function getMascotaIdByURL(){
			const mascota_id = url_param('mascota')
			if(mascota_id){
				$(`#mascota${mascota_id}`).trigger('click')
			}
		}
		function readURL(input){
			if(input.files && input.files[0]){
				if(input.files[0].size <= 500000){
					$parent = $(`[data-name="${input.getAttribute('data-name')}"]`).parent().parent()
					$parent.find('a').remove()
					$parent.find('p').remove()
					$parent.prepend(`
						<p class="text-center no-margin">${input.files[0].name}</p>
					`)
				}else{
					alert('El archivo no puede superar los 5Mb')
				}
			}
		}
		$('.custom-file-input').change(function(){
			if($(this).attr('data-name') == 'poliza'){
				$('[data-name="declaracion"]').removeAttr('required')
			}else if($(this).attr('data-name') == 'declaracion'){
				$('[data-name="poliza"]').removeAttr('required')
			}
		})
		$(document).ready(function(){
			getMascotaIdByURL()
		})
	</script>
@endsection