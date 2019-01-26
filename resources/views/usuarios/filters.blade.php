<div class="col-12">
    <hr/>
</div>
<div class="col-md-3 form-group">
    {{ Form::select('estado', [
        '' => 'Por estado',
        'A' => 'Activo',
        'I' => 'Inactivo'
    ], $extraQuery['estado'], ['class' => 'form-control']) }}
</div>
<div class="col-md-3 form-group">
    {{ Form::select('perfil', [
        '' => 'Por perfil',
        'U' => 'Propietario',
        'Z' => 'Zootécnico',
        'C' => 'Coordinador',
        'J' => 'Jefe'
    ], $extraQuery['perfil'], ['class' => 'form-control']) }}
</div>