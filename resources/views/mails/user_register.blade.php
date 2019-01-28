@extends('mails.base')

@section('content')
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
		<tbody>
			<tr>
				<td style="padding-bottom:30px">
					<h2 style=";text-align:center;color:#404040;margin:0">Bienvenido, {{ $user->nombre.' '.$user->apellido }}</h2>
				</td>
			</tr>
			<tr>
				<td style="padding:15px 0">
					<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
						<tbody>
							<tr>
								<td style="text-align:center">
									<span style="font-size:14px;color:#999999;font-weight:300;text-align:center">
										Gracias por registrarse en nuestro sistema. Recuerda que puede acceder a nuestro sitio web en la siguiente direccion <a href="{{ route('home') }}">{{ route('login') }}</a>.<br/>
										Sus datos de ingreso son los siguientes:
										<ul>
											<li>
												<b>Nombre de usuario:</b> {{ $user->username }}.
											</li>
											<li>
												<b>Contraseè´–a: </b> {{ $user->password }}.
											</li>
										</ul>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
@endsection