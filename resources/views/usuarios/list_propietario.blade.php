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
			Lista de propietarios
		</h2>
        @include('elements.buscar')
        <br />
		<div class="block">
			<div id="chart_div"></div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Número de documento</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($usuarios as $usuario)
							<tr>
                                <td>{{ $usuario->persona->nombre }}</td>
                                <td>{{ $usuario->persona->apellido }}</td>
                                <td>{{ $usuario->persona->numero_documento }}</td>
                                <td>
                                    <a href="{{ route('perfil_usuario', ['persona' => $usuario->persona->id]) }}" class="btn btn-primary">Ver</a>
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