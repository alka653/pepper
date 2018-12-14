<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<title>
			@yield('title', 'Pepper')
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
		<link href="{{ mix('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ mix('/css/font-awesome/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ mix('/css/animate/animate.min.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ mix('/css/ionicons/ionicons.min.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ mix('/css/theme.css') }}" rel="stylesheet" type="text/css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
		<link href="{{ mix('/css/app.min.css') }}" rel="stylesheet" type="text/css">
		@yield('style')
	</head>
	<body id="body">
		@include('elements.nav')
		<main id="main">
			@yield('content')
		</main>
		@include('elements.footer')
		<div class="load"></div>
		<div id="Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true"></div>
		<script src="{{ mix('/js/jquery.min.js') }}"></script>
		<script src="{{ mix('/js/jquery-migrate.min.js') }}"></script>
		<script src="{{ mix('/js/bootstrap.min.js') }}"></script>
		<script src="{{ mix('/js/sticky.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
		<script src="{{ mix('/js/theme.js') }}"></script>
		@if(Auth::check())
			<script>
				$(document).ready(function(){
					$.get('{{ route('verificar_usuario_mascotas') }}', function(response){
						if(response.count_pet == 0){
							$(`
								<div class="alert alert-warning" role="alert" style="margin: 0">
									No tienes mascotas registradas. Da <a href="{{ route('crear_mascota') }}" class="alert-link">clic aquí</a> para registrar tu mascota
								</div>
							`).insertBefore('header#header')
						}
					})
				})
			</script>
		@endif
		@yield('script')
	</body>
</html>