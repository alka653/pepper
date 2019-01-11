@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container" style="margin-bottom: 100px">
		<h2 class="text-center">Ley 746 - Secretaría distrital de la salud</h2>
		<div class="row">
			<div class="col-md-5 text-center">
				<img src="/img/bull.jpg" class="img-fluid">
			</div>
			<div class="col-md-7">
				<p>Los perros potencialmente peligrosos, están regidos bajo la ley 746 de 2002 y el nuevo Código de la Policía, el cual regula la tenencia y control de estos animales. Se debe tener en cuenta los siguientes artículos establecidos en el nuevo Código de Policía, capitulo IV (Ejemplares caninos potencialmente peligrosos):</p>
				<p>Artículo 126. Ejemplares caninos potencialmente peligrosos. Se consideran caninos peligrosos aquellos que representan una o más de las siguientes características: </p>
			</div>
			<div class="col-12">
				<ul>
					<li>Caninos que han tenido episodios de agresiones a personas; o les hayan causado muerte a otros perros.</li>
					<li>Caninos que han sido adiestrados para el ataque y la defensa.</li>
					<li>Caninos que pertenecen a las siguientes razas o sus cruces o híbridos: American Staffordshire Terrier, Bullmastiff,Doberman, Dogo Argentino, Dogo de Burdeos, Fila Brasilero, Mastin Napolitano, Bull Terrier, Pit Bull Terrier, American Pit bull Terrier, de presa canario, Rottweiler, Staffordshire Terrier, Tosa Japones y aquellas nuevas razas o mezclas de razas que el Gobierno nacional determine.</li>
				</ul>
			</div>
		</div>
		<div class="text-center">
			<a href="http://www.alcaldiabogota.gov.co/sisjur/normas/Norma1.jsp?i=5515" target="_blank" class="btn btn-info">Ver más información</a>
		</div>
	</div>
@endsection