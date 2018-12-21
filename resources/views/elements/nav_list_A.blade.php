<li>
	<a href="{{ route('listar_mascota') }}">Mascotas</a>
</li>
<li>
	<a href="{{ route('listar_solicitudes') }}">Solicitudes</a>
</li>
<li>
	<a href="{{ route('listar_ataques') }}">Ataques</a>
</li>
@role('administrator')
	<li class="menu-has-children">
		<a href="#" class="sf-with-ul">Configuración</a>
		<ul>
			<li>
				<a href="{{ route('listar_razas') }}">Razas</a>
			</li>
			<li>
				<a href="{{ route('listar_tipos_ataques') }}">Tipos de ataques</a>
			</li>
			<li>
				<a href="{{ route('listar_localizaciones_anatomicas') }}">Localizaciones anatómicas</a>
			</li>
		</ul>
	</li>
@endrole