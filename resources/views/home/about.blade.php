@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
		header#header{
			margin-bottom: 0px;
		}
	</style>
@endsection

@section('content')
	<div id="carousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel" data-slide-to="0" class="active"></li>
			<li data-target="#carousel" data-slide-to="1"></li>
			<li data-target="#carousel" data-slide-to="2"></li>
			<li data-target="#carousel" data-slide-to="3"></li>
			<li data-target="#carousel" data-slide-to="4"></li>
			<li data-target="#carousel" data-slide-to="5"></li>
			<li data-target="#carousel" data-slide-to="6"></li>
			<li data-target="#carousel" data-slide-to="7"></li>
			<li data-target="#carousel" data-slide-to="8"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="/img/slider/2.jpg" class="d-block w-100">
			</div>
			<div class="carousel-item">
				<img src="/img/slider/3.jpg" class="d-block w-100">
			</div>
			<div class="carousel-item">
				<img src="/img/slider/4.jpg" class="d-block w-100">
			</div>
			<div class="carousel-item">
				<img src="/img/slider/5.jpg" class="d-block w-100">
			</div>
			<div class="carousel-item">
				<img src="/img/slider/6.jpg" class="d-block w-100">
			</div>
			<div class="carousel-item">
				<img src="/img/slider/7.jpg" class="d-block w-100">
			</div>
			<div class="carousel-item">
				<img src="/img/slider/8.jpg" class="d-block w-100">
			</div>
			<div class="carousel-item">
				<img src="/img/slider/9.jpg" class="d-block w-100">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Anterior</span>
		</a>
		<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Siguiente</span>
		</a>
	</div><br>
	<div class="container" style="margin-bottom: 100px">
		<div class="accordion" id="accordionExample">
			<div class="card">
			  	<div class="card-header" id="tabHOne">
					<h2 class="mb-0">
				  		<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tabOne" aria-expanded="true" aria-controls="tabOne">
							Misión
				  		</button>
					</h2>
			  	</div>
			  	<div id="tabOne" class="collapse" aria-labelledby="tabHOne" data-parent="#accordionExample">
					<div class="card-body">
						<div class="text-center">
							<img src="/img/accordion/mision.jpg" style="max-width: 200px;">
						</div>
						<p class="text-justify">
							La secretaria de protección social en salud tiene como misión adoptar, implementar, vigilar y controlar las políticas nacionales en seguridad social, garantizando a la población girardoteña con principios de universalidad, la calidad, oportunidad y eficiencia el acceso a la salud, desarrollo a su vez  programas de promoción, prevención en proyectos que impacten y cambien estilos de vida, con  un equipo humano que trabaje con honestidad, transparencia, humanismo y sensibilidad social en procura de brindar salud para todos los girardoteños.
						</p>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="tabHTwo">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tabTwo" aria-expanded="true" aria-controls="tabTwo">
							Visión
						</button>
					</h2>
				</div>
				<div id="tabTwo" class="collapse" aria-labelledby="tabHTwo" data-parent="#accordionExample">
					<div class="card-body">
						<div class="text-center">
							<img src="/img/accordion/vision.jpg" style="max-width: 200px;">
						</div>
						<ul>
							<li>Generar el desarrollo institucional de salud en el municipio.</li>
							<li>Mejor la calidad de vida de los habitantes.</li>
							<li>Brindar la afiliación  oportunidad al sistema de seguridad en salud al mayor número de habitantes en la región.</li>
							<li>Generar un modelo de atención óptimo que permita establecer la prevención de las enfermedades.</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="tabHThree">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tabThree" aria-expanded="true" aria-controls="tabThree">
							Funciones
						</button>
					</h2>
				</div>
				<div id="tabThree" class="collapse" aria-labelledby="tabHThree" data-parent="#accordionExample">
					<div class="card-body">
						<div class="row">
							<div class="col-md-4">
								<div class="text-center">
									<img src="/img/accordion/calidad.jpg" style="max-width: 200px;">
								</div>
								<p class="text-justify">
									Vigilar en el municipio, la calidad del agua para su consumo humano; la recolección, transporte y disposición final de residuos sólidos; manejo y disposición  final de radiaciones ionizantes, excretas, residuos líquidos y aguas servidas, así como la calidad del aire. Para tal efecto, coordinar con las autoridades competentes las acciones de control a que haya lugar.
								</p>
							</div>
							<div class="col-md-4">
								<div class="text-center">
									<img src="/img/accordion/estableciminetos.jpg" style="max-width: 200px;">
								</div>
								<p class="text-justify">
									Ejercer vigilancia y control sanitario en el municipio, sobre los factores de riesgo para la salud  en los establecimientos y espacios que puedan generar riesgo para la población, tales como  establecimientos educativos, hospitales, cárceles, cuarteles, albergues, guarderías, ancianatos, puertos, aeropuertos y terminales terrestre, transporte público, piscinas, estadios, plantas de sacrificios de animales, entre otros.
								</p>
							</div>
							<div class="col-md-4">
								<div class="text-center">
									<img src="/img/accordion/produccion.jpg" style="max-width: 200px;">
								</div>
								<p class="text-justify">
										Vigilar y control en el municipio, la calidad, producción, comercialización y distribución de alimentos para el consumo humano con prioridad en los altos riesgos epidemiológico, así como los de materia prima para consumo animal que representes riesgo en salud humana.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection