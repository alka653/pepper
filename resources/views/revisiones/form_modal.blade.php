<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">{{ $title }}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		{{ Form::model($revision, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
			<div class="modal-body">
				<div class="row">
					<div class="col-12 form-group">
						<div class="form-group">
							{{ Form::label('observacion', 'Observación', ['class' => 'label-required']) }}
							{{ Form::textarea('observacion', null, ['required', 'rows' => 2, 'class' => 'form-control only-char']) }}
						</div>
					</div>
					<div class="col-12 form-group">
						{{ Form::label('estado', 'Estado de la revisión', ['class' => 'label-required']) }}
						{{ Form::select('estado', [
							'R' => 'Remitido',
							'N' => 'No aceptado'
						], null, ['required', 'class' => 'form-control']) }}
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