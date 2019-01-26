@extends('layouts.app')

@section('style')
	<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<h2>{{ $title }}</h2>
		<div class="block">
			{{ Form::open(['url' => $route, 'method' => 'get', 'autocomplete' => 'off']) }}
				<div class="row">
					{{ Form::hidden('reporte', true, ['class' => 'form-control']) }}
					@foreach($forms as $form)
						<div class="col-md-6 form-group">
							{{ Form::label($form['field'], $form['name'], ['class' => ($form['required'] ? 'label-required' : '')]) }}
							@switch($form['type'])
								@case('text')
									{{ Form::text($form['field'], null, ['class' => 'form-control '.$form['extra_class']] + ($form['required'] ? ['required'] : [])) }}
									@break
								@case('select')
									{{ Form::select($form['field'], $form['options'], null, ['class' => 'form-control '.$form['extra_class']] + ($form['required'] ? ['required'] : [])) }}
									@break
							@endswitch
						</div>
					@endforeach
					<div class="col-md-6 form-group">
						{{ Form::label('exportar', 'Exportar', ['class' => 'label-required']) }}
						{{ Form::select('exportar', [
							'' => 'Seleccione una opción',
							'pdf' => 'PDF',
							'excel' => 'Excel'
						], null, ['required', 'class' => 'form-control']) }}
					</div>
					<div class="col-12 form-group text-center">
						{!! Form::button('Generar reporte', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection

@section('script')
	<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
	<script>
		$('#fecha_inicial').datepicker({
			uiLibrary: 'bootstrap4'
		})
		$('#fecha_final').datepicker({
			uiLibrary: 'bootstrap4'
		})
		$('#fecha_registro').datepicker({
			uiLibrary: 'bootstrap4'
		})
	</script>
@endsection