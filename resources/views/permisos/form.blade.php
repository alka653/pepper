<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $title }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{ Form::open(['url' => route('crear_permiso.post'), 'method' => 'post']) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 form-group">
                        {{ Form::label('role', 'Perfil', ['class' => 'label-required']) }}
                        {{ Form::select('role', $roles, null, ['required', 'class' => 'form-control']) }}
                    </div>
                    <div class="col-12 form-group">
                        {{ Form::label('permission', 'Permiso', ['class' => 'label-required']) }}
                        {{ Form::select('permission', $permissions, null, ['required', 'class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Enviar datos</button>
            </div>
        {{ Form::close() }}
    </div>
</div>