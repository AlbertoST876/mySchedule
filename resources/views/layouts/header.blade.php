<header>
    <nav class="bg-slate-100 border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <a class="flex items-center" href="{{ route("index") }}">
                <img class="h-12 mr-3" src="{{ asset("icon.png") }}">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">MySchedule</span>
            </a>

            <div class="flex items-center md:order-2">
                @auth
                    <button type="button" class="flex mr-3 text-sm bg-slate-100 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Abrir Menu de Usuario</span>
                        <img class="w-12 h-12 rounded-full" src="{{ is_null(auth() -> user() -> profile_img) ? asset("./storage/img/default-user.png") : asset(auth() -> user() -> profile_img) }}" alt="Foto de Perfil">
                    </button>

                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-md dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ auth() -> user() -> name }}</span>
                            <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">{{ auth() -> user() -> email }}</span>
                        </div>

                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li><a href="{{ route("settings") }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Ajustes</a></li>

                            <li>
                                <form action="{{ route("logout") }}" method="post">
                                    @csrf

                                    <input class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" type="submit" value="Cerrar Sesión" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <button type="button" class="flex mr-3 text-sm bg-slate-100 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Abrir Menu de Usuario</span>
                        <img class="w-12 h-12 rounded-full" src="{{ asset("./storage/img/default-user.png") }}" alt="Foto de Perfil">
                    </button>

                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-md dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li><a href="{{ route("login") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Iniciar Sesión</a></li>
                            <li><a href="{{ route("register") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Registrarse</a></li>
                        </ul>
                    </div>
                @endauth

                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Abrir Menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
                <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-slate-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-slate-100 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li><a href="{{ route("index") }}" class="block px-2 py-2 pl-3 pr-4 text-xl {{ $current == "home" ? "text-blue-600" : "text-black" }} rounded md:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white" aria-current="page">Inicio</a></li>
                    <li><a href="{{ route("calendar") }}" class="block px-2 py-2 pl-3 pr-4 text-xl {{ $current == "calendar" ? "text-blue-600" : "text-black" }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Calendario</a></li>
                    <li><a href="{{ route("events") }}" class="block px-2 py-2 pl-3 pr-4 text-xl {{ $current == "events" ? "text-blue-600" : "text-black" }} rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Eventos</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
