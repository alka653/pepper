@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container" style="margin-bottom: 100px">
		<div class="block">
			<div class="row">
				<div class="col-md-2 text-center">
					<div class="row">
						<div class="col-12">
							<img src="{{ $usuario->persona->foto }}" class="img-fluid rounded" alt="{{ $usuario->persona->nombre }}">
						</div>	
						<div class="col-12">
							<h5 class="no-margin">
								{{ $usuario->persona->nombre.' '.$usuario->persona->apellido }}
							</h5>
						</div>
					</div>
				</div>
				<div class="col-md-10">
					<h5 class="no-margin">
						<b>Correo electrónico:</b>
						{{ $usuario->email }}
					</h5>
					<h5 class="no-margin">
						<b>Tipo de documento:</b>
						{{ $usuario->persona->getTipoDocumento($usuario->persona->tipo_documento) }}
					</h5>
					<h5 class="no-margin">
						<b>Número de documento:</b>
						{{ number_format($usuario->persona->numero_documento) }}
					</h5>
					<h5 class="no-margin">
						<b>Lugar expedición documento:</b>
						{{ $usuario->persona->lugar($usuario->persona->municipio_expedicion_id) }}
					</h5>
					<h5 class="no-margin">
						<b>Dirección de residencia:</b>
						{{ $usuario->persona->direccion_residencia }}. {{ $usuario->persona->lugar($usuario->persona->municipio_residencia_id) }}
					</h5>
					<h5 class="no-margin">
						<b>Género:</b>
						{{ $usuario->persona->getSexo($usuario->persona->sexo) }}
					</h5>
					<h5 class="no-margin">
						<b>Número celular:</b>
						{{ $usuario->persona->numero_celular }}
					</h5>
					<h5 class="no-margin">
						<b>Número telefonico:</b>
						{{ $usuario->persona->numero_telefonico }}
					</h5>
					<h5 class="no-margin">
						<b>Ocupación:</b>
						{{ $usuario->persona->ocupacion }}
					</h5>
					@if(Auth::user()->perfil == 'J' || (Auth::user()->id == $usuario->id))
    					<div class="text-center">
    						<a href="{{ route('editar_perfil', ['persona' => $usuario->persona_id]) }}" class="btn btn-sm btn-success">
    							Actualizar datos
    						</a>
    						<a href="{{ route('cambiar_password', ['usuario' => $usuario->id]) }}" class="btn btn-sm btn-warning open-modal">
    							Cambiar contraseña
							</a>
							@can('modulo_usuarios')
								@if($usuario->estado == 'A')
									<a href="{{ route('cambiar_estado', ['persona' => $usuario->persona_id, 'estado' => 'I']) }}" class="btn btn-sm btn-info" onclick="onConfirm('desactivar', event)">
										Desactivar cuenta
									</a>
								@else
									<a href="{{ route('cambiar_estado', ['persona' => $usuario->persona_id, 'estado' => 'A']) }}" class="btn btn-sm btn-info" onclick="onConfirm('activar', event)">
										Activar cuenta
									</a>
								@endif
							@endcan
    					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		onConfirm = (action, event) => {
			if(!confirm(`¿Desea ${action} la cuenta?`)){
				event.preventDefault();
			}
		}
	</script>
@endsection