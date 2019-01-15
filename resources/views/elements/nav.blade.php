<header id="header">
	<div class="container">
		<div id="logo" class="pull-left">
			<h1>
				<a href="{{ route('home') }}" class="scrollto">
					<img src="/img/img.jpg" height="60px">
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
						<a href="{{ route('quienes_somos') }}">Quienes somos</a>
					</li>
					<li>
						<a href="{{ route('listar_razas_without_auth') }}">Razas</a>
					</li>
					<li>
						<a href="{{ route('acerca') }}" class="open-modal">Acerca de</a>
					</li>
					<li>
						<a href="{{ route('ley_746') }}">Ley 746</a>
					</li>
					<li>
						<a href="{{ route('login') }}">Iniciar sesión</a>
					</li>
				@else
					@include('elements.nav_list_'.(Auth::user()->perfil != 'U' ? 'A' : Auth::user()->perfil))
					<li class="menu-has-children">
						<a href="#">
							<div class="row align-items-center">
								<div class="col-3">
									<img src="{{ Auth::user()->persona->foto }}" width="30">
								</div>
								<div class="col-9">
									{{ Auth::user()->persona->nombre }}, {{ Auth::user()->getPerfil(Auth::user()->perfil) }}
								</div>
							</div>
						</a>
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