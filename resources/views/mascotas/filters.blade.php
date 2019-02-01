<div class="col-12">
	<hr/>
</div>
<div class="col-md-3 form-group">
	{{ Form::select('sexo', [
		'' => 'Por Género',
		'M' => 'Macho',
		'F' => 'Hembra'
	], $extraQuery['sexo'], ['class' => 'form-control']) }}
</div>
<div class="col-md-3 form-group">
	{{ Form::text('color', $extraQuery['color'], ['class' => 'form-control', 'placeholder' => 'Por color']) }}
</div>
<div class="col-md-3 form-group">
	{{ Form::select('raza_id', $razas, $extraQuery['raza_id'], ['class' => 'form-control']) }}
</div>
<div class="col-md-3 form-group">
	{{ Form::select('estado', [
		'' => 'Por estado',
		'V' => 'Vivo',
		'M' => 'Fallecido'
	], $extraQuery['estado'], ['class' => 'form-control']) }}
</div>