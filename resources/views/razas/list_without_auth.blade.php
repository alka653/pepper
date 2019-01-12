@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="{{ mix('/css/portafolio.css') }}">
@endsection

@section('content')
	<div class="container" style="margin-bottom: 100px">
		<h2 class="text-center">Perros potencialmente peligrosos</h2>
		<section class="portafolio">
			<div class="portafolio-container">
				<div class="row">
					@foreach($razas as $raza)
						<div class="col-md-4" style="margin: 5px 0px">
							<section class="portafolio-item">
								<img src="{{ $raza->image }}" class="img-fluid">
								<section class="portafolio-text">
									<h2 style="color:#00BFFF; font-size:18px;: Georgia, 'Times New Roman', serif;"><b>{{ $raza->nombre }}</b></h2>
									<a class="open-modal" href="{{ route('detalle_raza_without_auth', ['raza' => $raza->id, 'mode' => 'H']) }}" style= "color:#00BFFF; font-size:18px;: Georgia, 'Times New Roman', serif;">Historia</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     				<a class="open-modal" href="{{ route('detalle_raza_without_auth', ['raza' => $raza->id, 'mode' => 'C']) }}" style= "color:#00BFFF; font-size:18px;: Georgia, 'Times New Roman', serif;" >Caracteristicas</a><br><br>
								</section>
							</section>
						</div>
					@endforeach
				</div>
			</div>
		</section>
	</div>
@endsection