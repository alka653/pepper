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
		<h2 class="text-center">Perros potencialmente peligrosos</h2>
		<div class="row justify-content-md-center">
			@foreach($razas as $raza)
				<div class="col-md-3">
					<div class="block">
						{{ $raza->nombre }}
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endsection