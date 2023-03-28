<header>
    <nav class="px-4 md:px-8 lg:px-12 py-6 bg-slate-100 border-gray-200 rounded">
        <div class="flex flex-wrap items-center justify-between">
            <a class="flex items-center" href="{{ route("index") }}">
                <img class="mr-3 w-12 h-12" src="{{ asset("icon.svg") }}" alt="Icono de la Aplicación">
                <span class="self-center text-lg lg:text-xl font-semibold">MySchedule</span>
            </a>

            <div class="flex items-center md:order-2">
                <button type="button" class="flex mr-3 md:mr-0 bg-slate-100 rounded-full focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Abrir Menu de Usuario</span>

                    @auth
                        <img class="w-12 h-12 rounded-full" src="{{ is_null(auth() -> user() -> profileImg) ? asset("./storage/img/default-user.png") : asset(auth() -> user() -> profileImg) }}" alt="Foto de Perfil">
                    @else
                        <img class="w-12 h-12 rounded-full" src="{{ asset("./storage/img/default-user.png") }}" alt="Foto de Perfil">
                    @endauth
                </button>

                <div class="m-4 z-50 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-md" id="user-dropdown">
                    @auth
                        <div class="m-4">
                            <span class="block text-sm md:text-md text-gray-900">{{ auth() -> user() -> name }}</span>
                            <span class="block text-sm md:text-md font-medium text-gray-500 truncate">{{ auth() -> user() -> email }}</span>
                        </div>

                        <ul aria-labelledby="user-menu-button">
                            <li><a href="{{ route("settings") }}" class="block mt-2 px-4 py-2 w-full text-left text-sm md:text-md text-gray-700 hover:bg-gray-100">Ajustes</a></li>

                            <li>
                                <form action="{{ route("logout") }}" method="post">
                                    @csrf

                                    <input class="block mb-2 px-4 py-2 w-full text-left text-sm md:text-md text-gray-700 hover:bg-gray-100" type="submit" value="Cerrar Sesión" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
                                </form>
                            </li>
                        </ul>
                    @else
                        <ul aria-labelledby="user-menu-button">
                            <li><a href="{{ route("login") }}" class="block mt-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Iniciar Sesión</a></li>
                            <li><a href="{{ route("register") }}" class="block mb-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Registrarse</a></li>
                        </ul>
                    @endauth
                </div>

                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex ml-1 p-2 items-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Abrir Menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>

            <div class="mt-4 p-4 md:mt-0 items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
                <ul class="flex flex-col border border-gray-100 rounded-lg bg-slate-100 md:flex-row md:space-x-8 md:text-sm md:font-medium md:border-0 md:bg-slate-100">
                    <li><a href="{{ route("index") }}" class="block p-2 text-lg md:text-xl {{ $current == "home" ? "text-blue-600" : "text-black" }} rounded md:bg-transparent md:hover:text-blue-600">Inicio</a></li>
                    <li><a href="{{ route("calendar") }}" class="block p-2 text-lg md:text-xl {{ $current == "calendar" ? "text-blue-600" : "text-black" }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-600">Calendario</a></li>
                    <li><a href="{{ route("events") }}" class="block p-2 text-lg md:text-xl {{ $current == "events" ? "text-blue-600" : "text-black" }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-600">Eventos</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
