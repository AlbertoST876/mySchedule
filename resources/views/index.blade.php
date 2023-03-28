<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Inicio"])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

            <div class="mx-8 my-12 lg:m-24 grid gap-12 lg:gap-24 grid-cols-1 grid-rows-2 lg:grid-cols-2 lg:grid-rows-1">
                <div>
                    <h1 class="text-5xl lg:text-6xl font-extrabold">MySchedule</h1>

                    <p class="my-6 text-lg lg:text-xl text-justify">Bienvenido a tu nueva Agenda personal almacenada en la nube, aquí podrás guardar tus notas, tareas, eventos, recordatorios, etc..., lo que necesites sin tener que instalar ninguna aplicación adicional en cualquiera de tus dispositivos.</p>

                    @guest
                        <div class="flex items-center justify-center">
                            <a class="mr-32 mb-2 px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" href="{{ route("login") }}">Iniciar Sesión</a>
                            <a class="mb-2 px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" href="{{ route("register") }}">Registrarse</a>
                        </div>
                    @endguest
                </div>

                <div><img class="border border-solid border-black rounded-md shadow-md" src="{{ asset("storage/img/schedule.jpg") }}" alt="Imagen de la Aplicación"></div>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>
