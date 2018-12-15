@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container" style="margin-bottom: 50px">
		<h2>Lista de mascotas</h2>
		<div class="row justify-content-md-center">
			<div class="col-12 text-center">
				@include('elements.buscar')
				<br>
				@if(Auth::user()->perfil == 'U')
					<a href="{{ route('crear_mascota') }}" class="btn btn-primary btn-sm" style="margin-top: 10px; margin-bottom: 10px;">Agregar mascota</a>
				@endif
			</div>
			@forelse($mascotas as $mascota)
				<div class="col-md-4 block">
					<div class="row">
						<div class="col-3">
							<img src="{{ Storage::url($mascota->fotos[0]->foto) }}" alt="{{ $mascota->nombre }}" class="img-fluid rounded">
						</div>
						<div class="col-9">
							<h3 class="no-margin">{{ $mascota->nombre }}</h3>
							<h6 class="no-margin"><b>Sexo:</b> {{ $mascota->getSexo($mascota->sexo) }}</h6>
							@if(Auth::user()->perfil != 'U')
								<h6 class="no-margin"><b>Propietario:</b> {{ $mascota->propietario->nombre.' '.$mascota->propietario->apellido }}</h6>
							@endif
							<a href="{{ route('detalle_mascota', ['mascota' => $mascota->id]) }}" class="btn btn-sm btn-info">Detalle</a>
							@if(Auth::user()->perfil == 'U')
								<a href="{{ route('editar_mascota', ['mascota' => $mascota->id]) }}" class="btn btn-sm btn-warning">Editar</a>
							@endif
						</div>
					</div>
				</div>
			@empty
				<div class="col-12 text-center">
					@if(Auth::user()->perfil == 'U')
						<h5>No tienes una mascota agregada. Da <a href="{{ route('crear_mascota') }}">clic aquí</a> para agregar tu mascota</h5>
					@else
						<h5>Aún no han registrado mascotas</h5>
					@endif
				</div>
			@endforelse
		</div>
	</div>
@endsection