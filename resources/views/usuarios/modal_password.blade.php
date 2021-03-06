<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Cambiar contraseña</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		{{ Form::open(['url' => route('cambiar_password.post', ['usuario' => $usuario]), 'method' => 'post', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form-modal']) }}
			<div class="modal-body">
				@if(Auth::user()->perfil == 'J')
					{{ Form::hidden('usuario', $usuario) }}
				@endif
				<div class="form-group">
					{{ Form::label('password_current', 'Contraseña actual') }}
					{{ Form::password('password_current', ['required', 'class' => 'form-control']) }}
					{!! $errors->first('password_current', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="form-group">
					{{ Form::label('password', 'Contraseña') }}
					{{ Form::password('password', ['required', 'class' => 'form-control']) }}
					{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="form-group">
					{{ Form::label('password_confirmation', 'Confirmar contraseña') }}
					{{ Form::password('password_confirmation', ['required', 'class' => 'form-control']) }}
					{!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success">Enviar datos</button>
			</div>
		{{ Form::close() }}
	</div>
</div>