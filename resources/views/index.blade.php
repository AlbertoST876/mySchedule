<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Inicio"])

    <body>
        @include("layouts.header")

        <main>
            @if (session("status"))
                <div class="flex justify-center w-full mx-4 my-4">
                    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Icono de Verificación</span>
                        </div>

                        <div class="ml-3 text-sm font-normal">{{ session("status") }}</div>

                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                            <span class="sr-only">Cerrar</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </div>
            @endif

            <div class="grid gap-24 grid-cols-2 grid-rows-1 mx-24 my-24">
                <div>
                    <h1 class="my-6 text-6xl font-extrabold dark:text-white">MySchedule</h1>

                    <p class="text-justify text-xl">Bienvenido a tu nueva Agenda personal almacenada en la nube, aquí podrás guardar tus notas, tareas, eventos, recordatorios, etc..., lo que necesites sin tener que instalar ninguna aplicación adicional en cualquiera de tus dispositivos.</p>

                    @guest
                        <div class="flex items-center justify-center my-8">
                            <a class="mr-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href="{{ route("login") }}">Iniciar Sesión</a>
                            <a class="ml-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href="{{ route("register") }}">Registrarse</a>
                        </div>
                    @endguest
                </div>

                <div><img class="border border-solid border-black rounded-md shadow-md" src="{{ asset("storage/img/schedule.jpg") }}"></div>
            </div>
        </main>

        <footer class="p-4 bg-slate-100 rounded-lg shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">©{{ date("Y") }} <a href="{{ route("index") }}" class="hover:underline">MySchedule</a>. Todos los derechos reservados.</span>

            <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">
                <li><a href="" class="mr-4 hover:underline md:mr-6 ">Sobre Nosotros</a></li>
                <li><a href="" class="mr-4 hover:underline md:mr-6">Política de Privacidad</a></li>
                <li><a href="" class="mr-4 hover:underline md:mr-6">Licencia del Usuario Final</a></li>
                <li><a href="" class="mr-4 hover:underline md:mr-6">Contacto</a></li>
            </ul>
        </footer>
    </body>
</html>
