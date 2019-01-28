Bienvenido, {{ $user->nombre }} {{ $user->apellido }}

Gracias por registrarse en nuestro sistema. Recuerda que puede acceder a nuestro sitio web en la siguiente direccion {{ route('login') }}

Sus datos de ingreso son los siguientes:

Nombre de usuario: {{ $user->username }}.
Contrase«Ða: {{ $user->password }}.