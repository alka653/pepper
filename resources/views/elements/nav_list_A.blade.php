<li>
	<a href="{{ route('listar_mascota') }}">Mascotas</a>
</li>
<li>
	<a href="{{ route('listar_solicitudes') }}">Solicitudes</a>
</li>
<li class="menu-has-children">
	<a href="#" class="sf-with-ul">Ataques</a>
	<ul>
		<li>
			<a href="{{ route('registrar_ataque') }}">Registrar</a>
		</li>
		<li>
			<a href="{{ route('listar_ataques') }}">Listar</a>
		</li>
	</ul>
</li>
@role('administrator')
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
		</ul>
	</li>
@endrole