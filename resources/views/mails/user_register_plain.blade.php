Hola, {{ $user->nombre }} {{ $user->apellido }}

Gracias por registrarse en Pepper.
Recuerda que el correo es {{ $user->email }} y la contraseña es 12345.
Ingresa ya para registrar a una mascota.

{{ route('login') }}