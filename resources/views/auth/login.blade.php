@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
		.block{
			margin-top: 15%;
		}
	</style>
@endsection

@section('content')
	<div class="container" style="margin-bottom: 20px">
		<div class="row justify-content-md-center">
			<div class="col-md-5">
				<div class="block">
					<h4>Ingreso a PEPPER</h4>
					{{ Form::open(['url' => route('login.post'), 'method' => 'post']) }}
						<div class="form-group">
							{{ Form::label('email', 'Nombre de usuario') }}
							{{ Form::text('email', null, ['required', 'class' => 'form-control']) }}
							{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
						</div>
						<div class="form-group">
							{{ Form::label('password', 'Contraseña') }}
							{{ Form::password('password', ['required', 'class' => 'form-control']) }}
							{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								{{ Form::checkbox('remember', false, old('remember'), ['class' => 'custom-control-input', 'id' => 'remember']) }}
								{{ Form::label('remember', 'Recordar acceso', ['class' => 'custom-control-label']) }}
							</div>
						</div>
						<div class="form-group text-center">
							{!! Form::button('Acceder', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
						</div>
					{{ Form::close() }}
				</div>
				<p class="text-center"><a href="{{ route('crear_cuenta') }}">Crear cuenta</a></p>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			localStorage.removeItem('municipio_expedicion_id')
			localStorage.removeItem('municipio_residencia_id')
		})
	</script>
@endsection