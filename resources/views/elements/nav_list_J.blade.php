<li>
	<a href="{{ route('listar_mascota') }}">Mascotas</a>
</li>
<li>
	<a href="{{ route('listar_solicitudes') }}">Solicitudes</a>
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
			<a href="{{ route('reportes_solicitudes') }}">Solicitudes</a>
		</li>
		<li>
			<a href="#">Usuarios del sistema</a>
		</li>
		<li>
			<a href="#">Mascotas</a>
		</li>
		<li>
			<a href="#">Ataques</a>
		</li>
	</ul>
</li>
<li class="menu-has-children">
	<a href="#" class="sf-with-ul">Configuración</a>
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
			<a href="#">Usuarios</a>
		</li>
		<li>
			<a href="#">Propietarios</a>
		</li>
	</ul>
</li>