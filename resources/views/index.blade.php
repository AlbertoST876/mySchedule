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

            <div class="grid gap-24 grid-cols-2 grid-rows-1 px-24 py-24">
                <div>
                    <h1 class="flex items-center my-6 text-5xl font-extrabold dark:text-white">MySchedule</h1>

                    <p>Bienvenido a tu nueva Agenda personal almacenada en la nube, aquí podrás guardar tus notas, eventos, recordatorios, etc..., lo que necesites sin tener que instalar ninguna aplicación adicional en cualquiera de tus dispositivos.</p>

                    @guest
                        <div class="flex items-cencet justify-center my-6">
                            <a class="border border-solid border-black rounded-xl shadow-md bg-sky-500 mx-12 px-4 py-2" href="{{ route("login") }}">Iniciar Sesión</a>
                            <a class="border border-solid border-black rounded-xl shadow-md bg-sky-500 mx-12 px-4 py-2" href="{{ route("register") }}">Registrarse</a>
                        </div>
                    @endguest
                </div>

                <div><img class="border border-solid border-black rounded-md shadow-md" src="{{ asset("storage/img/schedule.jpg") }}"></div>
            </div>
        </main>
    </body>
</html>
