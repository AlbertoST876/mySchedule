<header>
    <nav>
        <a href="./"><img src="{{ asset("icon.png") }}"></a>

        <ul>
            <li><a href="{{ route("index") }}">Inicio</a></li>
            <li><a href="{{ route("calendar") }}">Calendario</a></li>
            <li><a href="{{ route("events") }}">Eventos</a></li>
        </ul>

        <div class="user">
            @guest
                <button type="button"><img src="{{ asset("./storage/img/default-user.png") }}"  width="80px" height="80px"></button>

                <div>
                    <ul>
                        <li><a href="{{ route("login") }}">Iniciar Sesión</a></li>
                        <li><a href="{{ route("register") }}">Registrarse</a></li>
                    </ul>
                </div>
            @else
                <button type="button"><img src="{{ asset("./storage/img/default-user.png") }}"  width="80px" height="80px"></button>

                <div>
                    <form action="{{ route("logout") }}" method="post">
                        @csrf

                        <input type="submit" value="Cerrar Sesión">
                    </form>
                </div>
            @endguest
        </div>
    </nav>
</header>