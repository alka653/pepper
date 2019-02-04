@extends('mails.base')

@section('content')
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
		<tbody>
			<tr>
				<td style="padding-bottom:30px">
					<h2 style=";text-align:center;color:#404040;margin:0">Estimado usuario.</h2>
				</td>
			</tr>
			<tr>
				<td style="padding:15px 0">
					<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
						<tbody>
							<tr>
								<td style="text-align:center">
									<span style="font-size:14px;color:#999999;font-weight:300;text-align:center">
                                        Se ha recibido una solicitud de cambio de contraseña. Para cambiar La contraseña ingresa en el siguiente botón
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center" dir="ltr" style="vertical-align:top;padding-top:20px">
					<table border="0" cellpadding="0" cellspacing="0" class="m_304056208632991473action-btn" style="line-height:22px;margin:0 auto;height:34px">
						<tbody>
							<tr>
								<td height="38" style="background-color:#79c60b;font-size:14px" valign="middle">
									<a class="m_304056208632991473action-btn-middle" href="{{ $actionUrl }}" style="color:#ffffff;font-weight:700;text-decoration:none;font-size:14px!important;padding:10px" target="_blank" data-saferedirecturl="https://www.google.com/url?q={{ route('login') }}">
										Cambiar contraseña
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
@endsection