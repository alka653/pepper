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
							<img src="{{ Auth::user()->persona->foto }}" class="img-fluid rounded" alt="{{ Auth::user()->persona->nombre }}">
						</div>	
						<div class="col-12">
							<a href="#" class="btn btn-sm btn-success" style="margin-top: 5px">
								Cambiar imagen
							</a>
							<h5 class="no-margin">
								{{ Auth::user()->persona->nombre.' '.Auth::user()->persona->apellido }}
							</h5>
						</div>
					</div>
				</div>
				<div class="col-md-10">
					<h5 class="no-margin">
						<b>Correo electrónico:</b>
						{{ Auth::user()->email }}
					</h5>
					<h5 class="no-margin">
						<b>Tipo de documento:</b>
						{{ Auth::user()->persona->getTipoDocumento(Auth::user()->persona->tipo_documento) }}
					</h5>
					<h5 class="no-margin">
						<b>Número de documento:</b>
						{{ number_format(Auth::user()->persona->numero_documento) }}
					</h5>
					<h5 class="no-margin">
						<b>Lugar expedición documento:</b>
						{{ Auth::user()->persona->lugar(Auth::user()->persona->municipio_expedicion_id) }}
					</h5>
					<h5 class="no-margin">
						<b>Dirección de residencia:</b>
						{{ Auth::user()->persona->direccion_residencia }}. {{ Auth::user()->persona->lugar(Auth::user()->persona->municipio_residencia_id) }}
					</h5>
					<h5 class="no-margin">
						<b>Sexo:</b>
						{{ Auth::user()->persona->getSexo(Auth::user()->persona->sexo) }}
					</h5>
					<h5 class="no-margin">
						<b>Número celular:</b>
						{{ Auth::user()->persona->numero_celular }}
					</h5>
					<h5 class="no-margin">
						<b>Número telefonico:</b>
						{{ Auth::user()->persona->numero_telefonico }}
					</h5>
					<h5 class="no-margin">
						<b>Ocupación:</b>
						{{ Auth::user()->persona->ocupacion }}
					</h5>
					<div class="text-center">
						<a href="{{ route('editar_perfil', ['user' => Auth::user()->id]) }}" class="btn btn-sm btn-success">
							Actualizar datos
						</a>
						<a href="{{ route('cambiar_password') }}" class="btn btn-sm btn-warning open-modal">
							Cambiar contraseña
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection