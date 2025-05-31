<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("app.login")])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

            <form class="sm:mx-auto p-12 w-full sm:w-xl" action="{{ route("password.email") }}" method="post">
                @csrf

                <div class="mb-6">
                    <label class="mb-2 block text-sm font-medium text-gray-900" for="email">@lang("app.email"):</label>
                    <input class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="email" name="email" value="{{ old("email") }}" max="50" required>

                    @include("layouts.error", ["field" => "email"])
                </div>

                <div class="flex mb-6 justify-between">
                    <input class="block sm:inline-block sm:mr-2 px-5 py-3 mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-5/12 text-center" type="submit" name="restore" value="@lang("app.restore_password")">
                    <a class="block sm:inline-block px-5 py-3 mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-5/12 text-center" href="{{ route("login") }}">@lang("app.login")</a>
                </div>
            </form>
        </main>
    </body>
</html>
