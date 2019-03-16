@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <h4 class="text-center">Certificados</h4>
        <div class="block">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre de la mascota</th>
                        <th>Fecha remisión</th>
                        <th>Fecha vencimiento</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($certificados as $certificado)
                        <tr>
                            <td>{{ $certificado->mascota->nombre }}</td>
                            <td>{{ $certificado->fecha_remitido }}</td>
                            <td>{{ $certificado->fecha_vencimiento }}</td>
                            <td>
                                <a href="{{ route('certificado.pdf', ['mascota' => $certificado->mascota->id, 'certificado' => $certificado->id]) }}" class="btn btn-sm btn-success" target="_blank">Descargar el certificado</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="3">
                                @role('guest')
                                   Aún no tiene certificado para las mascotas. Da <a href="{{ route('crear_solicitud') }}">clic aquí</a> para hacer la solicitud.
                                @else
                                    Sin certificados
                                @endrole
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $certificados->links() }}
    </div>
@endsection