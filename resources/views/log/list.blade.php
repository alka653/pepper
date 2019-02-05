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
			Log de usuarios
		</h2>
		<div class="block">
			<div id="chart_div"></div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Descripción</th>
                            <th>Usuario</th>
						</tr>
					</thead>
					<tbody>
						@foreach($logs as $log)
							<tr>
                                <td>{{ $log->fecha }}</td>
                                <td>{{ $log->descripcion }}</td>
                                <td>{{ $log->usuario->username }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		{{ $logs->links() }}
	</div>
@endsection