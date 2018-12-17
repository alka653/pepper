<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">{{ $title }}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		{{ Form::model($raza, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off', 'id' => 'form-modal']) }}
			<div class="modal-body">
				<div class="form-group">
					{{ Form::label('nombre', 'Nombre de la raza', ['class' => 'label-required']) }}
					{{ Form::text('nombre', null, ['required', 'class' => 'form-control']) }}
					{!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="form-group">
					{{ Form::label('especie', 'Especie de la raza', ['class' => 'label-required']) }}
					{{ Form::select('especie', [
						'' => 'Seleccione una opción',
						'C' => 'Canino',
						'F' => 'Felino',
						'O' => 'Otro'
					], null, ['required', 'class' => 'form-control']) }}
					{!! $errors->first('especie', '<p class="help-block">:message</p>') !!}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success">Enviar datos</button>
			</div>
		{{ Form::close() }}
	</div>
</div>