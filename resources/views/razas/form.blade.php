<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">{{ $title }}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		{{ Form::model($raza, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
			<div class="modal-body">
				<div class="row">
					<div class="col-12 form-group">
						{{ Form::label('nombre', 'Nombre de la raza', ['class' => 'label-required']) }}
						{{ Form::text('nombre', null, ['required', 'class' => 'form-control']) }}
						{!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-12 form-group">
						{{ Form::label('especie', 'Especie de la raza', ['class' => 'label-required']) }}
						{{ Form::select('especie', [
							'' => 'Seleccione una opción',
							'C' => 'Canino',
							'F' => 'Felino',
							'O' => 'Otro'
						], null, ['required', 'class' => 'form-control']) }}
						{!! $errors->first('especie', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-12 form-group">
						{{ Form::label('descripcion', 'Descripción de la raza') }}
						{{ Form::textarea('descripcion', null, ['class' => 'form-control']) }}
						{!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
					</div>
					<div class="col-12 form-group text-center">
						@if($raza->toArray())
							<img src="{{ $raza->foto }}" alt="{{ $raza->nombre }}" class="img-fluid rounded" width="100">
						@else
							<img class="hide" style="width: 180px; height: 150px;">
						@endif
						<div class="custom-file">
							{{ Form::file('foto', ['class' => 'custom-file-input', 'accept' => 'image/*', 'onchange' => 'readURL(this)', 'data-id' => 1]) }}
							{{ Form::label('foto', 'Foto', ['class' => 'custom-file-label']) }}
							{!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success">Enviar datos</button>
			</div>
		{{ Form::close() }}
	</div>
</div>
<script>
	function readURL(input){
		if(input.files && input.files[0]){
			if(input.files[0].size <= 500000){
				var reader = new FileReader()
				reader.onload = function(e){
					$(`[data-id="${input.getAttribute('data-id')}"]`).parent().parent().find('img').attr('src', e.target.result).removeClass('hide')
				}
				reader.readAsDataURL(input.files[0])
			}else{
				alert('La foto no puede superar los 5Mb')
			}
		}
	}
</script>