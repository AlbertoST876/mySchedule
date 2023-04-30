<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("messages.events") . " - " . __("messages.edit")])

    <body>
        @include("layouts.header", ["current" => "events"])

        <main>
            <div class="mx-6 my-12 lg:mx-24 lg:my-12">
                <form action="{{ route("events.update") }}" method="post">
                    @csrf
                    @method("patch")

                    <div class="mb-6">
                        <select class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" name="category" required>
                            @foreach ($categories as $category)
                                @if ($category -> id == $event -> category_id)
                                    <option value="{{ $category -> id }}" selected>{{ $category -> name }}</option>
                                @else
                                    <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                                @endif
                            @endforeach
                        </select>

                        @include("layouts.error", ["field" => "category"])
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="name">@lang("messages.title"):</label>
                        <input class="p-3 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" type="text" name="name" value="{{ $event -> name }}" max="50" required>

                        @include("layouts.error", ["field" => "name"])
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="description">@lang("messages.description"):</label>
                        <input class="p-3 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" type="text" name="description" value="{{ $event -> description }}" max="255">

                        @include("layouts.error", ["field" => "description"])
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="date">@lang("messages.datetime"):</label>
                        <input id="datetime" class="p-3 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" type="datetime-local" name="date" value="{{ $event -> date }}" min="{{ date("Y-m-d\TH:i") }}" required>

                        @include("layouts.error", ["field" => "date"])
                    </div>

                    <div class="mb-2">
                        <input id="remember-checkbox" class="mr-1 w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" type="checkbox" name="remember-checkbox" {{ is_null($event -> remember) ? "" : "checked" }}>
                        <label class="text-sm font-medium text-gray-900" for="remember">@lang("messages.remember")</label>
                        <input id="remember" class="mt-2 mb-6 p-3 hidden border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full" type="datetime-local" name="remember" value="{{ $event -> remember }}" min="{{ date("Y-m-d\TH:i") }}" disabled>

                        @include("layouts.error", ["field" => "remember"])
                    </div>

                    <div class="mb-2">
                        <input id="color-checkbox" class="mr-1 w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" type="checkbox" name="color-checkbox" {{ is_null($event -> color) ? "" : "checked" }}>
                        <label class="text-sm font-medium text-gray-900" for="color">@lang("messages.color")</label>
                        <input id="color" class="mt-2 p-1 mb-6 hidden border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full" type="color" name="color" value="{{ $event -> color }}" disabled>

                        @include("layouts.error", ["field" => "color"])
                    </div>

                    <input type="hidden" name="event" value="{{ $event -> id }}">
                    <input class="mr-2 mb-2 mt-6 px-5 py-3 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm" type="submit" name="edit" value="@lang("messages.edit")">
                </form>

                <div class="mt-6 flex">
                    <a class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" href="{{ route("events") }}">@lang("messages.return")</a>

                    <form action="{{ route("events.show") }}" method="post">
                        @csrf

                        <input type="hidden" name="event" value="{{ $event -> id }}">
                        <input class="px-5 py-3 mr-2 mb-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="submit" value="@lang("messages.see")">
                    </form>

                    <form action="{{ route("events.destroy") }}" method="post">
                        @csrf

                        <input type="hidden" name="event" value="{{ $event -> id }}">
                        <input class="px-5 py-3 mr-2 mb-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm" type="submit" value="@lang("messages.delete")" onclick="return confirm('@lang("messages.delete_confirm")')">
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>
