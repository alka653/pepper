<li>
	<a href="{{ route('listar_razas_with_auth') }}">Razas</a>
</li>
<li>
	<a href="{{ route('listar_propietarios') }}">Propietarios</a>
</li>
<li>
	<a href="{{ route('listar_ataques') }}">Ataques</a>
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