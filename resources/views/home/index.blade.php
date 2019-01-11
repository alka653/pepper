@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
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
	</div>
@endsection