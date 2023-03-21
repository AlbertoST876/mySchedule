<div class="mx-6 mb-6 p-8 rounded-xl" data-color="{{ is_null($event -> color) ? $event -> categoryColor : $event -> color }}">
    <div class="grid gap-4 grid-cols-3 grid-rows-1">
        <div>
            <span class="text-lg font-bold">{{ $event -> date }}</span>
            <h3 class="mt-2 text-xl font-extrabold">{{ $event -> name }}</h3>
        </div>

        <span class="text-base text-center font-bold">{{ $event -> category }}</span>

        <p class="col-span-3">{{ $event -> description }}</p>
    </div>

    <div class="flex mt-6">
        <form action="{{ route("events.show") }}" method="post">
            @csrf

            <input type="hidden" name="event" value="{{ $event -> id }}">
            <input class="mr-2 my-2 px-5 py-3 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="submit" value="Ver">
        </form>

        <form action="{{ route("events.edit") }}" method="post">
            @csrf

            <input type="hidden" name="event" value="{{ $event -> id }}">
            <input class="mr-2 my-2 px-5 py-3 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm" type="submit" value="Editar">
        </form>

        <form action="{{ route("events.delete") }}" method="post">
            @csrf

            <input type="hidden" name="event" value="{{ $event -> id }}">
            <input class="mr-2 my-2 px-5 py-3 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm" type="submit" value="Borrar" onclick="return confirm('¿Estás seguro de que deseas borrar el evento?')">
        </form>
    </div>
</div>
