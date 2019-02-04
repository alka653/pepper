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
                    <h4>Recuperar contraseña</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ Form::open(['url' => route('password.email'), 'method' => 'post']) }}
                        <div class="form-group">
							{{ Form::label('email', 'Correo electrónico') }}
    						{{ Form::text('email', null, ['required', 'class' => 'form-control']) }}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group text-center">
                            {!! Form::button('Recuperar contraseña', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection