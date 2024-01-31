<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("app.events") . " - " . __("app.see")])

    <body>
        @include("layouts.header", ["current" => "events"])

        <main>
            <div class="mx-6 my-12 lg:mx-24 lg:my-12 p-8 rounded-xl" data-color="{{ is_null($event -> color) ? $event -> categoryColor : $event -> color }}">
                <div class="grid gap-2 lg:gap-4 grid-cols-2 lg:grid-cols-3 grid-rows-2">
                    <div>
                        <span class="text-lg font-bold">{{ $event -> date -> format($dateFormat) }}</span>
                        <h3 class="mt-2 text-xl font-extrabold">{{ $event -> name }}</h3>
                    </div>

                    <span class="text-base text-right lg:text-center font-bold">{{ $event -> category }}</span>

                    <p class="col-span-2 lg:col-span-3 text-justify">{{ $event -> description }}</p>
                </div>

                <div class="flex">
                    <a class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" href="{{ route("events.index") }}">@lang("app.return")</a>

                    <form action="{{ route("events.edit") }}" method="post">
                        @csrf

                        <input type="hidden" name="event" value="{{ Crypt::encrypt($event -> id) }}">
                        <input class="px-5 py-3 mr-2 mb-2 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm" type="submit" value="@lang("app.edit")">
                    </form>

                    <button data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="mr-2 mb-2 px-5 py-3 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm">@lang("app.delete")</button>
                </div>
            </div>

            <div id="deleteModal" tabindex="-1" aria-hidden="true" class="p-4 fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <div class="relative bg-white rounded-lg shadow">
                        <div class="p-4 flex items-start justify-between border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">@lang("app.delete_confirm")</h3>
                        </div>

                        <form action="{{ route("events.destroy") }}" method="post">
                            @csrf
                            @method("delete")

                            <input type="hidden" name="event" value="{{ Crypt::encrypt($event -> id) }}">

                            <div class="p-4 flex items-center space-x-2 border-t border-gray-200 rounded-b">
                                <input class="mr-2 my-2 px-5 py-3 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm" type="submit" value="@lang("app.delete")">
                                <button type="button" class="px-5 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center" data-modal-hide="deleteModal">@lang("app.cancel")</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
