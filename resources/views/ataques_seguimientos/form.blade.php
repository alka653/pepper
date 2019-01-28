<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">{{ $title }}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		{{ Form::model($ataque_seguimiento, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off', 'id' => 'form-modal']) }}
			<div class="modal-body">
				<div class="form-group">
					{{ Form::label('fecha', 'Fecha del seguimiento', ['class' => 'label-required']) }}
					{{ Form::text('fecha', null, ['required', 'class' => 'form-control']) }}
				</div>
				<div class="form-group">
					{{ Form::label('descripcion', 'Descripción', ['class' => 'label-required']) }}
					{{ Form::textarea('descripcion', null, ['required', 'rows' => '3', 'data-error' => 'Ingresa una breve descripción', 'style' => 'width: 100%;']) }}
				</div>
				<div class="form-group">
					{{ Form::label('tipo', 'Tipo de seguimiento', ['class' => 'label-required']) }}
					{{ Form::select('tipo', [
						'' => 'Seleccione una opción',
						'V' => 'Victima',
						'A' => 'Agresor'
					], null, ['required', 'class' => 'form-control']) }}
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
	$('#fecha').datepicker({
		uiLibrary: 'bootstrap4'
	})
</script>