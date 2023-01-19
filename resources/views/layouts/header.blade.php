<header>
    <nav>
        <a href="./"><img src="{{ asset("icon.png") }}"></a>

        <ul>
            <li><a href="{{ route("index") }}">Inicio</a></li>
            <li><a href="{{ route("calendar", [Auth::user()]) }}">Calendario</a></li>
            <li><a href="{{ route("events", [Auth::user()]) }}">Eventos</a></li>
        </ul>

        <div class="user">
            <!-- LOGICA USUARIO - Por hacer -->
        </div>
    </nav>
</header>