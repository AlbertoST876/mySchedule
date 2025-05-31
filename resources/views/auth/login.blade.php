<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("app.login")])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

            <form class="sm:mx-auto p-12 w-full sm:w-xl" action="{{ route("login") }}" method="post">
                @csrf

                <div class="mb-6">
                    <label class="mb-2 block text-sm font-medium text-gray-900" for="email">@lang("app.email"):</label>
                    <input class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="email" name="email" value="{{ old("email") }}" max="50" required>

                    @include("layouts.error", ["field" => "email"])
                </div>

                <div class="mb-6">
                    <label class="mb-2 block text-sm font-medium text-gray-900" for="password">@lang("app.password"):</label>
                    <input class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" type="password" name="password" max="255" required>

                    @include("layouts.error", ["field" => "password"])
                </div>

                <div class="mb-6">
                    <input class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" type="checkbox" name="remember">
                    <label class="ml-2 text-sm font-medium text-gray-900" for="remember">@lang("app.rememberme")</label>

                    @include("layouts.error", ["field" => "remember"])
                </div>

                <div class="mb-6">
                    <div class="flex justify-between">
                        <input class="block sm:inline-block sm:mr-2 px-5 py-3 mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-5/12 text-center" type="submit" name="login" value="@lang("app.login")">
                        <a class="block sm:inline-block px-5 py-3 mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-5/12 text-center" href="{{ route("register") }}">@lang("app.register")</a>
                    </div>

                    <a class="block px-5 py-3 mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full text-center" href="{{ route("password.request") }}">@lang("app.forgot_password")</a>
                </div>
            </form>
        </main>
    </body>
</html>
