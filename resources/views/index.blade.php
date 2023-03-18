<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Inicio"])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

            <div class="m-24 grid gap-24 grid-cols-2 grid-rows-1">
                <div class="my-12">
                    <h1 class="my-6 text-6xl font-extrabold">MySchedule</h1>

                    <p class="my-6 text-justify text-xl">Bienvenido a tu nueva Agenda personal almacenada en la nube, aquí podrás guardar tus notas, tareas, eventos, recordatorios, etc..., lo que necesites sin tener que instalar ninguna aplicación adicional en cualquiera de tus dispositivos.</p>

                    @guest
                        <div class="flex items-center justify-center">
                            <a class="mr-32 mb-2 px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" href="{{ route("login") }}">Iniciar Sesión</a>
                            <a class="px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" href="{{ route("register") }}">Registrarse</a>
                        </div>
                    @endguest
                </div>

                <div><img class="border border-solid border-black rounded-md shadow-md" src="{{ asset("storage/img/schedule.jpg") }}" alt="Imagen de la Aplicación"></div>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>
