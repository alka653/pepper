<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Cambiar contraseña</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		{{ Form::open(['url' => route('cambiar_password.post'), 'method' => 'post', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form-password']) }}
			<div class="modal-body">
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
<script>
	$(document).on('submit', '#form-password', function(event){
		event.preventDefault()
		$.post($(this).attr('action'), $(this).serialize())
		.done(function(response){
			alert(response.message)
			$('.modal').modal('hide')
		})
		.fail(function(xhr, status, error){
			$.each(xhr.responseJSON.errors, function(index, value){
				console.log(index, value)
				$(`#${index}`).parent().find('.invalid-feedback').remove()
				$(`#${index}`).parent().append(
					`<div class="invalid-feedback" style="display: block;">
						${value[0]}
					</div>`
				)
			})
		})
	})
</script>