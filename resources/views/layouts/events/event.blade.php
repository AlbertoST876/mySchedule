<div class="m-6 p-8 rounded-xl" data-color="{{ is_null($event -> color) ? $event -> categoryColor : $event -> color }}">
    <div class="grid gap-2 lg:gap-4 grid-cols-2 lg:grid-cols-3 grid-rows-2">
        <div>
            <span class="text-lg font-bold">{{ $event -> date }}</span>
            <h3 class="mt-2 text-xl font-extrabold">{{ $event -> name }}</h3>
        </div>

        <span class="text-base text-right lg:text-center font-bold">{{ $event -> category }}</span>

        <p class="col-span-2 lg:col-span-3 text-justify">{{ $event -> description }}</p>
    </div>

    <div class="flex">
        <form action="{{ route("events.show") }}" method="post">
            @csrf

            <input type="hidden" name="event" value="{{ $event -> id }}">
            <input class="mr-2 my-2 px-5 py-3 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="submit" value="@lang("messages.see")">
        </form>

        <form action="{{ route("events.edit") }}" method="post">
            @csrf

            <input type="hidden" name="event" value="{{ $event -> id }}">
            <input class="mr-2 my-2 px-5 py-3 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm" type="submit" value="@lang("messages.edit")">
        </form>

        <form action="{{ route("events.destroy") }}" method="post">
            @csrf
            @method("DELETE")

            <input type="hidden" name="event" value="{{ $event -> id }}">
            <input class="mr-2 my-2 px-5 py-3 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm" type="submit" value="@lang("messages.delete")" onclick="return confirm('@lang("messages.delete_confirm")')">
        </form>
    </div>
</div>
