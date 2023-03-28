<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos - Ver"])

    <body>
        @include("layouts.header", ["current" => "events"])

        <main>
            <div class="mx-6 my-12 lg:mx-24 lg:my-12 p-8 rounded-xl" data-color="{{ is_null($event -> color) ? $event -> categoryColor : $event -> color }}">
                <div class="grid gap-2 lg:gap-4 grid-cols-2 lg:grid-cols-3 grid-rows-2">
                    <div>
                        <span class="text-lg font-bold">{{ $event -> date }}</span>
                        <h3 class="mt-2 text-xl font-extrabold">{{ $event -> name }}</h3>
                    </div>

                    <span class="text-base text-right lg:text-center font-bold">{{ $event -> category }}</span>

                    <p class="col-span-2 lg:col-span-3 text-justify">{{ $event -> description }}</p>
                </div>

                <div class="flex">
                    <a class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" href="{{ route("events") }}">Volver</a>

                    <form action="{{ route("events.edit") }}" method="post">
                        @csrf

                        <input type="hidden" name="event" value="{{ $event -> id }}">
                        <input class="px-5 py-3 mr-2 mb-2 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm" type="submit" value="Editar">
                    </form>

                    <form action="{{ route("events.delete") }}" method="post">
                        @csrf

                        <input type="hidden" name="event" value="{{ $event -> id }}">
                        <input class="px-5 py-3 mr-2 mb-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm" type="submit" value="Borrar" onclick="return confirm('¿Estás seguro de que deseas borrar el evento?')">
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>
