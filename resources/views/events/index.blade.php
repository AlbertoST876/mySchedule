<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("app.events")])

    <body>
        @include("layouts.header", ["current" => "events"])

        <main>
            <div class="mx-6 my-12 lg:mx-24 lg:my-12">
                @include("layouts.warn", ["message" => session("status")])

                <div class="my-8">
                    @if (count($prevEvents) > 0)
                        @include("layouts.events.eventsList", ["id" => "prevEvents", "name" => __("app.prevEvents"), "events" => $prevEvents])
                    @endif

                    @if (count($nextEvents) > 0)
                        @include("layouts.events.eventsList", ["id" => "nextEvents", "name" => __("app.nextEvents"), "events" => $nextEvents])
                    @endif

                    <div id="deleteModal" tabindex="-1" aria-hidden="true" class="p-4 fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                            <div class="relative bg-white rounded-lg shadow">
                                <div class="p-4 flex items-start justify-between border-b rounded-t">
                                    <h3 class="text-xl font-semibold text-gray-900">@lang("app.delete_confirm")</h3>
                                </div>

                                <form action="{{ route("events.destroy") }}" method="post">
                                    @csrf
                                    @method("delete")

                                    <input id="deleteEventId" type="hidden" name="event">

                                    <div class="p-4 flex items-center space-x-2 border-t border-gray-200 rounded-b">
                                        <input class="mr-2 my-2 px-5 py-3 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm" type="submit" value="@lang("app.delete")">
                                        <button type="button" class="px-5 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center" data-modal-hide="deleteModal">@lang("app.cancel")</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fixed right-6 bottom-6 group">
                    <button data-modal-target="createModal" data-modal-toggle="createModal" class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                        <svg aria-hidden="true" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <span class="sr-only">@lang("app.create_event")</span>
                    </button>
                </div>

                <div id="createModal" tabindex="-1" aria-hidden="true" class="p-4 fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                    <div class="relative w-full h-full max-w-2xl md:h-auto">
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="p-4 flex items-start justify-between border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900">@lang("app.create_event")</h3>

                                <button type="button" class="p-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ml-auto inline-flex items-center" data-modal-hide="createModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">@lang("app.close_create_event")</span>
                                </button>
                            </div>

                            <form action="{{ route("events.store") }}" method="post">
                                <div class="p-6">
                                    @csrf
                                    @method("put")

                                    <div class="mb-6">
                                        <select class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" name="category" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                                            @endforeach
                                        </select>

                                        @include("layouts.error", ["field" => "category"])
                                    </div>

                                    <div class="mb-6">
                                        <label class="mb-2 block text-sm font-medium text-gray-900" for="name">@lang("app.title"):</label>
                                        <input class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="text" name="name" max="50" required>

                                        @include("layouts.error", ["field" => "name"])
                                    </div>

                                    <div class="mb-6">
                                        <label class="mb-2 block text-sm font-medium text-gray-900" for="description">@lang("app.description"):</label>
                                        <input class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="text" name="description" max="255">

                                        @include("layouts.error", ["field" => "description"])
                                    </div>

                                    <div class="mb-6">
                                        <label class="mb-2 block text-sm font-medium text-gray-900" for="date">@lang("app.datetime"):</label>
                                        <input id="datetime" class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="datetime-local" name="date" min="{{ date("Y-m-d\TH:i") }}" value="{{ date("Y-m-d\TH:i") }}" required>

                                        @include("layouts.error", ["field" => "date"])
                                    </div>

                                    <div class="mb-2">
                                        <input id="remember-checkbox" class="mr-1 w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" type="checkbox" name="remember-checkbox">
                                        <label class="text-sm font-medium text-gray-900" for="remember">@lang("app.remember")</label>
                                        <input id="remember" class="mt-2 mb-6 p-3 hidden w-full border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" type="datetime-local" name="remember" min="{{ date("Y-m-d\TH:i") }}" disabled>

                                        @include("layouts.error", ["field" => "remember"])
                                    </div>

                                    <div class="mb-2">
                                        <input id="color-checkbox" class="mr-1 w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" type="checkbox" name="color-checkbox">
                                        <label class="text-sm font-medium text-gray-900" for="color">@lang("app.color")</label>
                                        <input id="color" class="mt-2 mb-6 p-1 hidden w-full border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" type="color" name="color" disabled>

                                        @include("layouts.error", ["field" => "color"])
                                    </div>
                                </div>

                                <div class="p-4 flex items-center space-x-2 border-t border-gray-200 rounded-b">
                                    <input class="px-5 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center" type="submit" name="create" value="@lang("app.create")">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
