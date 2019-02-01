<li>
	<a href="{{ route('listar_mascota') }}">Mascotas</a>
</li>
<li class="menu-has-children">
	<a href="#" class="sf-with-ul">Solicitudes</a>
	<ul>
		<li>
			<a href="{{ route('listar_solicitudes') }}?estado=P">Radicados</a>
		</li>
		<li>
			<a href="{{ route('listar_solicitudes') }}?estado=F">Aprobados</a>
		</li>
		<li>
			<a href="{{ route('listar_solicitudes') }}?estado=C">Cancelados</a>
		</li>
		<li>
			<a href="{{ route('listar_solicitudes') }}?estado=PE">Pendientes</a>
		</li>
		<li>
			<a href="{{ route('listar_solicitudes') }}?estado=RE">Revisados</a>
		</li>
	</ul>
</li>
<li>
	<a href="{{ route('listar_ataques') }}">Ataques</a>
</li>
<li>
	<a href="#">Gráficas</a>
</li>
<li class="menu-has-children">
	<a href="#" class="sf-with-ul">Reportes</a>
	<ul>
		<li>
			<a href="{{ route('reporte_solicitud') }}">Solicitudes</a>
		</li>
		<li>
			<a href="{{ route('reporte_usuario') }}">Usuarios del sistema</a>
		</li>
		<li>
			<a href="{{ route('reporte_mascota') }}">Mascotas</a>
		</li>
		<li>
			<a href="{{ route('reporte_ataque') }}">Ataques</a>
		</li>
	</ul>
</li>
<li class="menu-has-children">
	<a href="#" class="sf-with-ul">Parametrización</a>
	<ul>
		<li>
			<a href="{{ route('listar_razas_with_auth') }}">Razas</a>
		</li>
		<li>
			<a href="{{ route('listar_tipos_ataques') }}">Tipos de ataques</a>
		</li>
		<li>
			<a href="{{ route('listar_localizaciones_anatomicas') }}">Localizaciones anatómicas</a>
		</li>
		<li>
			<a href="{{ route('listar_usuarios') }}">Usuarios</a>
		</li>
		<li>
			<a href="{{ route('listar_propietarios') }}">Propietarios</a>
		</li>
	</ul>
</li>