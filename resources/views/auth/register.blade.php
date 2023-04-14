<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("messages.register")])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            <form class="m-12" action="" method="post">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="email">@lang("messages.email"):</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="email" name="email" value="{{ old("email") }}" max="50" required>

                    @include("layouts.error", ["field" => "email"])
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="name">@lang("messages.username"):</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="name" value="{{ old("name") }}" max="25" required>

                    @include("layouts.error", ["field" => "name"])
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="password">@lang("messages.password"):</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="password" name="password" max="255" required>

                    @include("layouts.error", ["field" => "password"])
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="password_confirmation">@lang("messages.password_confirm"):</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="password" name="password_confirmation" max="255" required>
                </div>

                <div class="mb-6">
                    <input class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" type="submit" name="register" value="@lang("messages.register")">
                    <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" href="{{ route("login") }}">@lang("messages.login")</a>
                </div>
            </form>
        </main>
    </body>
</html>
