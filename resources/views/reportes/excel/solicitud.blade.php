<table>
    <thead>
        <tr>
            <th>No. radicado</th>
            <th>Fecha de solicitud</th>
            <th>Nombre de la mascota</th>
            <th>Raza</th>
            <th>Nombre del propietario</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->id }}</td>
                <td>{{ $solicitud->fecha_solicitud }}</td>
                <td>{{ $solicitud->mascota->nombre }}</td>
                <td>{{ $solicitud->mascota->raza->nombre }}</td>
                <td>{{ $solicitud->mascota->propietario->nombre.' '.$solicitud->mascota->propietario->apellido }}</td>
                <td>{{ $solicitud->getEstado($solicitud->estado, false) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>