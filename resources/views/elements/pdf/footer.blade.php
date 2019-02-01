<footer class="text-center">
    <small>
        Usuario: {{ Auth::user()->persona->nombre }} {{ Auth::user()->persona->apellido }}. Fecha {{ date('Y-m-d h:i:s A') }}
    </small>
</footer>