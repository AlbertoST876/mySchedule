<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Inicio"])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

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

        @include("layouts.footer")
    </body>
</html>
