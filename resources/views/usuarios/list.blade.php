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
		<h2>
			Lista de usuarios
		</h2>
		@include('elements.buscar', ['extra' => 'usuarios.filters'])
		<div class="block">
			<div id="chart_div"></div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nombres</th>
							<th>Nombre de usuario</th>
                            <th>Email</th>
                            <th>Perfil</th>
                            <th>Estado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($usuarios as $usuario)
							<tr>
                                <td>{{ $usuario->persona->nombre.' '.$usuario->persona->apellido }}</td>
                                <td>{{ $usuario->username }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->getPerfil($usuario->perfil) }}</td>
                                <td>{{ $usuario->getEstado($usuario->estado) }}</td>
                                <td>
                                    <a href="{{ route('perfil_usuario', ['persona' => $usuario->persona_id]) }}" class="btn btn-primary">Perfil</a>
                                </td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		{{ $usuarios->links() }}
	</div>
@endsection