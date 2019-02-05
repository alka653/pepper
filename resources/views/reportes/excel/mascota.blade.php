<table>
    <thead>
        <tr>
            <th>Fecha de registro</th>
            <th>Nombre</th>
            <th>Raza</th>
            <th>Color</th>
            <th>Propietario</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mascotas as $mascota)
            <tr>
                <td>{{ $mascota->fecha_ingreso }}</td>
                <td>{{ $mascota->nombre }}</td>
                <td>{{ $mascota->raza->nombre }}</td>
                <td>{{ $mascota->color }}</td>
                <td>{{ $mascota->propietario->nombre.' '.$mascota->propietario->apellido }}</td>
                <td>{{ $mascota->estado }}</td>
            </tr>
        @endforeach
    </tbody>
</table>