<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos - Ver"])

    <body>
        @include("layouts.header")

        <main>
            @foreach ($events as $event)
                <div class="mx-24 my-12 p-8 bg-gray-100 rounded-xl">
                    <div class="grid gap-4 grid-cols-3 grid-rows-1">
                        <div>
                            <span class="text-lg font-bold dark:text-white">{{ $event -> date }}</span>
                            <h3 class="mt-2 text-xl font-extrabold dark:text-white">{{ $event -> name }}</h3>
                        </div>

                        <span class="text-base text-center font-bold dark:text-white">{{ $event -> category }}</span>

                        <p class="col-span-3">{{ $event -> description }}</p>
                    </div>

                    <div class="flex mt-6">
                        <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href="{{ route("events") }}">Volver</a>

                        <form action="{{ route("events.edit") }}" method="post">
                            @csrf

                            <input type="hidden" name="event" value="{{ $event -> id }}">
                            <input class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900" type="submit" value="Editar">
                        </form>

                        <form action="{{ route("events.delete") }}" method="post">
                            @csrf

                            <input type="hidden" name="event" value="{{ $event -> id }}">
                            <input class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" type="submit" value="Borrar" onclick="return confirm('¿Estás seguro de que deseas borrar el evento?')">
                        </form>
                    </div>
                </div>
            @endforeach
        </main>
    </body>
</html>
