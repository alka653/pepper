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
			<ul class="nav-menu sf-js-enabled sf-arrows">
				<li>
					<a href="{{ route('home') }}">Inicio</a>
				</li>
				@if(!Auth::check())
					<li>
						<a href="{{ route('login') }}">Iniciar sesión</a>
					</li>
				@else
					@include('elements.nav_list_'.(Auth::user()->perfil != 'U' ? 'A' : Auth::user()->perfil))
					<li class="menu-has-children">
						<a href="#" class="sf-with-ul">{{ Auth::user()->persona->nombre }}</a>
						<ul>
							<li>
								<a href="{{ route('perfil') }}">Mi cuenta</a>
							</li>
							<li>
								<a href="{{ route('logout') }}">Cerrar sesión</a>
							</li>
						</ul>
					</li>
				@endif	
			</ul>
		</nav>
	</div>
</header>