<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos"])

    <body>
        @include("layouts.header", ["current" => "events"])

        <main>
            <div class="mx-24 my-12">
                @include("layouts.warn", ["message" => session("status")])

                <div class="my-8">
                    @include("layouts.events.eventsList", ["open" => false, "name" => "Eventos Pasados", "events" => $events["prevEvents"]])
                    @include("layouts.events.eventsList", ["open" => true, "name" => "Eventos Proximos", "events" => $events["nextEvents"]])
                </div>

                <div class="fixed right-6 bottom-6 group">
                    <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                        <svg aria-hidden="true" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <span class="sr-only">Crear Evento</span>
                    </button>
                </div>

                <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                    <div class="relative w-full h-full max-w-2xl md:h-auto">
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="flex items-start justify-between p-4 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900">Nuevo Evento</h3>

                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="defaultModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Cerrar Creación de Evento</span>
                                </button>
                            </div>

                            <form action="{{ route("events.create") }}" method="post">
                                <div class="p-6 space-y-6">
                                    @csrf

                                    <select class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="category" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                                        @endforeach
                                    </select>

                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-medium text-gray-900" for="name">Nombre:</label>
                                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="name" max="50" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-medium text-gray-900" for="description">Descripción:</label>
                                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="description" max="255">
                                    </div>

                                    <div class="mb-4">
                                        <input id="color-checkbox" class="mr-1 w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" type="checkbox" name="color-checkbox">
                                        <label class="text-sm font-medium text-gray-900" for="color">Color:</label>
                                        <input id="color" class="block mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1" type="color" name="color" disabled>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-medium text-gray-900" for="datetime">Fecha y Hora:</label>
                                        <input id="datetime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="datetime-local" name="date" min="{{ date("Y-m-d\TH:i") }}" value="{{ date("Y-m-d\TH:i") }}" required>
                                    </div>

                                    <div class="mb-4">
                                        <input id="remember-checkbox" class="mr-1 w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" type="checkbox" name="remember-checkbox">
                                        <label class="text-sm font-medium text-gray-900" for="remember">Recordar:</label>
                                        <input id="remember" class="block mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="datetime-local" name="remember" min="{{ date("Y-m-d\TH:i") }}" disabled>
                                    </div>

                                    @include("layouts.error", ["error" => "error"])
                                </div>

                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                    <input class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit" name="create" value="Crear">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
