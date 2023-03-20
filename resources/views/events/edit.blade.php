<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos - Editor"])

    <body>
        @include("layouts.header", ["current" => "events"])

        <main>
            <div class="mx-24 my-12">
                <form action="{{ route("events.update") }}" method="post">
                    @csrf
                    @method("patch")

                    <select class="mb-6 p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" name="category" required>
                        @foreach ($categories as $category)
                            @if ($category -> id == $event -> category_id)
                                <option value="{{ $category -> id }}" selected>{{ $category -> name }}</option>
                            @else
                                <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                            @endif
                        @endforeach
                    </select>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="name">Titulo</label>
                        <input class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="text" name="name" value="{{ $event -> name }}" max="50" required>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="description">Descripción</label>
                        <input class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="text" name="description" value="{{ $event -> description }}" max="255">
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="datetime">Fecha y Hora</label>
                        <input id="datetime" class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="datetime-local" name="date" value="{{ $event -> date }}" min="{{ date("Y-m-d\TH:i") }}" required>
                    </div>

                    <div class="mb-2">
                        <input id="remember-checkbox" class="mr-1 w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" type="checkbox" name="remember-checkbox" {{ is_null($event -> remember) ? "" : "checked" }}>
                        <label class="text-sm font-medium text-gray-900" for="remember">Recordar</label>
                        <input id="remember" class="mt-2 mb-6 p-3 border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="datetime-local" name="remember" value="{{ $event -> remember }}" min="{{ date("Y-m-d\TH:i") }}" disabled>
                    </div>

                    <div class="mb-2">
                        <input id="color-checkbox" class="mr-1 w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" type="checkbox" name="color-checkbox" {{ is_null($event -> color) ? "" : "checked" }}>
                        <label class="text-sm font-medium text-gray-900" for="color">Color</label>
                        <input id="color" class="mt-2 p-1 mb-6 border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="color" name="color" value="{{ $event -> color }}" disabled>
                    </div>

                    <input type="hidden" name="event" value="{{ $event -> id }}">
                    <input class="mr-2 mb-2 mr-2 mb-2 mt-6 px-5 py-3 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm" type="submit" name="edit" value="Editar">
                </form>

                @include("layouts.error", ["error" => "error"])

                <div class="mt-6 flex">
                    <a class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" href="{{ route("events") }}">Volver</a>

                    <form action="{{ route("events.show") }}" method="post">
                        @csrf

                        <input type="hidden" name="event" value="{{ $event -> id }}">
                        <input class="px-5 py-3 mr-2 mb-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="submit" value="Ver">
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
