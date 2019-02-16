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
            Lista de permisos
            <a href="#" class="btn btn-sm btn-primary open-modal">Agregar acceso</a>
		</h2>
		<div class="block">
			<div id="chart_div"></div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Perfil</th>
							<th>Nombre del permiso</th>
                            <th></th>
						</tr>
					</thead>
					<tbody>
                        @foreach($roles as $role)
                            @foreach($role->getAllPermissions() as $permission)
                                <tr>
                                    <td>
                                        @switch($role->name)
                                            @case('guest')
                                                Propietario
                                                @break
                                            @case('zoo')
                                                zootécnico
                                                @break
                                            @case('boss')
                                                Jefe
                                                @break
                                            @case('coor')
                                                Coordinador
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection