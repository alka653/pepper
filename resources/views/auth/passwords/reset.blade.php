@extends('layouts.app')

@section('style')
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
		.block{
			margin-top: 15%;
		}
	</style>
@endsection

@section('content')
    <div class="container" style="margin-bottom: 20px">
		<div class="row justify-content-md-center">
			<div class="col-md-5">
				<div class="block">
                    <h4>Cambio de contraseña</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ Form::open(['url' => route('password.update'), 'method' => 'post']) }}
                        {{ Form::hidden('token', $token) }}
                        <div class="form-group">
							{{ Form::label('email', 'Correo electrónico', ['class' => 'label-required']) }}
    						{{ Form::text('email', null, ['required', 'class' => 'form-control']) }}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'Contraseña', ['class' => 'label-required']) }}
                            {{ Form::password('password', ['required', 'class' => 'form-control']) }}
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('password_confirmation', 'Confirmar contraseña', ['class' => 'label-required']) }}
                            {{ Form::password('password_confirmation', ['required', 'class' => 'form-control']) }}
                            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group text-center">
                            {!! Form::button('Cambiar contraseña', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection