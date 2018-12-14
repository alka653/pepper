<header id="header">
	<div class="container">
		<div id="logo" class="pull-left">
			<h1>
				<a href="{{ route('home') }}" class="scrollto">
					PEP<span>PER</span>
				</a>
			</h1>
		</div>
		<nav id="nav-menu-container">
			<ul class="nav-menu">
				<li>
					<a href="{{ route('home') }}">Inicio</a>
				</li>
				@if(!Auth::check())
					<li>
						<a href="{{ route('login') }}">Iniciar sesión</a>
					</li>
				@else
					@include('elements.nav_list_'.(Auth::user()->perfil == 'U' ? 'U' : 'A'))
					<li>
						<a href="{{ route('logout') }}">Cerrar sesión</a>
					</li>
				@endif	
			</ul>
		</nav>
	</div>
</header>