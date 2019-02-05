<table>
    <thead>
        <tr>
            <th>Fecha de ataque</th>
            <th>Nombre de la mascota</th>
            <th>Raza</th>
            <th>Nombre del propietario</th>
            <th>Tipo de lesión</th>
            <th>Animal vacunado</th>
            <th>Nombre de la victima</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ataques as $ataque)
            <tr>
                <td>{{ $ataque->fecha_ataque }}</td>
                <td>{{ $ataque->mascota->nombre }}</td>
                <td>{{ $ataque->mascota->raza->nombre }}</td>
                <td>{{ $ataque->mascota->propietario->nombre.' '.$ataque->mascota->propietario->apellido }}</td>
                <td>{{ $ataque->tipoAgresion->nombre }}</td>
                <td>{{ $ataque->mascota->getAnimalVacunado($ataque->mascota->vacunado) }}</td>
                <td>{{ $ataque->victima->nombre.' '.$ataque->victima->apellido }}</td>
            </tr>
        @endforeach
    </tbody>
</table>